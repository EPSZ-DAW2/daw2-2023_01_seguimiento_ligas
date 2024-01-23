<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jugadores".
 *
 * @property int $id
 * @property int $id_equipo
 * @property string|null $nombre
 * @property string|null $descripcion
 * @property int $id_imagen
 * @property string|null $posicion
 * @property float|null $altura
 * @property float|null $peso
 * @property string|null $nacionalidad
 *
 * @property Equipos $equipo
 * @property EstadisticasJugador[] $estadisticasJugadors
 * @property Imagenes $imagen
 */
class Jugadores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jugadores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_equipo', 'id_imagen'], 'required'],
            [['nombre'], 'required', 'message' => 'Es obligatorio introducir un nombre.'],
            [['id_equipo', 'id_imagen'], 'integer'],
            [['altura', 'peso'], 'number'],
            [['altura'], 'required', 'message' => 'Es obligatorio introducir la altura del jugador'],
            [['peso'], 'required', 'message' => 'Es obligatorio introducir la altura del jugador'],
            [['nombre', 'posicion', 'nacionalidad'], 'string', 'max' => 50],
            [['descripcion'], 'string', 'max' => 255],
            [['id_equipo'], 'exist', 'skipOnError' => true, 'targetClass' => Equipos::class, 'targetAttribute' => ['id_equipo' => 'id'], 'message' => 'El id_equipo introducido no existe. Introduzca un id equipo válido.'],
            [['id_imagen'], 'exist', 'skipOnError' => true, 'targetClass' => Imagenes::class, 'targetAttribute' => ['id_imagen' => 'id'],],
        ];
    }

    public function beforeValidate()
    {
        $this->altura = str_replace(',', '.', $this->altura);
        $this->peso = str_replace(',', '.', $this->peso);

        return parent::beforeValidate();
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_equipo' => 'Id Equipo',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'id_imagen' => 'Id Imagen',
            'posicion' => 'Posicion',
            'altura' => 'Altura',
            'peso' => 'Peso',
            'nacionalidad' => 'Nacionalidad',
        ];
    }

    /**
     * Gets query for [[Equipo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipo()
    {
        return $this->hasOne(Equipos::class, ['id' => 'id_equipo']);
    }

    /**
     * Gets query for [[EstadisticasJugadors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstadisticasJugadors()
    {
        return $this->hasMany(EstadisticasJugador::class, ['id_jugador' => 'id']);
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

    public static function getNacionalidadesList()
    {
        $filePath = "C:/xampp/htdocs/daw2-2023_01_seguimiento_ligas/proyecto/nacionalidades.txt";

        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $nacionalidades = array_combine($lines, $lines);
        return $nacionalidades;
    }
}
