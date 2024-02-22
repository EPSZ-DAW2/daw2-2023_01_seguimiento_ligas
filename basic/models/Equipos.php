<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "equipos".
 *
 * @property int $id Identificador interno del equipo
 * @property int $id_liga Identificador de la liga
 * @property int $id_temporada Identificador de la temporada
 * @property string $nombre Nombre del equipo
 * @property string $descripcion Descripción general del equipo
 * @property int $id_escudo Identificador interno de la imagen del escudo
 * @property int $n_jugadores Número de jugadores que componen el equipo
 *
 * @property EquiposPatrocinadores[] $equiposPatrocinadores
 * @property Imagenes $escudo
 * @property EstadisticasEquipo[] $estadisticasEquipos
 * @property EstadisticasJugador[] $estadisticasJugadors
 * @property Jugadores[] $jugadores
 * @property Ligas $liga
 * @property Temporadas $temporada
 * @property PartidosJornada[] $partidosJornadas
 * @property PartidosJornada[] $partidosJornadas0
 */
class Equipos extends \yii\db\ActiveRecord
{
    public $id_temporada_seleccionada;

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
            [['id_liga', 'id_temporada', 'nombre', 'descripcion', 'id_escudo', 'n_jugadores'], 'required', 'message' => 'Este campo es obligatorio.'],
            [['id_liga', 'id_temporada', 'id_escudo', 'n_jugadores', 'gestor_eq'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
            //[['nombre'], 'unique', 'message' => 'Este equipo "{value}" ya esta creado.'],
            [['descripcion'], 'string', 'max' => 200],
            [['id_liga'], 'exist', 'skipOnError' => true, 'targetClass' => Ligas::class, 'targetAttribute' => ['id_liga' => 'id']],
            [['id_temporada'], 'exist', 'skipOnError' => true, 'targetClass' => Temporadas::class, 'targetAttribute' => ['id_temporada' => 'id']],
            [['id_escudo'], 'exist', 'skipOnError' => true, 'targetClass' => Imagenes::class, 'targetAttribute' => ['id_escudo' => 'id']],
            [['gestor_eq'], 'exist', 'targetClass' => Usuarios::class, 'targetAttribute' => 'id', 'skipOnEmpty' => true],
            // Agregar nuevas reglas de validación para los campos opcionales
            [['video'], 'safe'],
            [['video'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_liga' => 'ID Liga',
            'id_temporada' => 'ID Temporada',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'id_escudo' => 'Id Escudo',
            'n_jugadores' => 'Numero Jugadores',
            'gestor_eq' => 'Gestor del Equipo',
            'video' => 'Video',
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
     * Gets query for [[Escudo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEscudo()
    {
        return $this->hasOne(Imagenes::class, ['id' => 'id_escudo']);
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
     * Gets query for [[EstadisticasJugadorPartido]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstadisticasJugadorPartido()
    {
        // Relación entre equipos y estadísticas de jugador partido
        return $this->hasMany(EstadisticasJugadorPartido::class, ['id_equipo' => 'id']);
    }

    /**
     * Gets query for [[Imagen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImagen()
    {
        return $this->hasOne(Imagenes::class, ['id' => 'id_escudo']);
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
     * Gets query for [[Temporada]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTemporada()
    {
        return $this->hasOne(Temporadas::class, ['id' => 'id_temporada']);
    }

    /**
     * Gets query for [[PartidosJornadas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPartidosLocales()
    {
        return $this->hasMany(PartidosJornada::class, ['id_equipo_local' => 'id']);
    }

    /**
     * Gets query for [[PartidosJornadas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPartidosVisitantes()
    {
        return $this->hasMany(PartidosJornada::class, ['id_equipo_visitante' => 'id']);
    }

        /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::class, ['id' => 'gestor_eq']);
    }
}