<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Ligas;
use app\models\Usuarios;

/* @var $this yii\web\View */
/* @var $model app\models\Equipos */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Crear Equipo';
//$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;

// Registrar el archivo CSS
//$this->registerCssFile('@web/css/equipos.css');
?>

<div class="contenido-cabecera">  
    
<h1>CREACIÓN DE EQUIPOS</h1>  

</div>

<div id="contenedor-principal">

<div class="marco">

    <p class="PaginaDeInicio">Por favor, rellene los campos para la creación de un equipo:</p>

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
    ]); ?>

    <?= $form->field($model, 'nombre', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el nombre de la liga', 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'descripcion', ['options' => ['class' => 'campoTitulo']])->textarea(['rows' => 6, 'placeholder' => 'Ingrese el nombre de la liga', 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'n_jugadores', ['options' => ['class' => 'campoTitulo']])->hiddenInput(['value' => 0])->label(false) ?>
    <br>
    <?= $form->field($imagenModel, 'imagenFile', ['options' => ['class' => 'campoTitulo']])->fileInput(['class' => 'campo'])->label('Subir Imagen') ?>
    <br>

    <?php
    $usuarios = Usuarios::find()
    ->where(['id_rol' => 6])
    ->all();

    // Convertir los usuarios en un array asociativo para usarlo en el dropdown
    $usuariosDropdown = ArrayHelper::map($usuarios, 'id', 'nombre');
    
    ?>

    <?= $form->field($model, 'gestor_eq')->dropDownList(
        $usuariosDropdown,
        ['prompt' => 'Selecciona un gestor']
    )->label('Gestor del equipo (opcional)') ?>

    <p>
        <?= Html::submitButton('Añadir Equipo', ['class' => 'botonFormulario']) ?>
        <?= Html::a(Yii::t('app', 'Atras'), ['index'], ['class' => 'botonFormulario']) ?>
    </p>

    <?php ActiveForm::end(); ?>
</div>
