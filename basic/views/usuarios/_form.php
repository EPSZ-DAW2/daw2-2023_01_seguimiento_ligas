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
    'enableClientValidation' => false,
]); ?>

    
    <?= $form->field($model, 'nombre', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el nombre', 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'apellido1', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el usuario', 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'apellido2', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el usuario', 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'email', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el usuario', 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'password', ['options' => ['class' => 'campoTitulo']])->passwordInput(['maxlength' => true, 'placeholder' => 'Ingrese el usuario', 'class' => 'campo', 'required' => true]) ?>
    <br>
    <?= $form->field($model, 'provincia', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el usuario', 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'id_rol')->hiddenInput(['value' => 6])->label(false) ?>

    <?= $form->field($model, 'username', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el usuario', 'class' => 'campo']) ?>
    <br>

    <p>¿Ya tienes una cuenta? Inicia sesión <a href="<?= Yii::$app->urlManager->createUrl(['/usuarios/login']) ?>">aquí</a></p>
    <br>
    <?= Html::submitButton(Yii::t('app', 'Registrar'), ['class' => 'botonFormulario']) ?>
    <?= Html::a(Yii::t('app', 'Atras'), Yii::$app->request->referrer ?: Yii::$app->homeUrl, ['class' => 'botonFormulario']) ?>

</div>
    <div class="form-group">

    </div>

<?php ActiveForm::end(); ?>

</div>
