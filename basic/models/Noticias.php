<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "noticias".
 *
 * @property int $id
 * @property string $titular
 * @property string|null $texto_noticia
 * @property string $autor
 * @property string $fecha_publicacion
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
        return 'noticias';
    }

}