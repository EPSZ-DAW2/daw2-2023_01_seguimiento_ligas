<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Roles; // Asegúrate de importar el modelo Roles

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

    <?= $form->field($model, 'nombre', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'apellido1', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'apellido2', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'email', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'password', ['options' => ['class' => 'campoTitulo']])->passwordInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'provincia', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'id_rol', ['options' => ['class' => 'campoTitulo']])
    ->dropDownList(
        Roles::find()->select(['nombre', 'id'])->indexBy('id')->column(),
        ['prompt' => 'Seleccionar Rol', 'class' => 'campo']
    )
    ->label('Rol') ?>

    <br>
    <?= $form->field($model, 'username', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($imagenModel, 'imagenFile', ['options' => ['class' => 'campoTitulo']])->fileInput(['class' => 'campo']) ?>
    <br>
    <?= Html::submitButton(Yii::t('app', 'Enviar'), ['class' => 'botonFormulario']) ?>
    <?= Html::a(Yii::t('app', 'Volver'), Yii::$app->request->referrer ?: Yii::$app->homeUrl, ['class' => 'botonFormulario']) ?>




<?php ActiveForm::end(); ?>

</div>
