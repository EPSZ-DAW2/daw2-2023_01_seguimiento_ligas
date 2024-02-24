<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Equipos */

$this->title = "JORNADA " . $jornada->numero;
//$this->params['breadcrumbs'][] = ['label' => 'Temporada', 'url' => ['jornadas/index', 'id' => $jornada->id_temporada]];
//$this->params['breadcrumbs'][] = $this->title;
?>


<div class="contenido-cabecera">

    <h1>DATOS DE LA <?= Html::encode($this->title) ?></h1>

</div>

<div id="contenedor-principal">
    <div class="marco">

        <p class="PaginaDeInicio">Datos de la Jornada</p>
        <?= DetailView::widget([
            'model' => $jornada,
            'options' => ['class' => 'table table-bordered detail-view', 'style' => 'background-color: rgba(255, 255, 255, 0.8); border: 1px solid #000;'], // Clase, fondo blanco y bordes
            'template' => "<tr><th style='width:20%; text-align: center; font-weight: bold;'>{label}</th><td style='width:80%; text-align: center;'>{value}</td></tr>", // Plantilla personalizada sin centrado
            'attributes' => [
                'id',
                'numero',
                'fecha_inicio',
                'fecha_final',
            ],
        ]) ?>

        
<p>
            <?= Html::a('Editar', ['update', 'id' => $jornada->id], ['class' => 'botonFormulario']) ?>
            <?= Html::a('Eliminar', ['delete', 'id' => $jornada->id], [
                'class' => 'botonFormulario',
                'data' => [
                    'confirm' => '¿Estás seguro de que deseas eliminar esta jornada?',
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a('Volver atrás', ['index', 'id' => $jornada->temporada->id], ['class' => 'botonFormulario']) ?>


        </p>

    </div>
</div>
