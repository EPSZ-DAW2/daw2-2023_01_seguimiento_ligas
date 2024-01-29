<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Jugadores $model */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Jugadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
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
            'id',
            'id_equipo',
            'nombre',
            'descripcion',
            'id_imagen',
            'posicion',
            'altura',
            'peso',
            'nacionalidad',
        ],
    ]) ?>

</div>
