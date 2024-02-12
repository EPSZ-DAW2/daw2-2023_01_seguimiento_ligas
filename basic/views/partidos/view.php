<?php

use yii\helpers\Html;

$this->title = $model->equipoLocal->nombre . ' vs ' . $model->equipoVisitante->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Partidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="marco">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Lugar: <?= Html::encode($model->lugar) ?></p>
    <p>Fecha y Hora: <?= (new DateTime($model->horario))->format('d/m/Y H:i:s') ?></p>
    <p>Jornada: <?= Html::encode($model->jornada->numero) ?></p>
    <p>Temporada: <?= Html::encode($model->jornada->temporada->texto_de_titulo) ?></p>

    <?php
        // Obtener la fecha actual
        $fechaActual = new DateTime();

        // Obtener la fecha del partido
        $fechaPartido = new DateTime($model->horario);

        // Si la fecha del partido ha pasado
        if ($fechaActual > $fechaPartido) {
            echo "<p>Resultado: {$model->resultado_local} - {$model->resultado_visitante}</p>";
        } else {
            // Si el partido es futuro, mostrar la fecha y hora futuras
            echo "<p>". $fechaPartido->format('d/m/Y H:i:s') . "</p>";
        }
        ?>

    <?= Html::a('Actualizar Partido', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Eliminar Partido', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => '¿Estás seguro de que quieres eliminar este partido?',
            'method' => 'post',
        ],
    ]) ?>

</div>
