<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Jugadores $model */

$this->title = 'Modificar Jugadores: ' . $model->nombre;
//$this->params['breadcrumbs'][] = ['label' => 'Jugadores', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Modificar';
?>

<div class="contenido-cabecera">
    <h1>MODIFICAR DATOS DE <?= Html::encode($model->nombre) ?></h1>
</div>

<div id="contenedor-principal">
    <div class="marco">
        <?= $this->render('_form', [
            'model' => $model,
            'imagenModel' => $imagenModel,
            'esGestorEquipo' => $esGestorEquipo, // Pasa la variable al formulario
            'equipoId' => $equipoId, // Pasa la variable al formulario
        ]) ?>
    </div>
</div>

