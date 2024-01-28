<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read Usuarios|null $user
 *
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
			// username and password are both required with custom error messages
			[['email'], 'required', 'message' => 'Por favor, ingrese su correo electronico.'],
			[['password'], 'required', 'message' => 'Por favor, ingrese su contraseña.'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            
            ['password', 'validatePassword'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'password' => 'Contraseña',
            'rememberMe' => 'Recordarme',
        ];
    }
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $password the password to be validated
     * 
     */
    public function validatePassword($password)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Correo Electronico o Contraseña Incorrectos, vuelva a intentarlo.');
            }
        }
    }
    /**
     * Logs in a user using the provided email and password.
     * @return bool whether the user is logged in successfully
     * 
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0); //si el usuario se ha logeado correctamente, se le redirige a la pagina de inicio
        }
        return false;
    }
    /**
     * Finds user by [[email]]
     *
     * @return Usuarios|null
     * 
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Usuarios::findByEmail($this->email);
        }
        return $this->_user;
    }
}
