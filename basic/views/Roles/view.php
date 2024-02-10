<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Roles */

$this->title = $model->nombre; // Ajusta el campo que debería mostrarse como título
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Roles'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="contenido-cabecera">

<h1><?= Html::encode($this->title) ?></h1>

</div>


<div id="contenedor-principal">

    <div class="marco">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombre:ntext',
            // Agrega aquí los atributos adicionales del modelo Roles que deseas mostrar
        ],
    ]) ?>

    <p>
        <?= Html::a(Yii::t('app', 'Actualizar Rol'), ['update', 'id' => $model->id], ['class' => 'botonFormulario']) ?>
        <?= Html::a(Yii::t('app', 'Eliminar Rol'), ['delete', 'id' => $model->id], [
            'class' => 'botonFormulario',
            'data' => [
                'confirm' => Yii::t('app', '¿Estás seguro de que quieres eliminar este elemento?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'Tabla de Roles'), ['roles/index'], ['class' => 'botonFormulario']) ?>
    </p>

    </div>
</div>
