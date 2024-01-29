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
            $path = 'images/';  // Carpeta dentro de "web/" donde se guardarán las imágenes
    
            // Genera un nombre único para la imagen para evitar conflictos de nombres
            $imageName = $this->imagenFile->basename . '.' . $this->imagenFile->extension;
            $fullPath = Yii::getAlias('@app/web/' . $path) . $imageName;
    
            // Verificar si la imagen ya existe en la carpeta
            if (file_exists($fullPath)) {
                // La imagen ya existe, puedes manejar este caso como desees
                Yii::$app->session->setFlash('error', 'La imagen ya existe.');
                return false;
            }
    
            // Intenta guardar la imagen en el directorio especificado
            if ($this->imagenFile->saveAs($fullPath)) {
                // La imagen se guardó correctamente, actualiza el atributo 'foto' en la base de datos
                $this->foto = $path . $imageName;
                if ($this->save(false)) { // Guarda el registro de la imagen en la base de datos sin validar
                    return true;
                } else {
                    Yii::$app->session->setFlash('error', 'Error al guardar la información de la imagen en la base de datos.');
                    return false;
                }
            } else {
                Yii::$app->session->setFlash('error', 'Error al guardar la imagen en el servidor.');
                return false;
            }
        } else {
            Yii::$app->session->setFlash('error', 'Debes seleccionar una imagen.');
            return false;
        }
    }
    
    
    
}
