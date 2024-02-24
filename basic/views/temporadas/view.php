<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Temporadas $model */

$this->title = $temporada->texto_de_titulo;
//$this->params['breadcrumbs'][] = ['label' => 'Temporadas', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="contenido-cabecera">


    <h1>DATOS DE LA TEMPORADA <?= Html::encode($this->title) ?></h1>

</div>

<div id="contenedor-principal">

    <div class="marco">

        <p class="PaginaDeInicio">Datos de <?= Html::encode($this->title) ?></p>

        <?= DetailView::widget([
            'model' => $temporada,
            'options' => ['class' => 'table table-bordered detail-view', 'style' => 'background-color: rgba(255, 255, 255, 0.8); border: 1px solid #000;'], // Clase, fondo blanco y bordes
            'template' => "<tr><th style='width:20%; text-align: center; font-weight: bold;'>{label}</th><td style='width:80%; text-align: center;'>{value}</td></tr>", // Plantilla personalizada sin centrado
            'attributes' => [
                'id',
                'texto_de_titulo',
                'fecha_inicial',
                'fecha_final',
            ],
        ]) ?>

<p>
            <?= Html::a('Editar', ['update', 'id' => $temporada->id], ['class' => 'botonFormulario']) ?>
            <?= Html::a('Eliminar', ['delete', 'id' => $temporada->id], [
                'class' => 'botonFormulario',
                'data' => [
                    'confirm' => '¿Estás seguro de que deseas eliminar esta temporada?',
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a(Yii::t('app', 'Volver atrás'), ['temporadas/index'], ['class' => 'botonFormulario']) ?>
        </p>
    </div>
</div>
