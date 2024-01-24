<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Ligas;

/* @var $this yii\web\View */
/* @var $model app\models\Equipos */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Crear Equipo';
//$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;

// Registrar el archivo CSS
$this->registerCssFile('@web/css/equipos.css');
?>
<div class="marco">

    <h2 class="equipos_presentacion"><?= Html::encode($this->title) ?></h2>

    <p class="PaginaDeInicio">Por favor rellene los campos para la creacción de un equipo:</p>


    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, 'id_liga')->dropDownList(
        ArrayHelper::map(Ligas::find()->all(), 'id', 'nombre'),
        ['prompt' => 'Seleccionar Liga']
    ) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>
    <?= $form->field($imagenModel, 'imagenFile')->fileInput() ?>
    <?= $form->field($model, 'n_jugadores')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'botonInicioSesion']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
