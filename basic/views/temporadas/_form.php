<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title =  $temporada->texto_de_titulo;
/** @var yii\web\View $this */
/** @var app\models\Temporadas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="marco">

    <p class="PaginaDeInicio">Datos de <?= Html::encode($this->title) ?></p>

    <?php $form = ActiveForm::begin(['enableAjaxValidation' => false,
        'enableClientValidation' => true,]); ?>

    <?= $form->field($temporada, 'texto_de_titulo', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($temporada, 'fecha_inicial', ['options' => ['class' => 'campoTitulo']])->textInput(['class' => 'campo'])?>
    <br>
    <?= $form->field($temporada, 'fecha_final', ['options' => ['class' => 'campoTitulo']])->textInput(['class' => 'campo'])->label(false)->error() ?>
    <br>

    <p>
        <?= Html::submitButton('Modificar', ['class' => 'botonFormulario']) ?>
        <?= Html::a(Yii::t('app', 'Atras'), ['temporadas/view', 'id' => $temporada->id], ['class' => 'botonFormulario']) ?>
        <?= Html::a(Yii::t('app', 'Tabla de temporadas'), ['temporadas/index'], ['class' => 'botonFormulario']) ?>
    </p>

    <?php ActiveForm::end(); ?>

</div>
