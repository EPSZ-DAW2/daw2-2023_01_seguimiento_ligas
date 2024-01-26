<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Temporadas $model */

$this->title = 'Crear Temporada';

// Registrar el archivo CSS
$this->registerCssFile('@web/css/equipos.css');

$this->params['breadcrumbs'][] = ['label' => 'Temporadas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="marco">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'texto_de_titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_inicial')->widget(\yii\jui\DatePicker::class, [
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control'],
    ]) ?>

    <?= $form->field($model, 'fecha_final')->widget(\yii\jui\DatePicker::class, [
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control'],
    ]) ?>
    <br>
    <div class="form-group">
        <?= Html::submitButton('Crear', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
