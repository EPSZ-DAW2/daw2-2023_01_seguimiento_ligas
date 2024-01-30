<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Ligas;

/** @var yii\web\View $this */
/** @var app\models\Ligas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="marco">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'nombre', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'pais', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($imagenModel, 'imagenFile', ['options' => ['class' => 'campoTitulo']])->fileInput(['class' => 'campo']) ?>
    <br>

    <?= Html::submitButton('Guardar', ['class' => 'botonFormulario']) ?>

    <?php ActiveForm::end(); ?>

</div>
