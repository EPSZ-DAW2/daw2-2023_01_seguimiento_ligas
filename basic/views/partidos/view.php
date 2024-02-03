<?php

use yii\helpers\Html;

$this->title = 'Detalles del Partido: ' . $model->equipoLocal->nombre . ' vs ' . $model->equipoVisitante->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Partidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="marco">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Lugar: <?= Html::encode($model->lugar) ?></p>
    <p>Fecha y Hora: <?= (new DateTime($model->horario))->format('d/m/Y H:i:s') ?></p>
    <p>Jornada: <?= Html::encode($model->jornada->numero) ?></p>
    <p>Temporada: <?= Html::encode($model->jornada->temporada->texto_de_titulo) ?></p>

    <?= Html::a('Actualizar Partido', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Eliminar Partido', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => '¿Estás seguro de que quieres eliminar este partido?',
            'method' => 'post',
        ],
    ]) ?>

</div>
