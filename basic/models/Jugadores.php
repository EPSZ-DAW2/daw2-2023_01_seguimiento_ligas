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
            [['id_equipo', 'id_imagen'], 'integer'],
            [['altura', 'peso'], 'string'],
            [['altura'], 'required', 'message' => 'Es obligatorio introducir la altura del jugador'],
            [['peso'], 'required', 'message' => 'Es obligatorio introducir la altura del jugador'],
            [['nombre', 'posicion', 'nacionalidad'], 'string', 'max' => 50],
            [['nombre'], 'unique', 'message' => 'El nombre "{value}" ya existe.'],
            [['descripcion'], 'string', 'max' => 255],
            [['id_equipo'], 'exist', 'skipOnError' => true, 'targetClass' => Equipos::class, 'targetAttribute' => ['id_equipo' => 'id'], 'message' => 'El id_equipo introducido no existe. Introduzca un id equipo válido.'],
            [['id_imagen'], 'exist', 'skipOnError' => true, 'targetClass' => Imagenes::class, 'targetAttribute' => ['id_imagen' => 'id'],],
            [['video'], 'url', 'message' => 'El formato de la URL no es válido.'],
            [['video'], 'string', 'max' => 255],
            [['activo'], 'boolean'],

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
            'activo' => 'Activo',
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
        $alturaLength = strlen($this->altura);
        if ($alturaLength !== 3 && $alturaLength !== 4) {
            $this->addError($attribute, 'Introduzca una altura válida.');
            return false;
        }

        $this->altura = str_replace(',', '.', $this->altura);

        if ($alturaLength === 3) {
            if (preg_match('/^\d\.\d$/', $this->altura)) {
                return true;
            } else if (preg_match('/^\d{3}$/', $this->altura)) {
                $this->altura = substr($this->altura, 0, 1) . '.' . substr($this->altura, 1);
                $this->altura = $this->altura;
                return true;
            } else {
                $this->addError($attribute, 'Introduzca una altura válida.');
                return false;
            }
        }

        $alturaNumerica = floatval($this->altura);

        if ($alturaNumerica <= 1.30 || $alturaNumerica > 2.50) {
            $this->addError($attribute, 'La altura debe ser mayor a 1.30 m e inferior a 2.50 m.');
            return false;
        }
        return true;
    }
  
    public function validatePeso()
    {
        $peso = $this->peso;
    
        $pesoLength = strlen($peso);

        switch ($pesoLength) {
            case 2:
                if (!ctype_digit($peso)) {
                    $this->addError('peso', 'Introduzca un peso válido.');
                    return false;
                }
                break;
            case 3:
                break;
            case 4:

                $this->peso = $this->replaceNonNumericChars($peso);
                break;
            case 5:
            case 6:
                $this->peso = $this->replaceNonNumericChars($peso);
                break;
            default:
                $this->addError('peso', 'El formato del peso no es válido.');
                return false;
        }
    
        $pesoNumerico = floatval($this->peso);
    
        if ($pesoNumerico < 50 || $pesoNumerico > 180) {
            $this->addError('peso', 'El peso debe estar entre 50 kg y 180 kg.');
            return false;
        }
    
        return true;
    }
    
    private function replaceNonNumericChars($string)
    {
        return preg_replace('/[^0-9\.]/', '.', $string);
    }
    
        
}