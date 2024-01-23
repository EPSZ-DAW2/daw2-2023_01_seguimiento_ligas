<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\Usuarios $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\ArrayHelper;

//login de usuarios
$this->title = Yii::t('app', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-login">
    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= Yii::t('app', 'Por favor, rellene los siguientes campos para iniciar sesión:') ?></p>
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => false,
    ]); ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

