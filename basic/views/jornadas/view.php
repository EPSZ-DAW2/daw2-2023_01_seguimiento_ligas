<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Equipos */

$this->title = "Jornada " . $jornada->numero;
$this->params['breadcrumbs'][] = ['label' => 'Temporada', 'url' => ['jornadas/index', 'id' => $jornada->id_temporada]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marco2">
<div class="equipos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Editar', ['update', 'id' => $jornada->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $jornada->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Estás seguro de que deseas eliminar esta jornada?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $jornada,
        'attributes' => [
            'id',
            'numero',
            'fecha_inicio',
            'fecha_final',
        ],
    ]) ?>

</div>
</div>
