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
 * @property int $id_rol
 * @property string $username
 * @property int $id_imagen


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
            [['nombre', 'apellido1', 'apellido2', 'email', 'password', 'provincia','id_rol','username','id_imagen'], 'required', 'message' => 'Este campo es obligatorio.'],
            [['auth_key', 'reg_token'], 'safe'],
            [['nombre', 'apellido1', 'apellido2', 'email', 'provincia','username'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 255, 'min' => 6, 'tooShort' => 'La contraseña debe tener al menos 6 caracteres.'],
           // [['password'], 'match', 'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]*$/', 'message' => 'La contraseña debe contener al menos una letra minúscula, una letra mayúscula y un número.'],
            [['email'], 'unique', 'message' => 'El correo electrónico ya está en uso. Por favor, elige otro.'],
            [['email'], 'email'],
            [['id_rol'], 'integer'],
            [['id_imagen'], 'integer'],
            [['id_imagen'], 'exist', 'skipOnError' => true, 'targetClass' => Imagenes::class, 'targetAttribute' => ['id_imagen' => 'id']],
            [['username'], 'unique', 'message' => 'Nombre de usuario "{value}" ya existe. Por favor, elige otro.'],
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
            'id_rol' => Yii::t('app', 'Rol'),
            'username' => Yii::t('app', 'Nombre de usuario'),
            'id_imagen' => Yii::t('app', 'Imagen'),
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
    public function setRol(){
        $this->id_rol=6;
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
	
    public static function getRol($id){
        $usuario = self::findOne($id);
        return $usuario ? $usuario->id_rol : null;
    }

    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }
    
	

    public function validatePassword($password)
    {
        if( Yii::$app->security->validatePassword($password, $this->password))
        {
            return true;
        }
        else
        {
            return false;
        }
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

    public static function login($username, $password)
{
    $usuario = self::findByUsername($username);

    if ($usuario && $usuario->validatePassword($password)) {
        return Yii::$app->user->login($usuario);
    }

    return false;
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




}
