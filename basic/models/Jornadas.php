<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jornada_temporadas".
 *
 * @property int $id
 * @property int $id_temporada
 * @property string $fecha_jornada
 * 
 * @property Imagenes $imagen
 */
class Noticias extends \yii\db\ActiveRecord
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
            [['fecha_jornada'], 'safe'],
            [['id_temporada'], 'required'],
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
            'id_temporada' => 'ID Temporada',
            'fecha_jornada' => 'Fecha',
        ];
    }
}