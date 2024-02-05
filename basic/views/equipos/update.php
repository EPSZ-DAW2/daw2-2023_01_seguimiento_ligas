<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Actualizar Equipo: ' . $equipo->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $equipo->nombre, 'url' => ['view', 'id' => $equipo->id]];
$this->params['breadcrumbs'][] = 'Actualizar';

?>

<div class="equipos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($equipo, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($equipo, 'descripcion')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Actualizar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
