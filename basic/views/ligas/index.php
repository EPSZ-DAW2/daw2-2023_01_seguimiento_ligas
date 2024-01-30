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
    <div class="contenido-cabecera">

    <h1>LIGAS:</h1>

    </div>

    <div id="contenedor-principal">

    <div class="marco" style="display: inline-block; margin-right: 10px;">
        <a href="<?= Yii::$app->urlManager->createUrl(['equipos/ver-por-liga', 'ligaId' => $liga->id]) ?>">
            <div class="liga-content">
                <h2><?= $liga->nombre ?></h2>
            </div>
            <div class="liga-image" style="background-image: url('<?= Yii::getAlias('@web/images/' . $liga->imagen->foto) ?>');"></div>
        </a>
    </div>
    </div>
<?php endforeach; ?>

<?php } else { ?>

<?php


/* @var $this yii\web\View */
/* @var $searchModel app\models\LigasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('app', 'Ligas');
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="contenido-cabecera">

    <h1>LIGAS:</h1>

</div>


<div  id="contenedor-principal">


    <div class="marco">

    <?php Pjax::begin(); ?>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
    <p class="PaginaDeInicio">Listado de Ligas:</p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-bordered', 'style' => 'background-color: rgba(255, 255, 255, 0.8); border: 2px solid #000;'],
        'summary' => '<p class="PaginaDeInicio">Mostrando {begin}-{end} de {totalCount} elementos</p>', // Personalizar el mensaje
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
                },
                
            ],
        ],
    ]); ?>


    <?php Pjax::end(); ?>

        <?= Html::a(Yii::t('app', 'Crear Nueva Liga'), ['create'], ['class' => 'botonFormulario']) ?>
        <?= Html::a(Yii::t('app', 'Ir a Inicio'), Yii::$app->homeUrl, ['class' => 'botonFormulario']) ?>

    </div>
</div>


<?php } ?>
