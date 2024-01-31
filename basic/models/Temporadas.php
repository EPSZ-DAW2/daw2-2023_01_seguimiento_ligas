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
            [['fecha_inicial', 'fecha_final', 'id_liga'], 'required'],
            [['fecha_inicial', 'fecha_final'], 'safe'],
            [['texto_de_titulo'], 'string', 'max' => 50],
            [['id_liga'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_liga' => 'Liga a la que pertenece',
            'texto_de_titulo' => 'Nombre de la Temporada',
            'fecha_inicial' => 'Inicio de la Temporada',
            'fecha_final' => 'Fin de la Temporada',
        ];
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