<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "temporadas".
 *
 * @property int $id
 * @property string|null $texto_de_titulo
 * @property string|null $fecha_inicial
 * @property string|null $fecha_final
 *
 * @property EstadisticasEquipo[] $estadisticasEquipos
 * @property EstadisticasJugador[] $estadisticasJugadors
 * @property JornadasTemporada[] $jornadasTemporadas
 * @property PartidosJornada[] $partidosJornadas
 */
class Temporadas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'temporadas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha_inicial', 'fecha_final'], 'safe'],
            [['texto_de_titulo'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'texto_de_titulo' => 'Texto De Titulo',
            'fecha_inicial' => 'Fecha Inicial',
            'fecha_final' => 'Fecha Final',
        ];
    }

    /**
     * Gets query for [[EstadisticasEquipos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstadisticasEquipos()
    {
        return $this->hasMany(EstadisticasEquipo::class, ['id_temporada' => 'id']);
    }

    /**
     * Gets query for [[EstadisticasJugadors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstadisticasJugadors()
    {
        return $this->hasMany(EstadisticasJugador::class, ['id_temporada' => 'id']);
    }

    /**
     * Gets query for [[JornadasTemporadas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJornadasTemporadas()
    {
        return $this->hasMany(JornadasTemporada::class, ['id_temporada' => 'id']);
    }

    /**
     * Gets query for [[PartidosJornadas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPartidosJornadas()
    {
        return $this->hasMany(PartidosJornada::class, ['id_temporada' => 'id']);
    }
}
