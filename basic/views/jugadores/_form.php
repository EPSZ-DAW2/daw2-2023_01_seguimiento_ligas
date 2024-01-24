<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Jugadores $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div>

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'id_equipo')->textInput(['placeholder' => 'Ingrese el ID del equipo']) ?>
    <br>
    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el nombre']) ?>
    <br>
    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true, 'placeholder' => 'Ingrese la descripción']) ?>
    <br>
    <?= $form->field($model, 'id_imagen')->textInput(['placeholder' => 'Ingrese el ID de la imagen']) ?>
    <br>
    <?= $form->field($model, 'posicion')->dropDownList([
        'Base' => 'Base',
        'Escolta' => 'Escolta',
        'Alero' => 'Alero',
        'Ala-pívot' => 'Ala-pívot',
        'Pívot' => 'Pívot',
    ], ['prompt' => 'Seleccione la posición']) ?>
    <br>
    <?= $form->field($model, 'altura')->textInput(['placeholder' => 'Ingrese la altura']) ?>
    <br>
    <?= $form->field($model, 'peso')->textInput(['placeholder' => 'Ingrese el peso']) ?>
    <br>
    <?= $form->field($model, 'nacionalidad')->textInput(['maxlength' => true, 'placeholder' => 'Ingrese la nacionalidad']) ?>
    <br>
    <div class="form-group">
        <?= Html::submitButton('Guardar Jugador', ['class' => 'botonInicioSesion']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
