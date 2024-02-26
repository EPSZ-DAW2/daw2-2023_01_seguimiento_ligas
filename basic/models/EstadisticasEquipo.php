<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estadisticas_equipo".
 *
 * @property int $id
 * @property int $id_temporada
 * @property int $id_equipo
 * @property int|null $partidos_jugados
 * @property int|null $victorias
 * @property int|null $derrotas
 *
 * @property Equipos $equipo
 * @property Temporadas $temporada
 */
class EstadisticasEquipo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estadisticas_equipo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_temporada', 'id_equipo'], 'required'],
            [['id_temporada', 'id_equipo', 'partidos_jugados', 'victorias', 'derrotas', 'empates'], 'integer'],
            [['id_equipo'], 'exist', 'skipOnError' => true, 'targetClass' => Equipos::class, 'targetAttribute' => ['id_equipo' => 'id']],
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
            'partidos_jugados' => 'Partidos Jugados',
            'victorias' => 'Victorias',
            'derrotas' => 'Derrotas',
            'empates' => 'Empates'
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
     * Gets query for [[Temporada]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTemporada()
    {
        return $this->hasOne(Temporadas::class, ['id' => 'id_temporada']);
    }
}
