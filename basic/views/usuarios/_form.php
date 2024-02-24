<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marco">

<?php $form = ActiveForm::begin([
    'id' => 'usuarios-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
]); ?>

    
    <?= $form->field($model, 'nombre', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el nombre', 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'apellido1', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el primer apellido', 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'apellido2', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el segundo apellido', 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'email', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el correo electronico', 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'password', ['options' => ['class' => 'campoTitulo']])->passwordInput(['maxlength' => true, 'placeholder' => 'Ingrese la contraseña', 'class' => 'campo', 'required' => true]) ?>
    <br>
    <?= $form->field($model, 'provincia', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingresela provincia', 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'id_rol')->hiddenInput(['value' => 7])->label(false) ?>

    <?= $form->field($model, 'username', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el nombre de usuario', 'class' => 'campo']) ?>
    <br>
    <?= $form->field($imagenModel, 'imagenFile', ['options' => ['class' => 'campoTitulo']])->fileInput(['class' => 'campo'])->label('Subir Imagen') ?>
    <br>
    <p>¿Ya tienes una cuenta? Inicia sesión <a href="<?= Yii::$app->urlManager->createUrl(['/usuarios/login']) ?>">aquí</a></p>
    <br>
    <?= Html::submitButton(Yii::t('app', 'Registrar'), ['class' => 'botonFormulario']) ?>
    <?= Html::a(Yii::t('app', 'Ir a Inicio'), Yii::$app->homeUrl, ['class' => 'botonFormulario']) ?>


</div>

<?php ActiveForm::end(); ?>

</div>
