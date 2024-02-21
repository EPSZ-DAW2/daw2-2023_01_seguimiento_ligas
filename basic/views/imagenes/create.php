<?php

use app\models\Imagenes;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Imagenes */ 

$this->title = Yii::t('app', 'Registro nueva imagen');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Imagenes'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="contenido-cabecera">

    <h1>REGISTRO DE UNA NUEVA IMAGEN</h1>

</div>

<div id="contenedor-izquierda">

    <div class="marco">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'enableAjaxValidation' => false,
    'enableClientValidation' => true,]]); ?>

    <!-- Agrega el campo para la carga de la imagen -->
    <?= $form->field($model, 'imagenFile', ['options' => ['class' => 'campoTitulo']])->fileInput(['class' => 'campo'])->label('Subir Imagen') ?>
            <!-- Muestra el mensaje de error -->
            <?php if ($model->hasErrors('imagenFile')): ?>
            <div class="alert alert-danger">
                <?= $form->error($model, 'imagenFile') ?>
            </div>
        <?php endif; ?>
    <br>
    <p>
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'botonFormulario']) ?>
        <?= Html::a(Yii::t('app', 'Atras'), ['index'], ['class' => 'botonFormulario']) ?>
    </p>

    <?php ActiveForm::end(); ?>

   
    </div>
</div>

