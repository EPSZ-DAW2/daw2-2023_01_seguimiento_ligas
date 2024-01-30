<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Ligas;

/* @var $this yii\web\View */
/* @var $model app\models\Equipos */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Crear Liga';
?>

<div class="contenido-cabecera">

    <h1>CREACIÓN DE LIGAS:</h1>

</div>

<div  id="contenedor-principal">
    <div class="marco">
        <p class="PaginaDeInicio">Por favor, rellene los campos para la creación de una liga:</p>

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($model, 'nombre', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el nombre de la liga', 'class' => 'campo']) ?>
        <br>
        <?= $form->field($model, 'pais', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el pais al que pertenezca la liga', 'class' => 'campo']) ?>
        <br>
        <?= $form->field($imagenModel, 'imagenFile', ['options' => ['class' => 'campoTitulo']])->fileInput(['class' => 'campo']) ?>
        <br>
        <?= Html::submitButton(Yii::t('app', 'Añadir Liga'), ['class' => 'botonFormularion']) ?>
        <?= Html::a(Yii::t('app', 'Atras'), Yii::$app->request->referrer ?: Yii::$app->homeUrl, ['class' => 'botonFormulario']) ?>
        <?= Html::a(Yii::t('app', 'Ir a Inicio'), Yii::$app->homeUrl, ['class' => 'botonFormulario']) ?>

        <?php ActiveForm::end(); ?>
    </div>
</div>
