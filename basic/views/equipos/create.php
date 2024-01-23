<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_liga')->textInput(['placeholder' => 'Ingrese el ID de la liga']) ?>
    <br>
    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el nombre del equipo']) ?>
    <br>
    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6, 'placeholder' => 'Ingrese una descripcion del equipo']) ?>
    <br>
    <?= $form->field($model, 'id_imagen_escudo')->textInput(['placeholder' => 'Ingrese el ID de la imagen del escudo']) ?>
    <br>
    <?= $form->field($model, 'id_imagen')->textInput(['placeholder' => 'Ingrese el ID de la imagen']) ?>
    <br>
    <?= $form->field($model, 'n_jugadores')->textInput(['placeholder' => 'Ingrese el numero total de jugadores']) ?>
    
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'botonInicioSesion']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
