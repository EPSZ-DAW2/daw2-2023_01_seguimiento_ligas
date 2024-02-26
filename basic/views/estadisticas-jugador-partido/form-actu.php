<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Jugadores;
use yii\data\ActiveDataProvider;


/* @var $this yii\web\View */
/* @var $model app\models\EstadisticasJugadorPartido */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contenido-cabecera">

<h1>ESTADISITICAS DE JUGADOR POR PARTIDO</h1>

</div>

<div  id="contenedor-principal">

<div class="marco">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_partido', ['options' => ['class' => 'campoTitulo']])->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'id_jugador', ['options' => ['class' => 'campoTitulo']])->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'id_equipo', ['options' => ['class' => 'campoTitulo']])->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'minutos', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese los minutos jugados', 'class' => 'campo']) ?>

    <?= $form->field($model, 'puntos', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese los puntos', 'class' => 'campo']) ?>

    <?= $form->field($model, 'rebotes', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese los rebotes', 'class' => 'campo']) ?>

    <?= $form->field($model, 'asistencias', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese las asistencias', 'class' => 'campo']) ?>

    <br>
    <p>
        <?= Html::submitButton('Guardar', ['class' => 'botonFormulario']) ?>
        <?= Html::a('Atras', Yii::$app->request->referrer ?: Yii::$app->homeUrl, ['class' => 'botonFormulario']) ?>

    </p>

    <?php ActiveForm::end(); ?>

</div>
</div>
