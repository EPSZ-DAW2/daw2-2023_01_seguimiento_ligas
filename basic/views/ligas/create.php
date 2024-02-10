<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Ligas;

/* @var $this yii\web\View */
/* @var $model app\models\Equipos */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Crear Liga';
?>

<div class="contenido-cabecera">

    <h1>CREADOR DE LIGAS</h1>

</div>

<div  id="contenedor-principal">
    <div class="marco">
        <p class="PaginaDeInicio">Por favor, rellene los campos para la creación de una liga:</p>

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],
            'enableAjaxValidation' => false,
            'enableClientValidation' => true,
        ]); ?>

        <?= $form->field($model, 'nombre', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el nombre de la liga', 'class' => 'campo']) ?>
        <br>
        <?= $form->field($model, 'descripcion', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese la descripción de la liga', 'class' => 'campo']) ?>
        <br>
        <?= $form->field($model, 'pais', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el pais al que pertenezca la liga', 'class' => 'campo']) ?>
        <br>
        <?= $form->field($imagenModel, 'imagenFile', ['options' => ['class' => 'campoTitulo']])->fileInput(['class' => 'campo'])->label('Subir Imagen') ?>
        <br>
        <?= $form->field($model, 'video', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el video de la liga', 'class' => 'campo']) ?>
        <br>

        <?= Html::submitButton('Añadir Liga', ['class' => 'botonFormulario']) ?>
        <?= Html::a(Yii::t('app', 'Tabla de Ligas'), ['ligas/index'], ['class' => 'botonFormulario']) ?>

        <?php ActiveForm::end(); ?>
    </div>
</div>
