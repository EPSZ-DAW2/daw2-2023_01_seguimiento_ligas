<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Temporadas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="temporadas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'texto_de_titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_inicial')->textInput() ?>

    <?= $form->field($model, 'fecha_final')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
