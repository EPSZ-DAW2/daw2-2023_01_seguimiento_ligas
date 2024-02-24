<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Ligas */

$this->title = $model->nombre;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ligas'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="contenido-cabecera">

    <h1>DATOS DE LA LIGA <?= Html::encode($this->title) ?></h1>

</div>
<div id="contenedor-principal">

    <div class="marco">
    <p class="PaginaDeInicio">Datos de la liga <?= Html::encode($this->title) ?>:</p>

    <?= DetailView::widget([
        'model' => $model,
        'options' => ['class' => 'table table-bordered detail-view', 'style' => 'background-color: rgba(255, 255, 255, 0.8); border: 1px solid #000;'], // Clase, fondo blanco y bordes
        'template' => "<tr><th style='width:20%; text-align: center; font-weight: bold;'>{label}</th><td style='width:80%; text-align: center;'>{value}</td></tr>", // Plantilla personalizada sin centrado
        'attributes' => [
            'id',
            'nombre',
            'descripcion',
            'pais',
            'id_imagen',
            'video',
            'estado',
        ],
    ]) ?>

    <p>
        <?= Html::a(Yii::t('app', 'Actualizar Liga'), ['update', 'id' => $model->id], ['class' => 'botonFormulario']) ?>
        <?= Html::a(Yii::t('app', 'Borrar Liga'), ['delete', 'id' => $model->id], [
            'class' => 'botonFormulario',
            'data' => [
                'confirm' => Yii::t('app', '¿Estás seguro de que quieres eliminar este elemento?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'Tabla de ligas'), ['ligas/index'], ['class' => 'botonFormulario']) ?>
    </p>

</div>
