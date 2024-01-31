<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ligas".
 *
 * @property int $id Identificador interno de la liga
 * @property string $nombre Nombre común de la liga
 * @property string $descripcion descripción de la liga
 * @property string $pais País en el que acontece la liga
 * @property int $id_imagen
 * @property string $video Video de la liga
 *
 * @property Equipos[] $equipos
 * @property Imagenes $imagen
 * @property PartidosJornada[] $partidosJornadas
 */
class Ligas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ligas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'pais','descripcion', 'id_imagen'], 'required', 'message' => 'Este campo es obligatorio.'],
            [['id_imagen'], 'integer'],
            [['nombre', 'pais'], 'string', 'max' => 50],
            [['nombre'], 'unique', 'message' => 'La liga "{value}" ya existe.'],
            [['id_imagen'], 'exist', 'skipOnError' => true, 'targetClass' => Imagenes::class, 'targetAttribute' => ['id_imagen' => 'id']],
            [['video'], 'string', 'max' => 255],
            [['descripcion'], 'string', 'max' => 500],
            [['video'], 'url', 'message' => 'El formato de la URL no es válido.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripción',
            'pais' => 'Pais',
            'id_imagen' => 'Id Imagen',
            'video' => 'Video',
        ];
    }

    /**
     * Gets query for [[Equipos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipos()
    {
        return $this->hasMany(Equipos::class, ['id_liga' => 'id']);
    }

    /**
     * Gets query for [[Imagen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImagen()
    {
        return $this->hasOne(Imagenes::class, ['id' => 'id_imagen']);
    }

    /**
     * Gets query for [[PartidosJornadas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPartidosJornadas()
    {
        return $this->hasMany(PartidosJornada::class, ['id_liga' => 'id']);
    }

    public function getPartidos()
    {
        return $this->hasMany(Partidos::class, ['id' => 'id_partido'])->viaTable('partidos_jornada', ['id_liga' => 'id']);
    }

    public function getTemporadas()
    {
        return $this->hasMany(Temporadas::class, ['id' => 'id_temporada'])->viaTable('partidos_jornada', ['id_liga' => 'id']);
    }

    public function getJornadas()
    {
        return $this->hasMany(Jornadas::class, ['id' => 'id_jornada'])->viaTable('partidos_jornada', ['id_liga' => 'id']);
    }
}
