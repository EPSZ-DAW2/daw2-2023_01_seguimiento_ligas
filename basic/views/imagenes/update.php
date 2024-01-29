<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Imagenes */

$this->title = Yii::t('app', 'Actualizar Imagen: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Imágenes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Actualizar');
?>
<div class="imagenes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_imagenes', [
        'model' => $model,
    ]) ?>

    <!-- Aquí se muestra la imagen -->
    <div>
        <?= Html::img($model->ruta, ['class' => 'img-thumbnail']) ?>
    </div>

</div>
