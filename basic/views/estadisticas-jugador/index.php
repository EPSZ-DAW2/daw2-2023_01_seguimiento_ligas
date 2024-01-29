<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\grid\ActionColumn;
use yii\helpers\Url;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php $this->registerCssFile('@web/css/site.css'); ?>

    <title>Tabla de Estadísticas de Jugadores</title>
</head>
<body>

    <h2>Tabla de Estadísticas de Jugadores</h2>

    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'attribute' => 'jugador.nombre', // Obtener el nombre del jugador
                    'label' => 'Nombre',
                ],
                [
                    'attribute' => 'temporada.texto_de_titulo', // Obtener el título de la temporada
                    'label' => 'Temporada',
                ],
                'partidos_jugados',
                'puntos',
                'rebotes',
                'asistencias',
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, app\models\EstadisticasJugador $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                     }
                ],
            ],
        ]); 
        ?>
    <br>

</body>
</html>
