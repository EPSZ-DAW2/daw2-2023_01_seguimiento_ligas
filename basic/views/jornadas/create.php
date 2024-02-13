<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;

?>

<?php $this->title = 'Crear Jornada'; ?>


<div class="contenido-cabecera">

    <h1><?= Html::encode($this->title) ?></h1>

</div>


<div id="contenedor-principal">

    <div class="marco">

        <p class="PaginaDeInicio">Por favor, rellene los campos para la creación de una jornada:</p>


        <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data'],
            'enableAjaxValidation' => false,
            'enableClientValidation' => true,
        ]); ?>

        <?= $form->field($model, 'numero', ['options' => ['class' => 'campoTitulo']])->textInput([
            'maxlength' => true,
            'placeholder' => 'Ingrese el numero de la temporada',
            'type' => 'number', // Establecer el tipo como "number"
            'pattern' => '[0-9]*', // Expresión regular para aceptar solo números
            'class' => 'campo',
        ]) ?>
        <br>
        <?= $form->field($model, 'fecha_inicio', ['options' => ['class' => 'campoTitulo']])->widget(\yii\jui\DatePicker::class, [
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'campo', 'placeholder' => 'Año-Mes-Dias'],
        ]) ?>
        <br>
        <?= $form->field($model, 'fecha_final', ['options' => ['class' => 'campoTitulo']])->widget(\yii\jui\DatePicker::class, [
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'campo', 'placeholder' => 'Año-Mes-Dias'],
        ]) ?>
        <br>

        <p>    
        <?= Html::submitButton('Añadir Jornada', ['class' => 'botonFormulario']) ?>
        </p>
        <?php ActiveForm::end(); ?>
    </div>
</div>