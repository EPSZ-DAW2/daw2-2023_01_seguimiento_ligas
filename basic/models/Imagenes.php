<?php

namespace app\models;

use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class for table "imagenes".
 *
 * @property int $id Identificador interno de la imagen
 * @property string|null $foto
 *
 * @property AnunciosPatrocinador[] $anunciosPatrocinadors
 * @property Equipos[] $equipos
 * @property Jugadores[] $jugadores
 * @property Ligas[] $ligas
 * @property Noticias[] $noticias
 * @property Patrocinadores[] $patrocinadores
 */
class Imagenes extends \yii\db\ActiveRecord
{
    public $imagenFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'imagenes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['imagenFile'], 'required', 'message' => 'Debes seleccionar una imagen.'],
            [['imagenFile'], 'file', 'extensions' => ['png', 'jpg', 'jpeg'],
            'message' => 'Solo se permiten archivos con extensiones PNG, JPG o JPEG.'],
            [['foto'], 'string', 'max' => 255],
            
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'foto' => 'Foto',
        ];
    }

    /**
     * Gets query for [[AnunciosPatrocinadors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnunciosPatrocinadors()
    {
        return $this->hasMany(AnunciosPatrocinador::class, ['id_imagen' => 'id']);
    }

    /**
     * Gets query for [[Equipos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipos()
    {
        return $this->hasMany(Equipos::class, ['id_escudo' => 'id']);
    }

    /**
     * Gets query for [[Equipos0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipos0()
    {
        return $this->hasMany(Equipos::class, ['id_escudo' => 'id']);
    }

    /**
     * Gets query for [[Jugadores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJugadores()
    {
        return $this->hasMany(Jugadores::class, ['id_imagen' => 'id']);
    }

    /**
     * Gets query for [[Ligas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLigas()
    {
        return $this->hasMany(Ligas::class, ['id_imagen' => 'id']);
    }

    /**
     * Gets query for [[Noticias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNoticias()
    {
        return $this->hasMany(Noticias::class, ['id_imagen' => 'id']);
    }

    /**
     * Gets query for [[Patrocinadores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPatrocinadores()
    {
        return $this->hasMany(Patrocinadores::class, ['id_imagen' => 'id']);
    }

    public function saveImagen()
    {
        if ($this->validate() && $this->imagenFile !== null) {
            $path = 'images/';
        
          
            if (!$this->save()) {
                Yii::$app->session->setFlash('error', 'Error al guardar el modelo.');
                return false;
            }
        
            $imageName = $this->imagenFile->basename . '.' . $this->imagenFile->extension;
            $fullPath = Yii::getAlias('@app/web/' . $path) . $imageName;
    
            
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
            
          
            if (!$this->imagenFile->saveAs(Yii::getAlias('@app/web/' . $path) . $imageName)) {
                Yii::$app->session->setFlash('error', 'Error al guardar la imagen.');
                return false;
            }
            
            $this->foto = $imageName;
            $this->save(false); 
    
            return true;
        } else {
            Yii::$app->session->setFlash('error', 'Debes seleccionar una imagen.');
            return false;
        }
    }
    
    
    
}