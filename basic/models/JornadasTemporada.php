<?php

namespace app\models;

use Yii;
use yii\validators\DateValidator;

/**
 * This is the model class for table "jornadas_temporada".
 *
 * @property int $id
 * @property int $id_temporada
 * @property int $numero Número de la jornada
 * @property string $fecha_inicio
 * @property string $fecha_final
 * @property string|null $video Vídeo promocional
 *
 * @property PartidosJornada[] $partidosJornadas
 * @property Temporadas $temporada
 */
class JornadasTemporada extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jornadas_temporada';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_temporada', 'numero', 'fecha_inicio', 'fecha_final'], 'required', 'message' => 'Este campo es obligatorio.'],
            [['id_temporada', 'numero'], 'integer'],
            ['numero', 'unique', 'targetAttribute' => ['numero', 'id_temporada'], 'message' => 'Ya existe una jornada con este número para esta temporada.'],
            [['fecha_inicio', 'fecha_final'], 'required'],
            [['video'], 'string', 'max' => 255],
            [['id_temporada'], 'exist', 'skipOnError' => true, 'targetClass' => Temporadas::class, 'targetAttribute' => ['id_temporada' => 'id']],
            ['fecha_final', 'validarFecha'],
            ['fecha_inicio', 'validarFechaTemporada'],
            ['fecha_final', 'validarFechaTemporada'],
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
            'numero' => 'Numero',
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_final' => 'Fecha Final',
            'video' => 'Video',
        ];
    }

    /**
     * Gets query for [[PartidosJornadas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPartidosJornadas()
    {
        return $this->hasMany(PartidosJornada::class, ['id_jornada' => 'id']);
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

    // Función para validar que la fecha final de la jornada sea posterior a la de inicio
    public function validarFecha($attribute, $params)
    {
        $fechaInicial = $this->fecha_inicio;
        $fechaFinal = $this->fecha_final;

        // Validar que las fechas sean del tipo correcto
        if (!strtotime($this->fecha_inicio) || !strtotime($this->fecha_final)) {
            $this->addError($attribute, 'Las fechas no son válidas.');
            return;
        }

        if (strtotime($fechaFinal) < strtotime($fechaInicial)) {
            $this->addError($attribute, 'La fecha final debe ser posterior a la fecha inicial.');
        }
    }

    // Función para validar que las fechas de incio y fin estén dentro de la temporada
    public function validarFechaTemporada($attribute, $params)
    {
        $temporada = $this->temporada;

        if ($temporada !== null) {
            $fechaInicioTemporada = new \DateTime($temporada->fecha_inicial);
            $fechaFinTemporada = new \DateTime($temporada->fecha_final);
            $fechaInicioJornada = new \DateTime($this->$attribute);
            if ($fechaInicioJornada < $fechaInicioTemporada || $fechaInicioJornada > $fechaFinTemporada) {
                $this->addError($attribute, 'La fecha de la jornada debe estar dentro del rango de la temporada.');
            }
        }
    }
}
