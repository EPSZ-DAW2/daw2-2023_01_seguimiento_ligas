<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Ligas;

/* @var $this yii\web\View */
/* @var $model app\models\Equipos */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Crear Liga';
$this->registerCssFile('@web/css/equipos.css');
?>

<div class="marco">
    <h2 class="equipos_presentacion"><?= Html::encode($this->title) ?></h2>
    <p class="PaginaDeInicio">Por favor, rellene los campos para la creación de una liga:</p>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

 

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'pais')->textarea(['rows' => 6]) ?>
    <?= $form->field($imagenModel, 'imagenFile')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Añadir Liga', ['class' => 'botonInicioSesion']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
