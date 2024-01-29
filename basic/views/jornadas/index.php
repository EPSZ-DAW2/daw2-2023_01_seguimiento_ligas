<?php $this->registerCssFile('@web/css/equipos.css');

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Jornadas de ' . $temporada->texto_de_titulo;
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="marco">

<?php
echo GridView::widget([
    'dataProvider' => new \yii\data\ArrayDataProvider(['allModels' => $jornadas]),
    'columns' => [
        [
            'attribute' => 'fecha_inicio',
            'format' => ['datetime', 'php:d/m/Y'], // Formatea la fecha de inicio
        ],
        [
            'attribute' => 'fecha_final',
            'format' => ['datetime', 'php:d/m/Y'], // Formatea la fecha final
        ],
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
        //funciones del gestor
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete}',
        ],

    ],
]);


?>
</div>