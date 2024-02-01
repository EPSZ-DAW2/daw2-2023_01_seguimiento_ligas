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

            [['id_equipo', 'nombre', 'descripcion', 'id_imagen', 'posicion', 'altura', 'peso', 'nacionalidad'], 'required', 'message' => 'Este campo es obligatorio'],
             // Otras reglas de validación según tus necesidades
            //[['id_equipo', 'id_imagen'], 'required'],
            //[['nombre'], 'required', 'message' => 'Es obligatorio introducir un nombre.'],
            [['id_equipo', 'id_imagen'], 'integer'],
            [['altura', 'peso'], 'string'],
            [['altura'], 'required', 'message' => 'Es obligatorio introducir la altura del jugador'],
            [['peso'], 'required', 'message' => 'Es obligatorio introducir la altura del jugador'],
            [['nombre', 'posicion', 'nacionalidad'], 'string', 'max' => 50],
            [['descripcion'], 'string', 'max' => 255],
            [['id_equipo'], 'exist', 'skipOnError' => true, 'targetClass' => Equipos::class, 'targetAttribute' => ['id_equipo' => 'id'], 'message' => 'El id_equipo introducido no existe. Introduzca un id equipo válido.'],
            [['id_imagen'], 'exist', 'skipOnError' => true, 'targetClass' => Imagenes::class, 'targetAttribute' => ['id_imagen' => 'id'],],
        ];
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
    public function getEstadisticasJugador()
    {
        return $this->hasOne(EstadisticasJugador::class, ['id_jugador' => 'id']);
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
        $filePath = Yii::getAlias('@app/web/datos/nacionalidades.txt');

        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $nacionalidades = array_combine($lines, $lines);
        return $nacionalidades;
    }
    
    public function beforeValidate()
    {
        // Validar longitud de la cadena altura
        $alturaLength = strlen($this->altura);
        if ($alturaLength !== 3 && $alturaLength !== 4) {
            $this->addError('altura', 'La altura debe tener 3 o 4 caracteres.');
            return false; // Devolver false para indicar que la validación falló
        }
    
        // Reemplazar comas por puntos para asegurar formato numérico adecuado
        $this->altura = str_replace(',', '.', $this->altura);
    
        // Convertir altura a formato numérico
        $alturaNumerica = floatval($this->altura);
    
        // Validar que la altura sea mayor a 1.50
        if ($alturaNumerica <= 1.50 || $alturaNumerica >2.50) {
            $this->addError('altura', 'La altura debe ser mayor a 1.50m e inferior a 2.50m.');
            return false; // Devolver false para indicar que la validación falló
        }
    
        // Si la altura es de 3 caracteres, agregar el punto en el lugar adecuado
        if ($alturaLength === 3) {
            $this->altura = substr($this->altura, 0, 1) . '.' . substr($this->altura, 1);
        }
    
        return parent::beforeValidate();
    }
      
           
}