<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Usuarios;

$this->title = 'Actualizar Patrocinador: ' . $patrocinador->nombre;
?>

<div class="contenido-cabecera">  
    
    <h1>MODIFICACION DE DATOS DE <?= $patrocinador->nombre; ?></h1>  

</div>

<div id="contenedor-principal">


    <div class="marco">


    <p class="PaginaDeInicio">Datos que se pueden modificar</p>

    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        ]); ?>
    <br>

    <?= $form->field($patrocinador, 'nombre', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($patrocinador, 'descripcion', ['options' => ['class' => 'campoTitulo']])->textarea(['rows' => 6, 'class' => 'campo']) ?>
    <br>

    <p>
        <?= Html::submitButton('Actualizar', ['class' => 'botonFormulario']) ?>
        <?= Html::a('Atras', ['vista', 'id' => $patrocinador->id], ['class' => 'botonFormulario']) ?>
    </p>

    <?php ActiveForm::end(); ?>
    </div>
</div>