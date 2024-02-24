<?php 
use app\models\Ligas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\LigasSearch;


if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2 && Yii::$app->user->identity->id_rol != 4)) {
    
   foreach ($ligas as $liga): ?>
  <?php if($liga->estado == 'Activa'){?>
    <div class="contenido-cabecera">

    <h1>LIGAS</h1>

    </div>

    <div id="contenedor-principal">
    <div class="marco2">
            <div class="liga-content">
                <a href="<?= Yii::$app->urlManager->createUrl(['equipos/ver-por-liga', 'ligaId' => $liga->id]) ?>">
                    <h2><?= $liga->nombre ?></h2>
                </a>
                <p class="PaginaDeInicio"><?= $liga->descripcion ?><p>
                <p class="PaginaDeInicio"><?= $liga->pais ?><p>
            </div>
            <div class="liga-image" style="background-image: url('<?= Yii::getAlias('@web/images/' . $liga->imagen->foto) ?>');"></div>
            </br>
        <iframe width="560" height="315" src="<?= Html::encode($liga->video) ?>"
        title="YouTube video player" frameborder="0"
        allowfullscreen></iframe>

    </div>
    </div>
<?php }endforeach; ?>
<?php 
} else { ?>

<?php


/* @var $this yii\web\View */
/* @var $searchModel app\models\LigasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('app', 'Ligas');
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="contenido-cabecera">

    <h1>LIGAS</h1>

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
            'descripcion:ntext',
            'pais:ntext',
            'video:ntext',
            'estado:ntext',

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
