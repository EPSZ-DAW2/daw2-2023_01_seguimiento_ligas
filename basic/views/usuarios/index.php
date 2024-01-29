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

<div class="contenido-cabecera">

    <h1>USUARIOS DEL SISTEMA:</h1>

</div>

<div id="contenedor-izquierda">

    <div class="marco">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    
    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'tableOptions' => ['class' => 'table table-striped table-bordered', 'style' => 'background-color: rgba(255, 255, 255, 0.8); border: 2px solid #000;'],
    'summary' => '<p class="PaginaDeInicio">Mostrando {begin}-{end} de {totalCount} elementos</p>', // Personalizar el mensaje
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre:ntext',
            'apellido1:ntext',
            'apellido2:ntext',
            'email:ntext',
            'password:ntext',
            'provincia:ntext',
            'username:ntext',
            'id_rol:ntext',
            
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Usuarios $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Registro nuevo cliente'), ['create'], ['class' => 'botonFormulario']) ?>
    </p>
    </div>


</div>
