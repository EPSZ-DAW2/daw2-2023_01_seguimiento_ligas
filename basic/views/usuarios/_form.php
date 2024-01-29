<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div id="contenedor-principal">

<?php $form = ActiveForm::begin([
    'id' => 'usuarios-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => false,
]); ?>


<div class="marco">

    <!--<p class="PaginaDeInicio"><?= Yii::t('app', 'Por favor, rellene los siguientes campos para registrarte en nuestra web:') ?></p>-->
    <?= $form->field($model, 'nombre', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el Nombre', 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'apellido1', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el primer apellido', 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'apellido2', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el segundo apellido', 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'email', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el E-mail', 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'password', ['options' => ['class' => 'campoTitulo']])->passwordInput(['maxlength' => true, 'required' => true, 'placeholder' => 'Ingrese la contraseña', 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'provincia', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese su provincia', 'class' => 'campo']) ?>

    <?= $form->field($model, 'id_rol', ['options' => ['class' => 'campoTitulo']])->hiddenInput(['value' => 1])->label(false) ?>
    <br>
    <?= $form->field($model, 'username', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el nombre de usuario', 'class' => 'campo']) ?>

</div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enviar'), ['class' => 'botonInicioSesion']) ?>
        <?= Html::a(Yii::t('app', 'Atras'), Yii::$app->request->referrer ?: Yii::$app->homeUrl, ['class' => 'botonInicioSesion']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
