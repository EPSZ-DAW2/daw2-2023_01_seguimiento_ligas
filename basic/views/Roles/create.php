<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Roles */

$this->title = Yii::t('app', 'Crear Nuevo Rol');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Roles'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="contenido-cabecera">

    <h1><?= Html::encode($this->title) ?></h1>

    </div>

    <div  id="contenedor-principal">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    </div>
