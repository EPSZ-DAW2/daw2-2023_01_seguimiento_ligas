<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "imagenes".
 *
 * @property int $id Identificador interno de la imagen
 * @property string|null $foto
 *
 * @property AnunciosPatrocinador[] $anunciosPatrocinadors
 * @property Equipos[] $equipos
 * @property Equipos[] $equipos0
 * @property Jugadores[] $jugadores
 * @property Ligas[] $ligas
 * @property Noticias[] $noticias
 * @property Patrocinadores[] $patrocinadores
 */
class Imagenes extends \yii\db\ActiveRecord
{
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
        return $this->hasMany(Equipos::class, ['id_imagen' => 'id']);
    }

    /**
     * Gets query for [[Equipos0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipos0()
    {
        return $this->hasMany(Equipos::class, ['id_imagen_escudo' => 'id']);
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
}