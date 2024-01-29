<?php

use app\models\Imagenes;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Imagenes */ 

$this->title = Yii::t('app', 'Registro nueva imagen');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Imagenes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="imagenes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <!-- Agrega el campo para la carga de la imagen -->
    <?= $form->field($model, 'imagenFile')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

   

</div>

