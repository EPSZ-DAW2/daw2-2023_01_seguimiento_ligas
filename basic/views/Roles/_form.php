<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Roles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marco">

<?php $form = ActiveForm::begin([
    'id' => 'roles-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
]); ?>

    
    <?= $form->field($model, 'nombre', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el nombre del nuevo rol', 'class' => 'campo']) ?>
    <br>
    <div>
        <?= Html::submitButton(Yii::t('app', 'Enviar'), ['class' => 'botonFormulario']) ?>
        <?= Html::a(Yii::t('app', 'Tabla de Roles'), ['roles/index'], ['class' => 'botonFormulario']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
