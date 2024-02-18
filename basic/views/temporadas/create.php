<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Ligas;

/** @var yii\web\View $this */
/** @var app\models\Temporadas $model */

$this->title = 'Crear Temporada';

// Registrar el archivo CSS
//$this->registerCssFile('@web/css/equipos.css');

//$this->params['breadcrumbs'][] = ['label' => 'Temporadas', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="contenido-cabecera">

    <h1>CREADOR DE TEMPORADAS</h1>

</div>

<div  id="contenedor-principal">

    <div class="marco">
       
        <p class="PaginaDeInicio">Por favor, rellene los campos para la creación de una temporada:</p>

        <?php $form = ActiveForm::begin([
            'enableAjaxValidation' => false,
            'enableClientValidation' => true,
        ]); ?>


        <?= $form->field($model, 'id_liga', ['options' => ['class' => 'campoTitulo']])->dropDownList(
            ArrayHelper::map(Ligas::find()->all(), 'id', 'nombre'),
            ['prompt' => 'Seleccionar Liga', 'class' => 'campo']
        ) ?>
        <br>
        <?= $form->field($model, 'texto_de_titulo', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el nombre de la temporada', 'class' => 'campo']) ?>
        <br>
        <?= $form->field($model, 'fecha_inicial', ['options' => ['class' => 'campoTitulo']])->widget(\yii\jui\DatePicker::class, [
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'campo', 'placeholder' => 'Año-Mes-Dias']
        ]) ?>
        <br>
        <?= $form->field($model, 'fecha_final', ['options' => ['class' => 'campoTitulo']])->widget(\yii\jui\DatePicker::class, [
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'campo', 'placeholder' => 'Año-Mes-Dias'],
        ]) ?>
        <br>

        <p>
            <?= Html::submitButton('Crear', ['class' => 'botonFormulario']) ?>
            <?= Html::a(Yii::t('app', 'Tabla de temporadas'), ['temporadas/index'], ['class' => 'botonFormulario']) ?>
        </p>

        <?php ActiveForm::end(); ?>

    </div>
</div>