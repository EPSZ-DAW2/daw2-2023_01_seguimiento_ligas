<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="marco">

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'lugar')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'horario')->textInput(['type' => 'datetime-local']) ?>

<div class="form-group">
    <?= Html::submitButton('Guardar Cambios', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>