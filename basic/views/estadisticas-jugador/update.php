<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\EstadisticasJugador $model */

$this->title = 'Modificar Estadísticas de Jugador: ' . $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Estadisticas Jugadores', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>

<div class="contenido-cabecera">

    <h1>MODIFICACIÓN DE ESTADISTICAS DE JUGADOR</h1>

</div>


<div  id="contenedor-principal">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
