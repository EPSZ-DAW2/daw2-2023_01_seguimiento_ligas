<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Roles */

$this->title = Yii::t('app', 'Actualizar Rol {name}', [
    'name' => $model->id,
]);
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Roles'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = Yii::t('app', 'Actualizar');
?>
<div class="contenido-cabecera">

<h1><?= Html::encode($this->title) ?></h1>

</div>

<div  id="contenedor-principal">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
