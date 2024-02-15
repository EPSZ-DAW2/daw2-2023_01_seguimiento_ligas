<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Equipos */

$this->title = $equipo->nombre;
//$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>


<div class="contenido-cabecera">  
    
    <h1>DATOS DE <?= $equipo->nombre; ?></h1>  

</div>

<div id="contenedor-principal">


    <div class="marco">

        <p class="PaginaDeInicio">Datos:</p>

        <?= DetailView::widget([
            'model' => $equipo,
            'options' => ['class' => 'table table-bordered detail-view', 'style' => 'background-color: rgba(255, 255, 255, 0.8); border: 1px solid #000;'], // Clase, fondo blanco y bordes
            'template' => "<tr><th style='width:20%; text-align: center; font-weight: bold;'>{label}</th><td style='width:80%; text-align: center;'>{value}</td></tr>", // Plantilla personalizada sin centrado
            'attributes' => [
                'id',
                [
                    'attribute' => 'Liga',
                    'value' => function ($model) {
                        return $model->liga->nombre;
                    }
                ],
                [
                    'attribute' => 'Temporada',
                    'value' => function ($model) {
                        return $model->temporada->texto_de_titulo;
                    }
                ],
                'nombre',
                'descripcion',
                [
                    'attribute' => 'Gestor del Equipo',
                    'value' => function ($model) {
                        return $model->usuario ? $model->usuario->nombre : null;
                    }
                ],
            ],
        ]) ?>

        <p>
            <?= Html::a('Editar', ['update', 'id' => $equipo->id], ['class' => 'botonFormulario']) ?>
            <?= Html::a('Eliminar', ['delete', 'id' => $equipo->id], [
                'class' => 'botonFormulario',
                'data' => [
                    'confirm' => '¿Estás seguro de que deseas eliminar este equipo?',
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a(Yii::t('app', 'Atras'), ['index'], ['class' => 'botonFormulario']) ?>
        </p>
    </div>
</div>
