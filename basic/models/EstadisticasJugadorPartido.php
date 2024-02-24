<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estadisticas_jugador_partido".
 *
 * @property int $id
 * @property int $id_jugador
 * @property int $id_partido
 * @property int $id_equipo
 * @property int|null $puntos
 * @property int|null $rebotes
 * @property int|null $asistencias
 * @property int|null $minutos
 *
 * @property Jugadores $jugador
 * @property PartidosJornada $partido
 * @property Equipos $equipo
 */
class EstadisticasJugadorPartido extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estadisticas_jugador_partido';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_jugador', 'id_partido', 'id_equipo', 'minutos', 'puntos', 'rebotes', 'asistencias'], 'required', 'message' => 'Este campo es obligatorio.'],
            [['id_jugador', 'id_partido', 'id_equipo', 'minutos', 'puntos', 'rebotes', 'asistencias'], 'integer'],
            [['id_jugador'], 'exist', 'skipOnError' => true, 'targetClass' => Jugadores::class, 'targetAttribute' => ['id_jugador' => 'id']],
            [['id_partido'], 'exist', 'skipOnError' => true, 'targetClass' => PartidosJornada::class, 'targetAttribute' => ['id_partido' => 'id']],
            [['id_equipo'], 'exist', 'skipOnError' => true, 'targetClass' => Equipos::class, 'targetAttribute' => ['id_equipo' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_jugador' => 'Id Jugador',
            'id_partido' => 'Id Partido',
            'id_equipo' => 'Id Equipo',
            'minutos' => 'Minutos',
            'puntos' => 'Puntos',
            'rebotes' => 'Rebotes',
            'asistencias' => 'Asistencias',
        ];
    }

    /**
     * Gets query for [[Jugador]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJugador()
    {
        return $this->hasOne(Jugadores::class, ['id' => 'id_jugador']);
    }

    /**
     * Gets query for [[Partido]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPartido()
    {
        return $this->hasOne(PartidosJornada::class, ['id' => 'id_partido']);
    }

    /**
     * Gets query for [[Equipo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipo()
    {
        return $this->hasOne(Equipos::class, ['id' => 'id_equipo']);
    }
}
