<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = Yii::t('app', 'Actualizar liga: {name}', [
    'name' => $model->nombre,
]);
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = Yii::t('app', 'Actualizar');
?>

<div class="contenido-cabecera">

    <h1>MODIFICAR DATOS DE LA LIGA <?= Html::encode($model->nombre) ?></h1>

</div>

<div id="contenedor-principal">

    <?= $this->render('_form', [
    'model' => $model,
    'imagenModel' => $imagenModel,
]) ?>
</div>
