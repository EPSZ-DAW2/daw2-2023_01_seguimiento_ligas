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

<div class="contenido-cabecera">

    <h1>INICIO DE SESIÓN</h1>

</div>

<div id="contenedor-principal">

    <div class="marco">
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'enableAjaxValidation' => false,
            'enableClientValidation' => true, // Cambiar a true para habilitar la validación del cliente
        ]); ?>

        <?= $form->field($model, 'username', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el usuario', 'class' => 'campo']) ?>
        <br>
        <?= $form->field($model, 'password', ['options' => ['class' => 'campoTitulo']])->passwordInput(['maxlength' => true, 'placeholder' => 'Ingrese la contraseña', 'class' => 'campo']) ?>
        <br>
        <p>¿No tienes una cuenta? Regístrate <a href="<?= Yii::$app->urlManager->createUrl(['/usuarios/create']) ?>">aquí</a></p>

        <?= Html::submitButton(Yii::t('app', 'Iniciar Sesion'), ['class' => 'botonFormulario']) ?>
        <?= Html::a(Yii::t('app', 'Ir a Inicio'), Yii::$app->homeUrl, ['class' => 'botonFormulario']) ?>



        <?php ActiveForm::end(); ?>

        <!-- Muestra los mensajes de error con la clase "error-message" -->
        <?php foreach (Yii::$app->session->getAllFlashes() as $key => $message) { ?>
            <div class="<?= $key === 'error' ? 'help-block' : '' ?>"><?= $message ?></div>
        <?php } ?>


    </div>

</div>
