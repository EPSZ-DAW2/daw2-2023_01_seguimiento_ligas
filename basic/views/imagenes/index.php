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
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="imagenes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Subir nueva imagen'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
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

    <?php Pjax::end(); ?>

</div>
