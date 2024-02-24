<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\grid\ActionColumn;
use yii\helpers\Url;

if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2  && Yii::$app->user->identity->id_rol != 6)) {
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
    <div class="contenido-cabecera">
        <h1>ESTADISTICA DE JUGADORES</h1>
    </div>

    
<div id="contenedor-principal">
    <div class="marco">
    <div class="estadisticas-container">
        <div class="estadistica">
            <h3>Jugador con más puntos</h3>
            <h4>
            <?php
                $jugadorMasPuntos = \app\models\EstadisticasJugador::find()
                    ->orderBy(['puntos' => SORT_DESC])
                    ->one();

                echo $jugadorMasPuntos ? "{$jugadorMasPuntos->jugador->nombre}: {$jugadorMasPuntos->puntos}" : 'Sin datos';
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
        
        <div class="estadistica">
            <h3>Jugador con más asistencias</h3>
            <h4>
            <?php
                $jugadorMasAsistencias = \app\models\EstadisticasJugador::find()
                    ->orderBy(['asistencias' => SORT_DESC])
                    ->one();

                echo $jugadorMasAsistencias ? "{$jugadorMasAsistencias->jugador->nombre}: {$jugadorMasAsistencias->asistencias}" : 'Sin datos';
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
        
        <div class="estadistica">
            <h3>Jugador con más rebotes</h3>
            <h4>
            <?php
                $jugadorMasRebotes = \app\models\EstadisticasJugador::find()
                    ->orderBy(['rebotes' => SORT_DESC])
                    ->one();

                echo $jugadorMasRebotes ? "{$jugadorMasRebotes->jugador->nombre}: {$jugadorMasRebotes->rebotes}" : 'Sin datos';
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
</div>

        <div class="marco">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'tableOptions' => ['class' => 'table table-striped table-bordered', 'style' => 'background-color: rgba(255, 255, 255, 0.8); border: 2px solid #000;'],
                'summary' => '<p class="PaginaDeInicio">Mostrando {begin}-{end} de {totalCount} elementos</p>', // Personalizar el mensaje
                'emptyText' => 'No se encontraron resultados.', // Personalizar el mensaje para cuando no hay resultados
                'columns' => [
                    [
                        'label' => 'Nombre', // Etiqueta de la columna
                        'attribute' => 'jugador.nombre', // Utiliza el nombre del jugador
                    ],
                    [
                        'label' => 'Equipo', // Etiqueta de la columna
                        'attribute' => 'equipo.nombre', // Utiliza el nombre del equipo
                    ],
                    [
                        'label' => 'Temporada', // Etiqueta de la columna
                        'attribute' => 'temporada.texto_de_titulo', // Utiliza el texto de título de la temporada
                    ],
                    'partidos_jugados',
                    'puntos',
                    'rebotes',
                    'asistencias',
                ],
            ]); ?>
        </div>
    </div>
</body>
</html>

<?php
} else { ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $this->registerCssFile('@web/css/site.css'); ?>
    <title>Tabla de Estadísticas de Jugadores</title>
</head>
<body>
    <div class="contenido-cabecera">
        <h1>ESTADISTICA DE JUGADORES</h1>
    </div>

    <div  id="contenedor-principal">

        <div class="marco">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'tableOptions' => ['class' => 'table table-striped table-bordered', 'style' => 'background-color: rgba(255, 255, 255, 0.8); border: 2px solid #000;'],
                'summary' => '<p class="PaginaDeInicio">Mostrando {begin}-{end} de {totalCount} elementos</p>', // Personalizar el mensaje
                'emptyText' => 'No se encontraron resultados.', // Personalizar el mensaje para cuando no hay resultados
                'columns' => [
                    [
                        'label' => 'Nombre',
                        'attribute' => 'jugador.nombre',
                    ],
                    [
                        'label' => 'Equipo',
                        'attribute' => 'equipo.nombre',
                    ],
                    [
                        'label' => 'Temporada',
                        'attribute' => 'temporada.texto_de_titulo',
                    ],
                    'partidos_jugados',
                    'puntos',
                    'rebotes',
                    'asistencias',
                    [
                        'class' => ActionColumn::class,
                        'template' => '{update} {view} {delete}',
                        'buttons' => [
                            'update' => function ($url, $model, $key) {
                                return Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'botonFormulario']);
                            },
                            'view' => function ($url, $model, $key) {
                                return Html::a('Ver', ['view', 'id' => $model->id], ['class' => 'botonFormulario']);
                            },
                            'delete' => function ($url, $model, $key) {
                                return Html::a('Eliminar', ['delete', 'id' => $model->id], [
                                    'class' => 'botonFormulario',
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



        <?= Html::a('Actualizar Estadísticas', ['actualizar-estadisticas'], ['class' => 'botonFormulario']) ?>
        </div>
    </div>
</body>
</html>
<?php } ?>

