<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Equipos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="equipos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_liga')->textInput() ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_imagen_escudo')->textInput() ?>

    <?= $form->field($model, 'id_imagen')->textInput() ?>

    <?= $form->field($model, 'n_jugadores')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
