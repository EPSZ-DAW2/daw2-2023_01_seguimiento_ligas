<?php

use app\models\Imagenes;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Imágenes');
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="contenido-cabecera">

    <h1>IMAGENES</h1>

</div>

<div id="contenedor-izquierda">

    <div class="marco">

    <?php Pjax::begin(); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'table table-striped table-bordered', 'style' => 'background-color: rgba(255, 255, 255, 0.8); border: 2px solid #000;'],
        'summary' => '<p class="PaginaDeInicio">Mostrando {begin}-{end} de {totalCount} elementos</p>', // Personalizar el mensaje
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'foto',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::img(Url::to('@web/images/' . $model->foto), ['width' => '50px']);
                },
            ],
            
          
        ],

    ]); ?>


    <p>
        <?= Html::a(Yii::t('app', 'Subir nueva imagen'), ['create'], ['class' => 'botonFormulario']) ?>
    </p>

    <?php Pjax::end(); ?>
    </div>
</div>
