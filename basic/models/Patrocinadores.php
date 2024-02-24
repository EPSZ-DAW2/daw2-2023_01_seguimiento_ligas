<?php

namespace app\models;
use Yii;

/**
 * This is the model class for table "{{%patrocinadores}}".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property int $id_imagen
 * 
 * @property Imagen $imagen
*/

class Patrocinadores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'patrocinadores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_imagen'], 'integer'],
            [['nombre', 'descripcion'], 'string','max' => 255],
            [['id_imagen'], 'exist', 'skipOnError' => true, 'targetClass' => Imagenes::class, 'targetAttribute' => ['id_imagen' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'id_imagen' => 'ID Imagen',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImagen()
    {
        return $this->hasOne(Imagenes::class, ['id' => 'id_imagen']);
    }
}
?>