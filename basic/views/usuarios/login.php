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
<div id="contenedor-principal">

    <h1 class="PaginaDeInicio"><?= Html::encode($this->title) ?></h1>
    <br>
    <div class="marco">
    <p class="PaginaDeInicio"><?= Yii::t('app', 'Por favor, rellene los siguientes campos para iniciar sesión:') ?></p>
    
    <?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true, // Cambiar a true para habilitar la validación del cliente
]); ?>

    <?= $form->field($model, 'username', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el usuario', 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'password', ['options' => ['class' => 'campoTitulo']])->passwordInput(['maxlength' => true, 'placeholder' => 'Ingrese la contraseña', 'class' => 'campo']) ?>


    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enviar'), ['class' => 'botonInicioSesion']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>


