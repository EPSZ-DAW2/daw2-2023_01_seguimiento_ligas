<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\EstadisticasJugadorPartido $model */

$this->title = 'Modificar Estadísticas en el partido: ' . $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Estadisticas Jugadores', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>

<div class="contenido-cabecera">

    <h1>MODIFICACIÓN DE ESTADISTICAS EN EL PARTIDO</h1>

</div>


<div  id="contenedor-principal">

    <?= $this->render('form-actu', [
        'model' => $model,
    ]) ?>

</div>