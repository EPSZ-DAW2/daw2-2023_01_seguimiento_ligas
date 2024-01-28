<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Jugadores $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="jugadores-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'id_equipo')->dropDownList(
        \yii\helpers\ArrayHelper::map(\app\models\Equipos::find()->all(), 'id', 'nombre'),
        ['prompt' => 'Selecciona un equipo']
    ) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($imagenModel, 'imagenFile')->fileInput() ?>

    <?= $form->field($model, 'posicion')->dropDownList([
    ''=>'',
    'Base' => 'Base',
    'Escolta' => 'Escolta',
    'Alero' => 'Alero',
    'Ala-pívot' => 'Ala-pívot',
    'Pívot' => 'Pívot',]) ?>

    <?= $form->field($model, 'altura')->textInput() ?>

    <?= $form->field($model, 'peso')->textInput() ?>

    <?= $form->field($model, 'nacionalidad')->dropDownList(
    \app\models\Jugadores::getNacionalidadesList(),
    ['prompt' => 'Selecciona una nacionalidad']
    ) ?>

    <br>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
