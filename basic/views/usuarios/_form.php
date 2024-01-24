<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuarios-form">

<?php $form = ActiveForm::begin([
    'id' => 'usuarios-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => false,
]); ?>

    
    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'apellido1')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'apellido2')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'provincia')->textInput() ?>
    <?= $form->field($model, 'id_rol')->hiddenInput(['value' => 1])->label(false) ?>
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>




    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
