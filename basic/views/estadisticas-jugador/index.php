<?php
use app\models\Usuarios;
use app\models\Ligas;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\grid\ActionColumn;
use yii\helpers\Url;
use yii\widgets\Pjax;

if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2)) {
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
                    $puntos = $jugadorPuntos->puntos !== null ? $jugadorPuntos->puntos : 'Sin datos';
                    echo "<p class='nombre-secundario'>{$jugadorPuntos->jugador->nombre}: {$puntos}</p>";
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
                    $asistencias = $jugadorAsistencias->asistencias !== null ? $jugadorAsistencias->asistencias : 'Sin datos';
                    echo "<p class='nombre-secundario'>{$jugadorAsistencias->jugador->nombre}: {$asistencias}</p>";
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
                    $rebotes = $jugadorRebotes->rebotes !== null ? $jugadorRebotes->rebotes : 'Sin datos';
                    echo "<p class='nombre-secundario'>{$jugadorRebotes->jugador->nombre}: {$rebotes}</p>";
                }
            }
            ?>
        </div>
    </div>
</div>

        <div class="marco">
        <?php
        echo Html::beginForm(['estadisticas-jugador/index'], 'get');
        echo Html::dropDownList('ligaId', Yii::$app->request->get('ligaId'), \yii\helpers\ArrayHelper::map($ligas, 'id', 'nombre'), ['prompt' => 'Selecciona una liga']);
        echo Html::submitButton('Filtrar', ['class' => 'btn btn-primary']);
        echo Html::endForm();
        ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'tableOptions' => ['class' => 'table table-striped table-bordered', 'style' => 'background-color: rgba(255, 255, 255, 0.8); border: 2px solid #000;'],
            'summary' => '<p class="PaginaDeInicio">Mostrando {begin}-{end} de {totalCount} elementos</p>',
            'emptyText' => 'No se encontraron resultados.',
            'pager' => [
                'linkOptions' => ['class' => 'btn'],
            ],
            'columns' => [
                [
                    'label' => 'Nombre del Jugador',
                    'attribute' => 'id_jugador',
                    'value' => 'jugador.nombre',
                ],
                [
                    'label' => 'Nombre del Equipo',
                    'attribute' => 'id_equipo',
                    'value' => 'equipo.nombre',
                ],
                [
                    'label' => 'Temporada',
                    'attribute' => 'id_temporada',
                    'value' => 'temporada.texto_de_titulo',
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
            <?php
            echo Html::beginForm(['estadisticas-jugador/index'], 'get');
            echo Html::dropDownList('ligaId', Yii::$app->request->get('ligaId'), \yii\helpers\ArrayHelper::map($ligas, 'id', 'nombre'), ['prompt' => 'Selecciona una liga']);
            echo Html::submitButton('Filtrar', ['class' => 'btn btn-primary']);
            echo Html::endForm();
            ?>
            <br>        
            <?= Html::a('Mostrar todos los registros', ['index', 'showAll' => true], ['class' => 'btn btn-primary']) ?>
            <br>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => ['class' => 'table table-striped table-bordered', 'style' => 'background-color: rgba(255, 255, 255, 0.8); border: 2px solid #000;'],
                'summary' => '<p class="PaginaDeInicio">Mostrando {begin}-{end} de {totalCount} elementos</p>',
                'emptyText' => 'No se encontraron resultados.',
                'pager' => [
                    'linkOptions' => ['class' => 'btn'],
                ],
                'columns' => [
                    [
                        'label' => 'Nombre del Jugador',
                        'attribute' => 'id_jugador',
                        'value' => 'jugador.nombre',
                    ],
                    [
                        'label' => 'Nombre del Equipo',
                        'attribute' => 'id_equipo',
                        'value' => 'equipo.nombre',
                    ],
                    [
                        'label' => 'Temporada',
                        'attribute' => 'id_temporada',
                        'value' => 'temporada.texto_de_titulo',
                    ],
                    'partidos_jugados',
                    'puntos',
                    'rebotes',
                    'asistencias',
                    [
                        'attribute' => 'activo',
                        'value' => function ($model) {
                            return $model->activo ? 'Activo' : 'Inactivo';
                        },
                    ],
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, app\models\EstadisticasJugador $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                         }
                    ],
                ],
            ]); ?>


        <?= Html::a('Actualizar Estadísticas', ['actualizar-estadisticas'], ['class' => 'botonFormulario']) ?>
        </div>
    </div>
</body>
</html>
<?php } ?>

