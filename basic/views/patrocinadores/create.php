<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Patrocinadores;
use app\models\Usuarios;

$this->title = 'Crear Patrocinador';
?>
<div class="contenido-cabecera">  
    
<h1>CREACIÓN DE PATROCINADORES</h1>  

</div>

<div id="contenedor-principal">

<div class="marco">

    <p class="PaginaDeInicio">Por favor, rellene los campos para la creación de un patrocinador:</p>

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
    ]); ?>

    <?= $form->field($model, 'nombre', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el nombre del patrocinador', 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'descripcion', ['options' => ['class' => 'campoTitulo']])->textarea(['rows' => 6, 'placeholder' => 'Ingrese el nombre de la liga', 'class' => 'campo']) ?>
    <br>
    <?= $form->field($imagenModel, 'imagenFile', ['options' => ['class' => 'campoTitulo']])->fileInput(['class' => 'campo'])->label('Subir Imagen') ?>
    <br>

    <p>
        <?= Html::submitButton('Añadir Equipo', ['class' => 'botonFormulario']) ?>
        <?= Html::a(Yii::t('app', 'Atras'), ['index'], ['class' => 'botonFormulario']) ?>
    </p>

    <?php ActiveForm::end(); ?>
</div>
