<?php 
use app\models\Ligas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\LigasSearch;


if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 3)) {    
    foreach ($ligas as $liga): ?>
    <div class="liga-container">
        <a href="<?= Yii::$app->urlManager->createUrl(['equipos/index', 'ligaId' => $liga->id]) ?>">
            <div class="liga-content">
                <h2><?= $liga->nombre ?></h2>
            </div>
            <div class="liga-image" style="background-image: url('<?= Yii::getAlias('@web/images/' . $liga->imagen->foto) ?>');"></div>
        </a>
    </div>
<?php endforeach; ?>

<?php } else { ?>

<?php


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
                    return Html::tag('div', '', [
                        'class' => 'liga-image',
                        'style' => 'background-image: url("' . Yii::getAlias('@web/images/' . $model->imagen->foto) . '");',
                    ]);
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


<?php } ?>
