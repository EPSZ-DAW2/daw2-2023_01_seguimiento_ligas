<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = Yii::t('app', 'MODIFICACIÓN DE DATOS DE {name}', [
    'name' => $model->nombre,
]);
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<div class="contenido-cabecera">

<h1><?= Html::encode($this->title) ?></h1>

</div>

<div id="contenedor-principal">

    <?= $this->render('_formUpdate', [
        'model' => $model,
        'imagenModel' => $imagenModel,
    ]) ?>

</div>
