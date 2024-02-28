<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Ligas;

/** @var yii\web\View $this */
/** @var app\models\Ligas $model */
/** @var yii\widgets\ActiveForm $form */


// Obtener el ID de la liga actual
$ligaId = $model->id;

// Construir la URL dinámicamente utilizando el ID de la liga actual
$url = Url::to(['ligas/view', 'id' => $ligaId]);

?>

<div class="marco">

<p class="PaginaDeInicio">Campos a modificar:</p>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        ]); ?>

    <?= $form->field($model, 'nombre', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'descripcion', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'pais', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($imagenModel, 'imagenFile', ['options' => ['class' => 'campoTitulo']])
    ->fileInput(['class' => 'campo'])
    ->label('Subir Imagen') ?>
    <br>
    <?= $form->field($model, 'video', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'estado', ['options' => ['class' => 'campoTitulo']])->dropDownList(
            ['Activa' => 'Activa', 'Inactiva' => 'Inactiva'],
            ['prompt' => 'Selecciona un estado', 'class' => 'campo']
            
            
            
        ) ?>

    <br>
    <?= Html::submitButton('Modificar', ['class' => 'botonFormulario']) ?>
    <?= Html::a(Yii::t('app', 'Datos del equipo'), $url, ['class' => 'botonFormulario']) ?>
    <?= Html::a(Yii::t('app', 'Tabla de ligas'), ['ligas/index'], ['class' => 'botonFormulario']) ?>

    <?php ActiveForm::end(); ?>

</div>
