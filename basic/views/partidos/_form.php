<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Partidos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div>

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'id_liga')->textInput(['placeholder' => 'Ingrese el ID de la liga']) ?>
    <br>
    <?= $form->field($model, 'id_temporada')->textInput(['placeholder' => 'Ingrese el ID de la temporada']) ?>
    <br>
    <?= $form->field($model, 'id_jornada')->textInput(['placeholder' => 'Ingrese el ID de la jornada']) ?>
    <br>
    <?= $form->field($model, 'id_equipo_local')->textInput(['placeholder' => 'Ingrese el ID del equipo local']) ?>
    <br>
    <?= $form->field($model, 'id_equipo_visitante')->textInput(['placeholder' => 'Ingrese el ID del equipo visitante']) ?>
    <br>
    <?= $form->field($model, 'horario')->textInput(['placeholder' => 'Ingrese la hora del partido']) ?>
    <br>
    <?= $form->field($model, 'lugar')->textInput(['placeholder' => 'Ingrese el lugar del partido']) ?>
    <br>
    <?= $form->field($model, 'resultado_local')->textInput(['placeholder' => 'Ingrese el resultado del equipo local']) ?>
    <br>
    <?= $form->field($model, 'resultado_visitante')->textInput(['placeholder' => 'Ingrese el resultado del equipo visitante']) ?>
    <br>
    <div class="form-group">
        <?= Html::submitButton('Guardar Partido', ['class' => 'botonInicioSesion']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
