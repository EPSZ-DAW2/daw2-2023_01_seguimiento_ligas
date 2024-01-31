<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = Yii::t('app', 'Registro nuevo cliente');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="contenido-cabecera">

<h1>REGISTRO DE USUARIOS</h1>

</div>

<div  id="contenedor-principal">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
