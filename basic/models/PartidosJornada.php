<?php

namespace app\models;

use Yii;
use yii\validators\DateTimeValidator;

/**
 * This is the model class for table "partidos_jornada".
 *
 * @property int $id
 * @property int $id_jornada
 * @property int $id_equipo_local
 * @property int $id_equipo_visitante
 * @property string|null $horario
 * @property string|null $lugar
 * @property int|null $resultado_local
 * @property int|null $resultado_visitante
 *
 * @property Comentarios[] $comentarios
 * @property Equipos $equipoLocal
 * @property Equipos $equipoVisitante
 * @property JornadasTemporada $jornada
 */
class PartidosJornada extends \yii\db\ActiveRecord
{
    //almacena temporalmente la liga seleccionada
    public $id_liga_seleccionada;
    public $id_temporada_seleccionada;
    public $id_jornada_seleccionada;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'partidos_jornada';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_jornada', 'id_equipo_local', 'id_equipo_visitante', 'horario', 'lugar'], 'required', 'message' => 'Este campo es obligatorio.'],
            [['id_jornada', 'id_equipo_local', 'id_equipo_visitante', 'resultado_local', 'resultado_visitante'], 'integer'],
            [['horario'], 'safe'],
            [['lugar'], 'string', 'max' => 255],
            [['id_equipo_local'], 'exist', 'skipOnError' => true, 'targetClass' => Equipos::class, 'targetAttribute' => ['id_equipo_local' => 'id']],
            [['id_equipo_visitante'], 'exist', 'skipOnError' => true, 'targetClass' => Equipos::class, 'targetAttribute' => ['id_equipo_visitante' => 'id']],
            [['id_jornada'], 'exist', 'skipOnError' => true, 'targetClass' => JornadasTemporada::class, 'targetAttribute' => ['id_jornada' => 'id']],
            ['horario', 'validarHorarioEnJornada'],
            [['id_equipo_local', 'id_equipo_visitante'], 'noiguales'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_jornada' => 'Id Jornada',
            'id_equipo_local' => 'Id Equipo Local',
            'id_equipo_visitante' => 'Id Equipo Visitante',
            'horario' => 'Horario',
            'lugar' => 'Lugar',
            'resultado_local' => 'Resultado Local',
            'resultado_visitante' => 'Resultado Visitante',
        ];
    }

    /**
     * Gets query for [[Comentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentarios::class, ['id_partido' => 'id']);
    }

    /**
     * Gets query for [[EquipoLocal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipoLocal()
    {
        return $this->hasOne(Equipos::class, ['id' => 'id_equipo_local']);
    }

    /**
     * Gets query for [[EquipoVisitante]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipoVisitante()
    {
        return $this->hasOne(Equipos::class, ['id' => 'id_equipo_visitante']);
    }

    /**
     * Gets query for [[Jornada]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJornada()
    {
        return $this->hasOne(JornadasTemporada::class, ['id' => 'id_jornada']);
    }

    // Función para validar que un horario de un partido esté dentro de la jornada a la que pertenece
    public function validarHorarioEnJornada($attribute, $params)
    {
        $horario = $this->horario;

        // Obtener la jornada correspondiente al partido
        $jornada = $this->jornada;

        // Verificar si el horario está dentro del rango de fechas de la jornada
        if (strtotime($horario) < strtotime($jornada->fecha_inicio) || strtotime($horario) > strtotime($jornada->fecha_final)) {
            $this->addError($attribute, 'El horario del partido de la jornada ' . $jornada->numero . ' debe estar entre ' . $jornada->fecha_inicio . ' y ' . $jornada->fecha_final . '.');
        }
    }

    public function noiguales($attribute, $params)
    {
        if ($this->id_equipo_local === $this->id_equipo_visitante) {
            $this->addError($attribute, 'El equipo local y el equipo visitante no pueden ser el mismo.');
        }
    }
}
