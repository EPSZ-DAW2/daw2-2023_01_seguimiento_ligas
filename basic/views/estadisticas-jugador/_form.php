<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\EstadisticasJugador $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="estadisticas-jugador-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_temporada')->textInput() ?>

    <?= $form->field($model, 'id_equipo')->dropDownList(
        \yii\helpers\ArrayHelper::map(\app\models\Equipos::find()->all(), 'id', 'nombre'),
        ['prompt' => 'Selecciona un equipo']
    ) ?>

    <?= $form->field($model, 'id_jugador')->textInput() ?>

    <?= $form->field($model, 'partidos_jugados')->textInput() ?>

    <?= $form->field($model, 'puntos')->textInput() ?>

    <?= $form->field($model, 'rebotes')->textInput() ?>

    <?= $form->field($model, 'asistencias')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
