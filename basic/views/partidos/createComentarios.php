<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;
use app\models\Comentarios;

/* @var $this yii\web\View */
/* @var $model app\models\Comentarios */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Crear Comentario';
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'texto')->textarea(['rows' => 6]) ?>

<div class="form-group">
    <?= Html::submitButton('Agregar Comentario', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>