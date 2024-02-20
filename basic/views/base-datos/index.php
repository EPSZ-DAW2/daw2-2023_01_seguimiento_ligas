<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $archivos array */
/* @var $error string */

$this->title = 'Copias de Seguridad';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="base-datos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- Formulario para restaurar copia de seguridad -->
    <?php $form = ActiveForm::begin(['action' => ['restaurarcopia'], 'method' => 'post']); ?>
    <?= Html::dropDownList('archivoZip', null, $archivos, ['prompt' => 'Seleccionar copia de seguridad']) ?>
    <?= Html::submitButton('Restaurar', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end(); ?>

    <!-- Formulario para eliminar copia de seguridad -->
    <?php $form = ActiveForm::begin(['action' => ['eliminarcopia'], 'method' => 'post']); ?>
    <?= Html::dropDownList('nombreArchivo', null, $archivos, ['prompt' => 'Seleccionar copia de seguridad']) ?>
    <?= Html::submitButton('Eliminar', ['class' => 'btn btn-danger']) ?>
    <?php ActiveForm::end(); ?>

    <!-- Botón para generar copia de seguridad -->
    <?= Html::a('Crear Copia de Seguridad', ['copiaseguridad'], ['class' => 'btn btn-success']) ?>

    <!-- boton que redirige a la pagina de inicio -->
    <?= Html::a('Recargar datos ', ['base-datos/index'], ['class' => 'btn btn-primary']) ?>

    <!-- Mostrar mensajes de error o éxito -->
    <?php if ($error) : ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

</div>
