<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\Usuarios $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\ArrayHelper;

//login de usuarios
$this->title = Yii::t('app', 'Login');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div>

    <h1 class="PaginaDeInicio"><?= Html::encode($this->title) ?></h1>

    <div class="marco">
    <p class="PaginaDeInicio"><?= Yii::t('app', 'Por favor, rellene los siguientes campos para iniciar sesión:') ?></p>
    
    <?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true, // Cambiar a true para habilitar la validación del cliente
]); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el usuario']) ?>
    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'placeholder' => 'Ingrese la contraseña']) ?>


    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enviar'), ['class' => 'botonInicioSesion']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>


