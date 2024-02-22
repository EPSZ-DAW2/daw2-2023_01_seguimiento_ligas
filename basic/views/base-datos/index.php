<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $archivos array */
/* @var $error string */

$this->title = 'Copias de Seguridad';
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="contenido-cabecera">

    <h1>COPIAS DE SEGURIDAD</h1>

</div>

<div id="contenedor-izquierda">

    <div class="marco">

        <p class="PaginaDeInicio"><?= Html::encode($this->title) ?></p>
        <!-- Formulario para restaurar copia de seguridad -->
        <?php $form = ActiveForm::begin(['action' => ['restaurarcopia'], 'method' => 'post', 'enableAjaxValidation' => false, 'enableClientValidation' => true,]); ?>
        <?= Html::dropDownList('archivoZip', null, $archivos, ['prompt' => 'Seleccionar copia de seguridad', 'class' => 'campo']) ?>
        <br>
        <?= Html::submitButton('Restaurar', ['class' => 'botonFormulario']) ?>
        <?php ActiveForm::end(); ?>
        <br>
        <!-- Formulario para eliminar copia de seguridad -->
        <?php $form = ActiveForm::begin(['action' => ['eliminarcopia'], 'method' => 'post', 'method' => 'post', 'enableAjaxValidation' => false, 'enableClientValidation' => true,]); ?>
        <?= Html::dropDownList('nombreArchivo', null, $archivos, ['prompt' => 'Seleccionar copia de seguridad', 'class' => 'campo']) ?>
        <br>
        <?= Html::submitButton('Eliminar', ['class' => 'botonFormulario']) ?>
        <?php ActiveForm::end(); ?>

        <br>
        <p>
        <!-- Botón para generar copia de seguridad -->
        <?= Html::a('Crear Copia de Seguridad', ['copiaseguridad'], ['class' => 'botonFormulario']) ?>

        <!-- boton que redirige a la pagina de inicio -->
        <?= Html::a('Recargar datos ', ['base-datos/index'], ['class' => 'botonFormulario']) ?>
        </p>
    
        <!-- Mostrar mensajes de error o éxito -->
        <?php if (!empty($error)) : ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>

    </div>
</div>