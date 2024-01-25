<?php

use app\models\Usuarios;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Usuarios');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div>

    <h1 class="PaginaDeInicio"><?= Html::encode($this->title) ?></h1>


    <div class="margenIzquierda">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    
    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'tableOptions' => ['class' => 'table table-striped table-bordered', 'style' => 'background-color: rgba(255, 255, 255, 0.8); border: 2px solid #000;'],
    'summary' => '<p class="subrayado">Mostrando {begin}-{end} de {totalCount} elementos</p>', // Personalizar el mensaje
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn'],

        [
            'attribute' => 'id',
            'contentOptions' => ['style' => 'font-weight: bold; text-align: center;'],
            'headerOptions' => ['style' => 'text-align: center;'], // Centrar la cabecera
        ],
        [
            'attribute' => 'nombre',
            'contentOptions' => ['style' => 'font-weight: bold; text-align: center;'],
            'headerOptions' => ['style' => 'text-align: center;'], // Centrar la cabecera
        ],
        [
            'attribute' => 'apellido1',
            'contentOptions' => ['style' => 'font-weight: bold; text-align: center;'],
            'headerOptions' => ['style' => 'text-align: center;'], // Centrar la cabecera
        ],
        [
            'attribute' => 'apellido2',
            'contentOptions' => ['style' => 'font-weight: bold; text-align: center;'],
            'headerOptions' => ['style' => 'text-align: center;'], // Centrar la cabecera
        ],
        [
            'attribute' => 'email',
            'contentOptions' => ['style' => 'font-weight: bold; text-align: center;'],
            'headerOptions' => ['style' => 'text-align: center;'], // Centrar la cabecera
        ],
        [
            'attribute' => 'password',
            'contentOptions' => ['style' => 'font-weight: bold; text-align: center;'],
            'headerOptions' => ['style' => 'text-align: center;'], // Centrar la cabecera
        ],
        [
            'attribute' => 'provincia',
            'contentOptions' => ['style' => 'font-weight: bold; text-align: center;'],
            'headerOptions' => ['style' => 'text-align: center;'], // Centrar la cabecera
        ],
        [
            'attribute' => 'username',
            'contentOptions' => ['style' => 'font-weight: bold; text-align: center;'],
            'headerOptions' => ['style' => 'text-align: center;'], // Centrar la cabecera
        ],
        [
            'attribute' => 'id_rol',
            'contentOptions' => ['style' => 'font-weight: bold; text-align: center;'],
            'headerOptions' => ['style' => 'text-align: center;'], // Centrar la cabecera
        ],
        [
            'class' => ActionColumn::className(),
            'urlCreator' => function ($action, Usuarios $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id' => $model->id]);
            },
            'contentOptions' => ['style' => 'font-weight: bold; color: red; text-align: center;'],
        ],
    ], 
    ]); ?>

    <?php Pjax::end(); ?>

    </div>

    <p>
        <?= Html::a(Yii::t('app', 'Registro nuevo cliente'), ['create'], ['class' => 'botonInicioSesion']) ?>
    </p>
</div>
