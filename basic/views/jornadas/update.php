<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = " ACTUALIZAR DATOS DE LA JORNADA";
//$this->params['breadcrumbs'][] = ['label' => 'Temporada', 'url' => ['jornadas/index', 'id' => $jornada->id_temporada]];
//$this->params['breadcrumbs'][] = 'Actualizar';

?>


<div class="contenido-cabecera">

    <h1><?= Html::encode($this->title) ?></h1>

</div>



<div id="contenedor-principal">
    <div class="marco">

    <p class="PaginaDeInicio">Datos de la jornada</p>

    <?php $form = ActiveForm::begin([
            'enableAjaxValidation' => false,
            'enableClientValidation' => true,
        ]); ?>

    <?= $form->field($jornada, 'numero', ['options' => ['class' => 'campoTitulo']])->textInput([
        'maxlength' => true,
        'type' => 'number', // Establecer el tipo como "number"
        'pattern' => '[0-9]*', // Expresión regular para aceptar solo números
        'class' => 'campo',
    ]) ?>
    <br>
    <?= $form->field($jornada, 'fecha_inicio', ['options' => ['class' => 'campoTitulo']])->widget(\yii\jui\DatePicker::class, [
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'campo', 'placeholder' => 'Año-Mes-Dias'],
    ]) ?>
    <br>
    <?= $form->field($jornada, 'fecha_final', ['options' => ['class' => 'campoTitulo']])->widget(\yii\jui\DatePicker::class, [
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'campo', 'placeholder' => 'Año-Mes-Dias'],
    ]) ?>
    <br>

    <p>
        <?= Html::submitButton('Actualizar', ['class' => 'botonFormulario']) ?>
        <?= Html::a('Atras', ['view', 'id' => $jornada->id], ['class' => 'botonFormulario']) ?>
    </p>

    <?php ActiveForm::end(); ?>
    </div>
</div>