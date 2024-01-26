<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jornadas_temporada".
 *
 * @property int $id
 * @property int $id_temporada
 * @property string $fecha_jornada
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
            [['id_temporada', 'fecha_jornada'], 'required'],
            [['id_temporada'], 'integer'],
            [['fecha_jornada'], 'safe'],
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
            'fecha_jornada' => 'Fecha Jornada',
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
}
