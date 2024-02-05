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
 * @property string $video Video de la liga
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
            [['video'], 'url', 'message' => 'El formato de la URL no es válido.'],
            [['video'], 'string', 'max' => 255],

            [['altura'], 'validateAltura'],
            [['peso'], 'validatePeso'],
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
            'video'=> 'Video',
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
    
    public function validateAltura($attribute, $params)
    {
        // Validar longitud de la cadena altura
        $alturaLength = strlen($this->altura);
        if ($alturaLength !== 3 && $alturaLength !== 4) {
            $this->addError($attribute, 'La altura debe tener 3 o 4 caracteres.');
            return false; // Devolver false para indicar que la validación falló
        }

        // Reemplazar comas por puntos para asegurar formato numérico adecuado
        $this->altura = str_replace(',', '.', $this->altura);

        // Si la altura tiene 3 caracteres
        if ($alturaLength === 3) {
            // Si la altura tiene el formato X.Y
            if (preg_match('/^\d\.\d$/', $this->altura)) {
                return true; // La altura es válida
            } else if (preg_match('/^\d{3}$/', $this->altura)) { // Si la altura tiene el formato XYZ
                // Agregar un punto después del primer carácter
                $this->altura = substr($this->altura, 0, 1) . '.' . substr($this->altura, 1);
                $this->altura = $this->altura; // Actualizar la altura en el modelo
                return true; // La altura es válida después de la modificación
            } else {
                $this->addError($attribute, 'La altura debe tener el formato X.Y o XYZ.');
                return false; // Devolver false para indicar que la validación falló
            }
        }

        // Convertir altura a formato numérico
        $alturaNumerica = floatval($this->altura);

        // Validar que la altura sea mayor a 1.50
        if ($alturaNumerica <= 1.50 || $alturaNumerica > 2.50) {
            $this->addError($attribute, 'La altura debe ser mayor a 1.50m e inferior a 2.50m.');
            return false; // Devolver false para indicar que la validación falló
        }
        
        return true;
    }
  

    public function validatePeso()
    {
        // Obtener el peso del modelo
        $peso = $this->peso;
    
        // Validar longitud de la cadena peso
        $pesoLength = strlen($peso);
    
        // Casos de validación según la longitud del peso
        switch ($pesoLength) {
            case 2:
                // Verificar si ambos caracteres son numéricos
                if (!ctype_digit($peso)) {
                    $this->addError('peso', 'El peso debe ser numérico.');
                    return false;
                }
                // No hay necesidad de modificar el peso, es válido
                break;
            case 3:
                // No hay necesidad de modificar el peso, es válido
                break;
            case 4:
                // Reemplazar caracteres no numéricos por puntos si es necesario
                $this->peso = $this->replaceNonNumericChars($peso);
                break;
            case 5:
            case 6:
                // Reemplazar caracteres no numéricos por puntos si es necesario
                $this->peso = $this->replaceNonNumericChars($peso);
                break;
            default:
                $this->addError('peso', 'El formato del peso no es válido.');
                return false;
        }
    
        // Convertir peso a formato numérico después de las validaciones
        $pesoNumerico = floatval($this->peso);
    
        // Validar que el peso esté dentro del rango especificado (50kg a 180kg)
        if ($pesoNumerico < 50 || $pesoNumerico > 180) {
            $this->addError('peso', 'El peso debe estar entre 50kg y 180kg.');
            return false;
        }
    
        // Si todas las validaciones son exitosas, el peso es válido
        return true;
    }
    
    // Función para reemplazar caracteres no numéricos por puntos
    private function replaceNonNumericChars($string)
    {
        return preg_replace('/[^0-9\.]/', '.', $string);
    }
    
        
}