<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EstadisticasJugadorPartido */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estadisticas-jugador-partido-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_jugador')->textInput() ?>

    <?= $form->field($model, 'id_partido')->textInput() ?>

    <?= $form->field($model, 'puntos')->textInput() ?>

    <?= $form->field($model, 'rebotes')->textInput() ?>

    <?= $form->field($model, 'asistencias')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


