<?php

namespace app\models;
use Yii;
use yii\base\model;
use app\models\Usuarios;

class RegisterForm extends model{
 
  public $nombre;
  public $apellido1;
  public $apellido2;
  public $email;
  public $password;
  public $password2;
  public $provincia;


  public function rules()
  {
    return [
      [['nombre','apellido1','apellido2','email','password','password2','provincia'], 'required', 'message' => 'Campo requerido'],
      ['email', 'email', 'message' => 'Formato no válido'],
      ['email', 'validate_email'],
      ['nombre', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Mínimo 3 y máximo 50 caracteres'],
      ['apellido1', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Mínimo 3 y máximo 50 caracteres'],
      ['apellido2', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Mínimo 3 y máximo 50 caracteres'],
      ['password', 'match', 'pattern' => "/^.{8,16}$/", 'message' => 'Mínimo 8 y máximo 16 caracteres'],
      ['password2', 'compare', 'compareAttribute' => 'password', 'message' => 'Las passwords no coinciden'],
      ['provincia', 'in', 'range' => range(1, 52), 'message' => 'Provincia no válida'],
      ['email', 'validate_email'],
    ];
  }
    
public function validate_email($attribute, $params)
{
    //Buscar el email en la tabla
    $table = Usuarios::find()->where("email=:email", [":email" => $this->email]);

    //Si el email existe mostrar el error
    if ($table->count() == 1)
    {
     $this->addError($attribute, "Ya hay un usuario registrado con ese email.");
    }
  }

  public function validate_nick($attribute, $params)
  {
    //Buscar el username en la tabla
    $table = Usuarios::find()->where("nick=:nick", [":nick" => $this->nick]);

    //Si el username existe mostrar el error
    if ($table->count() == 1)
    {
      $this->addError($attribute, "Ya existe un usuario con ese nombre.");
    }
  }

}