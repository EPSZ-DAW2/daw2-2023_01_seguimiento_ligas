<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;
use app\models\Ligas;
use app\models\Equipos;
use app\models\Temporadas;
use app\models\JornadasTemporada;

/* @var $this yii\web\View */
/* @var $model app\models\Equipos */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Crear Partido';
//$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;

// Registrar el archivo CSS
$this->registerCssFile('@web/css/equipos.css');
?>
<div class="marco">

    <h2 class="equipos_presentacion"><?= Html::encode($this->title) ?></h2>

    <p class="PaginaDeInicio">Por favor, rellene los campos para la creación de un partido:</p>


    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, 'id_liga_seleccionada')->dropDownList(
        ArrayHelper::map(Ligas::find()->all(), 'id', 'nombre'),
        [
            'prompt' => 'Seleccionar Liga',
            'id' => 'liga-dropdown', // ID para el dropdown de ligas
        ]
    )->label('Ligas') ?>

    <?= $form->field($model, 'id_temporada_seleccionada')->dropDownList(
        [], // Este dropdown se llenará dinámicamente
        [
            'prompt' => 'Seleccionar Temporada',
            'id' => 'temporada-dropdown', // ID para el dropdown de temporadas
        ]
    )->label('Temporadas') ?>

    <?= $form->field($model, 'id_jornada')->dropDownList(
        [], // Este dropdown se llenará dinámicamente
        [
            'prompt' => 'Seleccionar Jornada',
            'id' => 'jornada-dropdown', // ID para el dropdown de jornadas
        ]
    )->label('Jornadas') ?>    

    <?= $form->field($model, 'id_equipo_local')->dropDownList(
    [], // Este dropdown se llenará dinámicamente
    [
        'prompt' => 'Seleccionar Equipo',
        'id' => 'equipo-local-dropdown', // ID para el dropdown de equipos
    ]
    )->label('Equipos Locales') ?>

    <?= $form->field($model, 'id_equipo_visitante')->dropDownList(
    [], // Este dropdown se llenará dinámicamente
    [
        'prompt' => 'Seleccionar Equipo',
        'id' => 'equipo-dropdown',
    ]
    )->label('Equipos Visitantes') ?>

    <?= $form->field($model, 'horario')->textInput(['type' => 'datetime-local', 'class' => 'form-control'])->label('Horario') ?>

    <?= $form->field($model, 'lugar')->textInput(['placeholder' => 'Ingrese la ubicación...']) ?>

    <div class="form-group">
        <?= Html::submitButton('Añadir Partido', ['class' => 'botonInicioSesion']) ?>
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
                var temporadaId = $('#temporada-dropdown').val();

                if (ligaId) {
                    cargarDropdown('cargar-temporadas', 'temporada-dropdown', {id_liga: ligaId});
                } else {
                    $('#temporada-dropdown').html('<option value="">Seleccionar Temporada</option>');
                    $('#equipo-local-dropdown').html('<option value="">Seleccionar Equipo</option>');
                    $('#equipo-visitante-dropdown').html('<option value="">Seleccionar Equipo</option>');
                    $('#jornada-dropdown').html('<option value="">Seleccionar Jornada</option>');
                }
            });

            // Evento al cambiar la temporada
            $('#temporada-dropdown').on('change', function(){
                var temporadaId = $(this).val();

                if (temporadaId) {
                    cargarDropdown('cargar-jornadas', 'jornada-dropdown', {id_temporada: temporadaId});
                    cargarDropdown('../equipos/equipos-por-temporada', 'equipo-local-dropdown', {id_temporada: temporadaId});
                } else {
                    $('#jornada-dropdown').html('<option value="">Seleccionar Jornada</option>');
                    $('#equipo-local-dropdown').html('<option value="">Seleccionar Equipo</option>');
                    $('#equipo-visitante-dropdown').html('<option value="">Seleccionar Equipo Visitante</option>');
                }
            });

            
            // Evento al cambiar el equipo local
            $('#equipo-local-dropdown').on('change', function() {
                var temporadaId = $('#temporada-dropdown').val();
                var equipoId = $(this).val();

                if (equipoId) {
                    cargarDropdown('../equipos/equipos-por-temporada', 'equipo-dropdown', {id_temporada: temporadaId, excludeId: equipoId});
                } else {
                    $('#equipo-local-dropdown').html('<option value="">Seleccionar Equipo</option>');
                    $('#equipo-visitante-dropdown').html('<option value="">Seleccionar Equipo Visitante</option>');
                }
            });
            
        });
    JS;

    // Registrar el script en la vista
    $this->registerJs($script);
?>

</div>

