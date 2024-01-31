<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "partidos".
 *
 * @property int $id Identificador interno del partido
 * @property int $id_liga Identificador de la liga
 * @property int $id_temporada Identificador de la temporada
 * @property int $id_jornada Identificador de la jornada
 * @property int $id_equipo_local Identificador interno del equipo local
 * @property int $id_equipo_visitante Identificador interno del equipo visitante
 * @property string $horario Hora a la que se disputa el partido
 * @property string $lugar Lugar donde se disputa el partido
 * @property int $resultado_local Puntuación del equipo local
 * @property int $resultado_visitante Puntuación del equipo visitante
 * 
 * Aquí van las funciones
 **/
class Partidos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'partidos_jornada';
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // Todos los campos son requeridos
            [['id_liga', 'id_temporada', 'id_jornada', 'id_equipo_local', 'id_equipo_visitante'], 'required'],
            // Horario debe ser una fecha válida
            ['horario', 'date', 'format' => 'yyyy-MM-dd HH:mm:ss'],
            // lugar debe ser una cadena
            ['lugar', 'string', 'max' => 255],
            // resultado_local y resultado_visitante deben ser números enteros
            [['resultado_local', 'resultado_visitante'], 'integer'],
            // buscamos el id de los campos en la base de datos
            [['id_liga'], 'exist', 'skipOnError' => true, 'targetClass' => Ligas::class, 'targetAttribute' => ['id_liga' => 'id']],
            [['id_temporada'], 'exist', 'skipOnError' => true, 'targetClass' => Temporadas::class, 'targetAttribute' => ['id_temporada' => 'id']],
            [['id_jornada'], 'exist', 'skipOnError' => true, 'targetClass' => Jornadas::class, 'targetAttribute' => ['id_jornada' => 'id']],
            [['id_equipo_local'], 'exist', 'skipOnError' => true, 'targetClass' => Equipos::class, 'targetAttribute' => ['id_equipo_local' => 'id']],
            [['id_equipo_visitante'], 'exist', 'skipOnError' => true, 'targetClass' => Equipos::class, 'targetAttribute' => ['id_equipo_visitante' => 'id']],
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
            'id_jornada' => 'ID Jornada',
            'id_equipo_local' => 'ID Equipo Local',
            'id_equipo_visitante' => 'ID Equipo Visitante',
            'horario' => 'Horario',
            'lugar' => 'Lugar',
            'resultado_local' => 'Resultado Local',
            'resultado_visitante' => 'Resultado Visitante',
        ];
    }

    /**
     * Relación con el equipo local
     */
    public function getEquipoLocal()
    {
        return $this->hasOne(Equipos::class, ['id' => 'id_equipo_local']);
    }

    /**
     * Relación con el equipo visitante
     */
    public function getEquipoVisitante()
    {
        return $this->hasOne(Equipos::class, ['id' => 'id_equipo_visitante']);
    }

}
?>