<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\EstadisticasJugador $model */

$this->title = 'Modificar Estadísticas de Jugador: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Estadisticas Jugadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="estadisticas-jugador-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
