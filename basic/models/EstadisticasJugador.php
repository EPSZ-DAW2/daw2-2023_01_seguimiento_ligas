<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estadisticas_jugador".
 *
 * @property int $id
 * @property int $id_temporada
 * @property int $id_equipo
 * @property int $id_jugador
 * @property int|null $partidos_jugados
 * @property int|null $puntos
 * @property int|null $rebotes
 * @property int|null $asistencias
 *
 * @property Equipos $equipo
 * @property Jugadores $jugador
 * @property Temporadas $temporada
 */
class EstadisticasJugador extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estadisticas_jugador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_temporada', 'id_equipo', 'id_jugador'], 'required'],
            [['id_temporada', 'id_equipo', 'id_jugador', 'partidos_jugados', 'puntos', 'rebotes', 'asistencias'], 'integer'],
            [['id_equipo'], 'exist', 'skipOnError' => true, 'targetClass' => Equipos::class, 'targetAttribute' => ['id_equipo' => 'id']],
            [['id_jugador'], 'exist', 'skipOnError' => true, 'targetClass' => Jugadores::class, 'targetAttribute' => ['id_jugador' => 'id']],
            [['id_temporada'], 'exist', 'skipOnError' => true, 'targetClass' => Temporadas::class, 'targetAttribute' => ['id_temporada' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_temporada' => 'Id Temporada',
            'id_equipo' => 'Id Equipo',
            'id_jugador' => 'Id Jugador',
            'partidos_jugados' => 'Partidos Jugados',
            'puntos' => 'Puntos',
            'rebotes' => 'Rebotes',
            'asistencias' => 'Asistencias',
        ];
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
     * Gets query for [[Temporada]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTemporada()
    {
        return $this->hasOne(Temporadas::class, ['id' => 'id_temporada']);
    }
}
