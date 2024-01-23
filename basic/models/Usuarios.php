<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $id
 * @property string $nombre
 * @property string $apellido1
 * @property string $apellido2
 * @property string $email
 * @property string $password
 * @property string $provincia


 */
class Usuarios extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

     /**
     * @var string Auth key attribute
     */
    public $auth_key;

    /**
     * @var string Registration token attribute
     */
    public $reg_token;
      
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'apellido1', 'apellido2', 'email', 'password', 'provincia'], 'required'],
            [['auth_key', 'reg_token'], 'safe'],
            [['nombre', 'apellido1', 'apellido2', 'email', 'password', 'provincia'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['email'], 'email'],
            [['auth_key'], 'string', 'max' => 200], 
            [['reg_token'], 'string', 'max' => 200],
          
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'apellido1' => Yii::t('app', 'Primer apellido'),
            'apellido2' => Yii::t('app', 'Segundo apellido'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Contraseña'),
            'provincia' => Yii::t('app', 'Provincia'),
            'reg_token' => Yii::t('app', 'reg_token'),
            'auth_key' => Yii::t('app', 'auth_key'),
            
        ];
    }

    /**
     * {@inheritdoc}
     * @return UsuariosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsuariosQuery(get_called_class());
    }

    private function genKey()
    {
        $len=200;
        $key = "";
        $str = str_split("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789");
        $max = count($str)-1;
        for($i=0; $i<$len; $i++)
        {
            $key .= $str[rand(0, $max)];
        }
        return $key;
    }

    public function setAuthKey(){
        $this->auth_key=$this->genKey();
    }
	
    public function setRegToken(){
        $this->reg_token=$this->genKey();
    }

    public function getAuthKey(){
        return $this->auth_key;
    }

    public function getRegToken(){
        return $this->reg_token;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public function validateRegToken($regToken)
    {
        return $this->reg_token === $regToken;
    }

    public static function findIdentity($id)
    {
        return self::find()->where(['id'=>$id])->one();
    }

    public static function findByEmail($email){
        return self::find()->where(['email'=>$email])->one();
    }
	
	public function getComentarios(){
		
		return $this->hasMany(LibrosComentarios::class,['crea_usuario_id'=>'id'])->inverseOf('usuario');
		
	}

    public function validatePassword($_password){
        return $this->password === hash('sha1', $_password);
    }

    public function getId()
    {
        return $this->id;
    }

 

    public static function getSessionRol(){
        return self::getRol(Yii::$app->user->id);
    }

    public static function getSessionUser(){
        return self::findIdentity(Yii::$app->user->id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::find()->where(['auth_key'=>$token])->one()['id'];
    }


    public static function getNombre($id){

        $usuario = self::findOne($id);
        return $usuario ? $usuario->nombre : null;

    }

    //funcion de login 
    public static function login($email, $password){
        $usuario = self::findByEmail($email);
        if($usuario && $usuario->validatePassword($password)){
            return Yii::$app->user->login($usuario);
        }
        return false;
    }

}
