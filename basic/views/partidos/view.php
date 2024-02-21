<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\EstadisticasJugador;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\PartidosJornada */

$this->title = 'Detalles del Partido: ' . $model->equipoLocal->nombre . ' vs ' . $model->equipoVisitante->nombre;
//$this->params['breadcrumbs'][] = ['label' => 'Partidos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>


<div class="contenido-cabecera">

    <h1>DETALLES DEL PARTIDO</h1>

</div>

<div id="contenedor-principal">

<div class="marco">

<?php
if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2)) {
?>

        <p class="PaginaDeInicio"><?= Html::encode($this->title) ?></p>

        <?= DetailView::widget([
            'model' => $model,
            'options' => ['class' => 'table table-bordered detail-view', 'style' => 'background-color: rgba(255, 255, 255, 0.8); border: 1px solid #000;'], // Clase, fondo blanco y bordes
            'template' => "<tr><th style='width:20%; text-align: center; font-weight: bold;'>{label}</th><td style='width:80%; text-align: center;'>{value}</td></tr>", // Plantilla personalizada sin centrado
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


<?php 
    } else { ?>

        <p class="PaginaDeInicio"><?= Html::encode($this->title) ?></p>

        <?= DetailView::widget([
            'model' => $model,
            'options' => ['class' => 'table table-bordered detail-view', 'style' => 'background-color: rgba(255, 255, 255, 0.8); border: 1px solid #000;'], // Clase, fondo blanco y bordes
            'template' => "<tr><th style='width:20%; text-align: center; font-weight: bold;'>{label}</th><td style='width:80%; text-align: center;'>{value}</td></tr>", // Plantilla personalizada sin centrado
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

        <br>

        <p class="PaginaDeInicio">Estadísticas de Jugadores</p>

        <p class="PaginaDeInicio">Equipo Local: <?= Html::encode($model->equipoLocal->nombre) ?></p>
        <?= GridView::widget([
        'dataProvider' => $dataProviderLocal, // Utiliza el proveedor de datos para el equipo local
        'tableOptions' => ['class' => 'table table-striped table-bordered', 'style' => 'background-color: rgba(255, 255, 255, 0.8); border: 2px solid #000;'],
        'summary' => '<p class="PaginaDeInicio">Mostrando {begin}-{end} de {totalCount} elementos</p>', // Personalizar el mensaje
        'emptyText' => 'No se encontraron resultados.', // Personalizar el mensaje para cuando no hay resultados
        'columns' => [
            'jugador.nombre', // Utiliza el nombre del jugador en lugar del nombreJugador
            'minutos',
            'puntos',
            'rebotes',
            'asistencias',
        ],
        ]); ?>
        <p>
         <?= Html::a('Añadir Estadísticas', ['estadisticas-jugador-partido/form', 'idPartido' => $model->id, 'idEquipo' => $model->equipoLocal->id], ['class' => 'botonFormulario']) ?>
        </p>
        <br>
        <p class="PaginaDeInicio">Equipo Visitante: <?= Html::encode($model->equipoVisitante->nombre) ?></p>
        
        <?= GridView::widget([
        'dataProvider' => $dataProviderVisitante, // Utiliza el proveedor de datos para el equipo visitante
        'tableOptions' => ['class' => 'table table-striped table-bordered', 'style' => 'background-color: rgba(255, 255, 255, 0.8); border: 2px solid #000;'],
        'summary' => '<p class="PaginaDeInicio">Mostrando {begin}-{end} de {totalCount} elementos</p>', // Personalizar el mensaje
        'emptyText' => 'No se encontraron resultados.', // Personalizar el mensaje para cuando no hay resultados
        'columns' => [
            'jugador.nombre', // Utiliza el nombre del jugador en lugar del nombreJugador
            'minutos',
            'puntos',
            'rebotes',
            'asistencias',
        ],
        ]); ?>
        <?= Html::a('Añadir Estadísticas', ['estadisticas-jugador-partido/form', 'idPartido' => $model->id, 'idEquipo' => $model->equipoVisitante->id], ['class' => 'botonFormulario']) ?>

<?php } ?>
    <br>
    <hr>
    <?= Html::a(Yii::t('app', 'Actualizar Partido'), ['update', 'id' => $model->id], ['class' => 'botonFormulario']) ?>
    <?= Html::a(Yii::t('app', 'Borrar Partido'), ['delete', 'id' => $model->id], [
            'class' => 'botonFormulario',
            'data' => [
                'confirm' => Yii::t('app', '¿Estás seguro de que quieres eliminar este elemento?'),
                'method' => 'post',
            ],
        ]) ?>
    <?= Html::a(Yii::t('app', 'Atras'), ['index'], ['class' => 'botonFormulario']) ?>
    </div>
</div>