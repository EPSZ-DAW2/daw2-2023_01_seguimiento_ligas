<?php

use app\models\Ligas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\LigasSearch;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LigasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ligas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ligas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Crear Nueva Liga'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'imagen',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->imagen ? Html::img(Yii::getAlias('@web/' . $model->imagen->foto), ['class' => 'equipo-imagen', 'width' => '50px']) : 'Imagen no encontrada';
                },
            ],
            'nombre:ntext',
            'pais:ntext',

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Ligas $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
