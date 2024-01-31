<?php
/** @var yii\web\View $this */
/** @var app\models\Partido $model */ // Asegúrate de ajustar el namespace y el nombre del modelo

use yii\helpers\Html;

$this->title = 'Detalles del Partido';
$this->params['breadcrumbs'][] = ['label' => 'Partidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="partido-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="marco">
        <h2><?= Html::encode($model->equipoLocal->nombre) ?> - <?= Html::encode($model->equipoVisitante->nombre) ?></h2>
        <p>Lugar: <?= Html::encode($model->lugar) ?></p>
        <p><?= (new DateTime($model->horario))->format('d/m/Y H:i:s') ?></p>
        <p>Resultado Local: <?= Html::encode($model->resultado_local) ?></p>
        <p>Resultado Visitante: <?= Html::encode($model->resultado_visitante) ?></p>
    </div>

</div>