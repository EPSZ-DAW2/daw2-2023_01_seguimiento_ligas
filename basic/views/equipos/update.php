<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Actualizar Equipo: ' . $equipo->nombre;
//$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $equipo->nombre, 'url' => ['view', 'id' => $equipo->id]];
//$this->params['breadcrumbs'][] = 'Actualizar';

?>


<div class="contenido-cabecera">  
    
    <h1>MODIFICACION DE DATOS DE <?= $equipo->nombre; ?></h1>  

</div>

<div id="contenedor-principal">


    <div class="marco">


    <p class="PaginaDeInicio">Datos que se pueden modificar</p>

    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        ]); ?>

    <?= $form->field($equipo, 'nombre', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($equipo, 'descripcion', ['options' => ['class' => 'campoTitulo']])->textarea(['rows' => 6, 'class' => 'campo']) ?>
    <br>

    <p>
        <?= Html::submitButton('Actualizar', ['class' => 'botonFormulario']) ?>
        <?= Html::a('Atras', ['view', 'id' => $equipo->id], ['class' => 'botonFormulario']) ?>

    </p>

    <?php ActiveForm::end(); ?>
    </div>
</div>
