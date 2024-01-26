<?php $this->registerCssFile('@web/css/equipos.css');

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Jornadas de la temporada ' . $temporada->texto_de_titulo;
$this->params['breadcrumbs'][] = $this->title;

echo GridView::widget([
    'dataProvider' => new \yii\data\ArrayDataProvider(['allModels' => $jornadas]),
    'columns' => [
        'fecha_jornada',
        [
            'label' => 'Equipo Local',
            'value' => function ($model) {
                // Acceder al modelo PartidosLocal a través de la relación
                //$partidoLocal = $model->partidosLocal;
                
                // Devolver el nombre del equipo local (ajusta según tu modelo Partidos)
               //return $partidoLocal ? $partidoLocal->nombre_equipo : 'N/A';
            },
        ],
        [
            'label' => 'Equipo Visitante',
            'value' => function ($model) {
                // Acceder al modelo PartidosVisitante a través de la relación
                //$partidoVisitante = $model->partidosVisitante;
                
                // Devolver el nombre del equipo visitante (ajusta según tu modelo Partidos)
                //return $partidoVisitante ? $partidoVisitante->nombre_equipo : 'N/A';
            },
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete}',
        ],
    ],
]);


?>