<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "equipos".
 *
 * @property int $id Identificador interno del equipo
 * @property int $id_liga Identificador de la liga
 * @property string $nombre Nombre del equipo
 * @property string $descripcion Descripción general del equipo
 * @property int $id_imagen_escudo Identificador interno de la imagen del escudo
 * @property int $id_imagen Identificador interno de las imágenes
 * @property int $n_jugadores Número de jugadores que componen el equipo
 *
 * @property EquiposPatrocinadores[] $equiposPatrocinadores
 * @property EstadisticasEquipo[] $estadisticasEquipos
 * @property EstadisticasJugador[] $estadisticasJugadors
 * @property Imagenes $imagen
 * @property Imagenes $imagenEscudo
 * @property Jugadores[] $jugadores
 * @property Ligas $liga
 * @property PartidosJornada[] $partidosJornadas
 * @property PartidosJornada[] $partidosJornadas0
 */
class Equipos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'equipos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_liga', 'nombre', 'descripcion', 'id_imagen_escudo', 'id_imagen', 'n_jugadores'], 'required', 'message' => 'Este campo es obligatorio'],
            [['id_liga', 'id_imagen_escudo', 'id_imagen', 'n_jugadores'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
            [['descripcion'], 'string', 'max' => 200],
            [['id_liga'], 'exist', 'skipOnError' => true, 'targetClass' => Ligas::class, 'targetAttribute' => ['id_liga' => 'id']],
            [['id_imagen'], 'exist', 'skipOnError' => true, 'targetClass' => Imagenes::class, 'targetAttribute' => ['id_imagen' => 'id']],
            [['id_imagen_escudo'], 'exist', 'skipOnError' => true, 'targetClass' => Imagenes::class, 'targetAttribute' => ['id_imagen_escudo' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_liga' => 'Id Liga',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'id_imagen_escudo' => 'Id Imagen Escudo',
            'id_imagen' => 'Id Imagen',
            'n_jugadores' => 'N Jugadores',
        ];
    }

    /**
     * Gets query for [[EquiposPatrocinadores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquiposPatrocinadores()
    {
        return $this->hasMany(EquiposPatrocinadores::class, ['id_equipo' => 'id']);
    }

    /**
     * Gets query for [[EstadisticasEquipos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstadisticasEquipos()
    {
        return $this->hasMany(EstadisticasEquipo::class, ['id_equipo' => 'id']);
    }

    /**
     * Gets query for [[EstadisticasJugadors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstadisticasJugadors()
    {
        return $this->hasMany(EstadisticasJugador::class, ['id_equipo' => 'id']);
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
     * Gets query for [[ImagenEscudo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImagenEscudo()
    {
        return $this->hasOne(Imagenes::class, ['id' => 'id_imagen_escudo']);
    }

    /**
     * Gets query for [[Jugadores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJugadores()
    {
        return $this->hasMany(Jugadores::class, ['id_equipo' => 'id']);
    }

    /**
     * Gets query for [[Liga]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLiga()
    {
        return $this->hasOne(Ligas::class, ['id' => 'id_liga']);
    }

    /**
     * Gets query for [[PartidosJornadas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPartidosJornadas()
    {
        return $this->hasMany(PartidosJornada::class, ['id_equipo_local' => 'id']);
    }

    /**
     * Gets query for [[PartidosJornadas0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPartidosJornadas0()
    {
        return $this->hasMany(PartidosJornada::class, ['id_equipo_visitante' => 'id']);
    }
}
