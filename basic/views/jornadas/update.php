<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = " Actualizar Jornada " . $jornada->numero;
$this->params['breadcrumbs'][] = ['label' => 'Temporada', 'url' => ['jornadas/index', 'id' => $jornada->id_temporada]];
$this->params['breadcrumbs'][] = 'Actualizar';

?>

<div class="equipos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($jornada, 'numero')->textInput([
        'maxlength' => true,
        'type' => 'number', // Establecer el tipo como "number"
        'pattern' => '[0-9]*', // Expresión regular para aceptar solo números
    ]) ?>

    <?= $form->field($jornada, 'fecha_inicio')->widget(\yii\jui\DatePicker::class, [
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control'],
    ]) ?>

    <?= $form->field($jornada, 'fecha_final')->widget(\yii\jui\DatePicker::class, [
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control'],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Actualizar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>