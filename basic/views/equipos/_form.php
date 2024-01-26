<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Equipos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="equipos-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'id_liga')->dropDownList(
        ArrayHelper::map(Ligas::find()->all(), 'id', 'nombre'),
        ['prompt' => 'Seleccionar Liga']
    ) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?= $form->field($imagenModel, 'imagenFile')->fileInput() ?>

    <?= $form->field($model, 'n_jugadores')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>
