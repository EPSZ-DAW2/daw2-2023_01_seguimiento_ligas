<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "noticias".
 *
 * @property int $id
 * @property string $titulo
 * @property string|null $descripcion
 * @property string $autor
 * @property string $fecha
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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['titulo', 'descripcion', 'autor', 'fecha'], 'required', 'message' => 'Este campo es obligatorio'],
             // Otras reglas de validación según tus necesidades
            //[['id', 'id_imagen'], 'required'],
            [['autor', 'titulo', 'fecha'], 'string', 'max' => 50],
            [['descripcion'], 'string', 'max' => 99999],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'descripcion' => 'Descripcion',
            'autor' => 'Autor',
            'fecha' => 'Fecha',
        ];
    }



    /**
     * Gets query for [[Imagen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImagen()
    {
        return $this->hasOne(Imagenes::class, ['id' => 'id_imagen']);
    }
}
