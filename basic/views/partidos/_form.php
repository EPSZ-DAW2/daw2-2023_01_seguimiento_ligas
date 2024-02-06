<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="marco">

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'lugar')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'horario')->textInput(['type' => 'datetime-local']) ?>

<?php
    // Obtener la fecha actual
    $fechaActual = new DateTime();

    // Obtener la fecha del partido
    $fechaPartido = new DateTime($model->horario);

    // Si la fecha del partido ha pasado
    if ($fechaActual > $fechaPartido) {
    ?>
        <?= $form->field($model, 'resultado_local')->textInput(['type' => 'number', 'options' => ['step' => '1']]) ?>

        <?=  $form->field($model, 'resultado_visitante')->textInput(['type' => 'number', 'options' => ['step' => '1']]) ?>
<?php
    } else {
            echo "Partido no jugado";
    }
?>


<div class="form-group">
    <?= Html::submitButton('Guardar Cambios', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>