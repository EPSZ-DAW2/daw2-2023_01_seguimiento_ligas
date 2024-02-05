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
//$this->registerCssFile('@web/css/equipos.css');
?>

<div class="contenido-cabecera">  
    
<h1>CREACIÓN DE EQUIPOS</h1>  

</div>

<div id="contenedor-principal">

<div class="marco">

    <p class="PaginaDeInicio">Por favor, rellene los campos para la creación de un equipo:</p>

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, 'id_liga', ['options' => ['class' => 'campoTitulo']])->dropDownList(
        ArrayHelper::map(Ligas::find()->all(), 'id', 'nombre'),
        [
            'prompt' => 'Seleccionar Liga',
            'id' => 'liga-dropdown', // ID para el dropdown de ligas
        ]
    ) ?>

    <?= $form->field($model, 'id_temporada', ['options' => ['class' => 'campoTitulo']])->dropDownList(
        [], // Este dropdown se llenará dinámicamente
        [
            'prompt' => 'Seleccionar Temporada',
            'id' => 'temporada-dropdown', // ID para el dropdown de temporadas
        ]
    )->label('Temporadas') ?>

    <?= $form->field($model, 'nombre', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'descripcion', ['options' => ['class' => 'campoTitulo']])->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'n_jugadores', ['options' => ['class' => 'campoTitulo']])->hiddenInput(['value' => 0])->label(false) ?>
    <br>
    <?= $form->field($imagenModel, 'imagenFile', ['options' => ['class' => 'campoTitulo']])->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Añadir Equipo', ['class' => 'botonInicioSesion']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php 
    $script = <<< JS
        function cargarDropdown(url, dropdownId, params) {
            $.ajax({
                url: url,
                type: 'GET',
                data: params,
                success: function(data) {
                    console.log(dropdownId + ' cargado con éxito:', data);
                    $('#' + dropdownId).html(data);
                },
                error: function() {
                    console.log('Error al cargar ' + dropdownId + '.');
                }
            });
        }

        $(document).ready(function(){
            // Evento al cambiar la liga
            $('#liga-dropdown').on('change', function(){
                var ligaId = $(this).val();

                if (ligaId) {
                    cargarDropdown('cargar-temporadas', 'temporada-dropdown', {id_liga: ligaId});
                }
            });
        });
        
        JS;

        // Registrar el script en la vista
        $this->registerJs($script);
?>
</div>
