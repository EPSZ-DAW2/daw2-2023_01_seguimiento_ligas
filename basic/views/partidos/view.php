<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\EstadisticasJugador;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\PartidosJornada */

$this->title = 'Detalles del Partido: ' . $model->equipoLocal->nombre . ' vs ' . $model->equipoVisitante->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Partidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2)) {
?>
    <div class="partidos-jornada-view">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'fecha',
                'hora',
                'lugar',
                'resultado_local',
                'resultado_visitante',
                'observaciones:ntext',
            ],
        ]) ?>

        <h2>Estadísticas de Jugadores</h2>

        <h3>Equipo Local: <?= Html::encode($model->equipoLocal->nombre) ?></h3>
        <?= GridView::widget([
        'dataProvider' => $dataProviderLocal, // Utiliza el proveedor de datos para el equipo local
        'columns' => [
            'jugador.nombre', // Utiliza el nombre del jugador en lugar del nombreJugador
            'minutos',
            'puntos',
            'rebotes',
            'asistencias',
        ],
    ]); ?>

        <h3>Equipo Visitante: <?= Html::encode($model->equipoVisitante->nombre) ?></h3>
        <?= GridView::widget([
        'dataProvider' => $dataProviderVisitante, // Utiliza el proveedor de datos para el equipo visitante
        'columns' => [
            'jugador.nombre', // Utiliza el nombre del jugador en lugar del nombreJugador
            'minutos',
            'puntos',
            'rebotes',
            'asistencias',
        ],
    ]); ?>

    </div>
<?php 
    } else { ?>
        <div class="partidos-jornada-view">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'fecha',
                'hora',
                'lugar',
                'resultado_local',
                'resultado_visitante',
                'observaciones:ntext',
            ],
        ]) ?>

        <h2>Estadísticas de Jugadores</h2>

        <h3>Equipo Local: <?= Html::encode($model->equipoLocal->nombre) ?></h3>
        <?= Html::a('Añadir Estadísticas', ['estadisticas-jugador-partido/form', 'idPartido' => $model->id, 'idEquipo' => $model->equipoLocal->id], ['class' => 'btn btn-success']) ?>
    <?= GridView::widget([
    'dataProvider' => $dataProviderLocal, // Utiliza el proveedor de datos para el equipo local
    'columns' => [
        'jugador.nombre', // Utiliza el nombre del jugador en lugar del nombreJugador
        'minutos',
        'puntos',
        'rebotes',
        'asistencias',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('Editar', ['estadisticas-jugador-partido/update', 'id' => $model->id], ['class' => 'btn btn-primary']);
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('Eliminar', ['estadisticas-jugador-partido/delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => '¿Estás seguro de que deseas eliminar esta estadística?',
                            'method' => 'post',
                        ],
                    ]);
                },
            ],
        ],
        
    ],
]); ?>

<h3>Equipo Visitante: <?= Html::encode($model->equipoVisitante->nombre) ?></h3>
<?= Html::a('Añadir Estadísticas', ['estadisticas-jugador-partido/form', 'idPartido' => $model->id, 'idEquipo' => $model->equipoVisitante->id], ['class' => 'btn btn-success']) ?>
<?= GridView::widget([
    'dataProvider' => $dataProviderVisitante, // Utiliza el proveedor de datos para el equipo visitante
    'columns' => [
        'jugador.nombre', // Utiliza el nombre del jugador en lugar del nombreJugador
        'minutos',
        'puntos',
        'rebotes',
        'asistencias',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('Editar', ['estadisticas-jugador-partido/update', 'id' => $model->id], ['class' => 'btn btn-primary']);
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('Eliminar', ['estadisticas-jugador-partido/delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => '¿Estás seguro de que deseas eliminar esta estadística?',
                            'method' => 'post',
                        ],
                    ]);
                },
            ],
        ],
        
    ],
]); ?>


        </div>
<?php } ?>
