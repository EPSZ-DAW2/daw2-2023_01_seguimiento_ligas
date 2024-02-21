<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>


<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'lugar', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
<br>
<?= $form->field($model, 'horario', ['options' => ['class' => 'campoTitulo']])->textInput(['type' => 'datetime-local', 'class' => 'campo']) ?>
<br>
<?php
    // Obtener la fecha actual
    $fechaActual = new DateTime();

    // Obtener la fecha del partido
    $fechaPartido = new DateTime($model->horario);

    // Si la fecha del partido ha pasado
    if ($fechaActual > $fechaPartido) {
    ?>
        <?= $form->field($model, 'resultado_local', ['options' => ['class' => 'campoTitulo']])->textInput(['type' => 'number', 'options' => ['step' => '1'], 'class' => 'campo']) ?>

        <?=  $form->field($model, 'resultado_visitante', ['options' => ['class' => 'campoTitulo']])->textInput(['type' => 'number', 'options' => ['step' => '1'], 'class' => 'campo']) ?>
<?php
    } else {
            echo "Partido no jugado";
            ?>
            <br>
<?php
    }
?>
<br>
<p>
    <?= Html::submitButton('Guardar Cambios', ['class' => 'botonFormulario']) ?>
    <?= Html::a(Yii::t('app', 'Partidos'), ['index'], ['class' => 'botonFormulario']) ?>
</p>

<?php ActiveForm::end(); ?>
