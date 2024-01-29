<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $modelImagenes app\models\Imagenes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="imagenes-form">

    <?php $form = ActiveForm::begin([
        'id' => 'imagenes-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => false,
    ]); ?>

    <?= $form->field($model, 'foto')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Subir Imagen'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
