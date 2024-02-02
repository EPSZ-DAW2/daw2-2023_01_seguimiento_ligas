<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;

?>

<?php $this->title = 'Crear Jornada'; ?>

<div class="marco">

    <h2 class="equipos_presentacion"><?= Html::encode($this->title) ?></h2>

    <p class="PaginaDeInicio">Por favor, rellene los campos para la creación de una jornada:</p>


    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, 'numero', ['options' => ['class' => 'campoTitulo']])->textInput([
        'maxlength' => true,
        'type' => 'number', // Establecer el tipo como "number"
        'pattern' => '[0-9]*', // Expresión regular para aceptar solo números
    ]) ?>

    <?= $form->field($model, 'fecha_inicio')->widget(\yii\jui\DatePicker::class, [
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control'],
    ]) ?>

    <?= $form->field($model, 'fecha_final')->widget(\yii\jui\DatePicker::class, [
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control'],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Añadir Jornada', ['class' => 'botonInicioSesion']) ?>
    </div>

    <?php ActiveForm::end(); ?>
