<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Jugadores $model */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Jugadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 5)) {
?>

<div class="jugadores-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Ver Estadísticas', ['estadisticas-jugador/view', 'id' => $model->estadisticasJugador ? $model->estadisticasJugador->id : null], ['class' => 'btn btn-info']) ?>

    </p>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'id_imagen',
                'format' => 'html',
                'value' => function ($model) {
                    $imagen = \app\models\Imagenes::findOne($model->id_imagen);

                    if ($imagen && $imagen->foto) {
                        $urlImagen = Yii::getAlias('@web/images/') . $imagen->foto;
                        return Html::img($urlImagen, ['alt' => 'Foto de jugador', 'style' => 'width: 60px; height: 60px;']);
                    }
    
                    return 'Sin foto';
                },
            ],
            'id',
            'id_equipo',
            'nombre',
            'descripcion',
            'posicion',
            'altura',
            'peso',
            'nacionalidad',
            'video',
        ],
    ]) ?>

</div>

<?php
    } else { ?>
    <div class="jugadores-view">

<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Delete', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
        ],
    ]) ?>

    <?= Html::a('Ver Estadísticas', ['estadisticas-jugador/view', 'id' => $model->estadisticasJugador ? $model->estadisticasJugador->id : null], ['class' => 'btn btn-info']) ?>

</p>


<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        [
            'attribute' => 'id_imagen',
            'format' => 'html',
            'value' => function ($model) {
                $imagen = \app\models\Imagenes::findOne($model->id_imagen);

                if ($imagen && $imagen->foto) {
                    $urlImagen = Yii::getAlias('@web/images/') . $imagen->foto;
                    return Html::img($urlImagen, ['alt' => 'Foto de jugador', 'style' => 'width: 60px; height: 60px;']);
                }

                return 'Sin foto';
            },
        ],
        'id',
        'id_equipo',
        'nombre',
        'descripcion',
        'posicion',
        'altura',
        'peso',
        'nacionalidad',
        'video',
    ],
]) ?>

</div>
<?php } ?>