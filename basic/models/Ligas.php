<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ligas".
 *
 * @property int $id Identificador interno de la liga
 * @property string $nombre Nombre común de la liga
 * @property string $pais País en el que acontece la liga
 * @property int $id_imagen
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
            [['nombre', 'pais', 'id_imagen'], 'required'],
            [['id_imagen'], 'integer'],
            [['nombre', 'pais'], 'string', 'max' => 50],
            [['id_imagen'], 'exist', 'skipOnError' => true, 'targetClass' => Imagenes::class, 'targetAttribute' => ['id_imagen' => 'id']],
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
            'pais' => 'Pais',
            'id_imagen' => 'Id Imagen',
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
}
