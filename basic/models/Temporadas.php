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
            [['fecha_inicial', 'fecha_final', 'id_liga', 'texto_de_titulo'], 'required', 'message' => 'Este campo es obligatorio.'],
            [['fecha_inicial', 'fecha_final'], 'safe'],
            [['texto_de_titulo'], 'string', 'max' => 50],
            [['id_liga'], 'integer'],
            [['texto_de_titulo'], 'unique', 'targetAttribute' => ['texto_de_titulo', 'id_liga'], 'message' => 'Este título ya está siendo utilizado para esta liga.'],
            [['fecha_inicial', 'fecha_final'], 'validateFecha'],
        ];
    }
    public function validateFecha($attribute, $params)
    {
        if ($this->fecha_inicial >= $this->fecha_final) {
            $this->addError('fecha_final', 'La fecha final debe ser posterior a la fecha inicial.');
        }
    
        $fechaInicio = strtotime($this->fecha_inicial);
        $fechaFin = strtotime($this->fecha_final);
    
        $duracionMinima = 2 * 7 * 24 * 60 * 60; // 2 semanas en segundos
    
        if ($fechaFin - $fechaInicio < $duracionMinima) {
            $this->addError('fecha_final', 'La temporada debe tener una duración mínima de 2 semanas.');
        }
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
     * Gets query for [[Equipo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipos()
    {
        return $this->hasMany(Equipos::class, ['id_temporada' => 'id']);
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
