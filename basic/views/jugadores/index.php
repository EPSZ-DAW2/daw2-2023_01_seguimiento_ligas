<?php
use yii\grid\GridView;
use yii\helpers\Html;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php $this->registerCssFile('@web/css/site.css'); ?>

    <style>
        /* Estilo para centrar los divs */
        .estadisticas-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .estadisticas-item {
            display: inline-block;
            width: 30%;
            text-align: left;
        }
    </style>

    <title>Tabla de Jugadores</title>
</head>
<body>

    <div class="marco">

    <!-- Sección de Estadísticas Destacadas -->
    <div class="estadisticas-container">
        <h2>Estadísticas Destacadas</h2>

        <!-- Div izquierdo: Jugador con más puntos -->
        <div class="estadisticas-item">
            <h3>Jugador con más puntos</h3>
            <h4>
            <?php
                $jugadorMasPuntos = \app\models\EstadisticasJugador::find()
                    ->orderBy(['puntos' => SORT_DESC])
                    ->one();

                echo $jugadorMasPuntos ? "{$jugadorMasPuntos->jugador->nombre} - Puntos: {$jugadorMasPuntos->puntos}" : 'Sin datos';
            ?>
            </h4>
            <?php
            if($jugadorMasPuntos) {
                $siguientesPuntos = \app\models\EstadisticasJugador::find()
                ->where(['not', ['id' => $jugadorMasPuntos->id]])
                ->orderBy(['puntos' => SORT_DESC])
                ->limit(2)
                ->all();
        
                foreach ($siguientesPuntos as $jugadorPuntos) {
                    echo "<p class='nombre-secundario'>{$jugadorPuntos->jugador->nombre}</p>";
                }
            }
            ?>
        </div>

        <!-- Div centro: Jugador con más asistencias -->
        <div class="estadisticas-item">
            <h3>Jugador con más asistencias</h3>
            <h4>
            <?php
                $jugadorMasAsistencias = \app\models\EstadisticasJugador::find()
                    ->orderBy(['asistencias' => SORT_DESC])
                    ->one();

                echo $jugadorMasAsistencias ? "{$jugadorMasAsistencias->jugador->nombre} - Asistencias: {$jugadorMasAsistencias->asistencias}" : 'Sin datos';
            ?>
            </h4>
            <?php
            if($jugadorMasAsistencias) {
                $siguientesAsistencias = \app\models\EstadisticasJugador::find()
                ->where(['not', ['id' => $jugadorMasAsistencias->id]])
                ->orderBy(['asistencias' => SORT_DESC])
                ->limit(2)
                ->all();
        
                foreach ($siguientesAsistencias as $jugadorAsistencias) {
                    echo "<p class='nombre-secundario'>{$jugadorAsistencias->jugador->nombre}</p>";
                }
            }
            ?>
        </div>

        <!-- Div derecho: Jugador con más rebotes -->
        <div class="estadisticas-item">
            <h3>Jugador con más rebotes</h3>
            <h4>
            <?php
                $jugadorMasRebotes = \app\models\EstadisticasJugador::find()
                    ->orderBy(['rebotes' => SORT_DESC])
                    ->one();

                echo $jugadorMasRebotes ? "{$jugadorMasRebotes->jugador->nombre} - Rebotes: {$jugadorMasRebotes->rebotes}" : 'Sin datos';
            ?>
            </h4>
            <?php
            if($jugadorMasRebotes) {
                $siguientesRebotes = \app\models\EstadisticasJugador::find()
                ->where(['not', ['id' => $jugadorMasRebotes->id]])
                ->orderBy(['rebotes' => SORT_DESC])
                ->limit(2)
                ->all();
        
                foreach ($siguientesRebotes as $jugadorRebotes) {
                    echo "<p class='nombre-secundario'>{$jugadorRebotes->jugador->nombre}</p>";
                }
            }
            ?>
        </div>
    </div>

    <!-- Sección de Tabla de Jugadores -->
    <div>
        <h2>Tabla de Jugadores</h2>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'nombre',
                'posicion',
                'descripcion',
                'altura',
                'peso',
                'nacionalidad',
                [
                    'attribute' => 'equipo.nombre',
                    'label' => 'Equipo',
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {delete}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['view', 'id' => $model->id]);
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'id' => $model->id]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id], [
                                'data' => [
                                    'confirm' => '¿Estás seguro de que quieres eliminar este elemento?',
                                    'method' => 'post',
                                ],
                            ]);
                        },
                    ],
                ],
            ],
        ]); ?>
    <br>

</body>
</html>
