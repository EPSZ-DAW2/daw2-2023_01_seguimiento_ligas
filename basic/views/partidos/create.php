<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
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

    <?= $form->field($model, 'id_jornada_seleccionada')->dropDownList(
        [], // Este dropdown se llenará dinámicamente
        [
            'prompt' => 'Seleccionar Jornada',
            'id' => 'jornada-dropdown', // ID para el dropdown de jornadas
        ]
    )->label('Jornadas') ?>

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
                    cargarEquipos(); // Llama a la nueva función para cargar equipos

                    // Cargar automáticamente las jornadas solo si hay una temporada seleccionada
                    if (temporadaId) {
                        cargarJornadas();
                    } else {
                        $('#jornada-dropdown').html('<option value="">Seleccionar Jornada</option>');
                    }
                } else {
                    $('#temporada-dropdown').html('<option value="">Seleccionar Temporada</option>');
                    $('#equipo-dropdown').html('<option value="">Seleccionar Equipo</option>');
                    $('#jornada-dropdown').html('<option value="">Seleccionar Jornada</option>');
                }
            });

            // Evento al cambiar la temporada
            $('#temporada-dropdown').on('change', function(){
                cargarJornadas();
            });
        });

        // Función para cargar equipos
        function cargarEquipos() {
            var ligaId = $('#liga-dropdown').val();
            if (ligaId) {
                cargarDropdown('../equipos/equipos-por-liga', 'equipo-dropdown', {id_liga: ligaId});
            } else {
                $('#equipo-dropdown').html('<option value="">Seleccionar Equipo</option>');
            }
        }

        // Función para cargar jornadas
        function cargarJornadas() {
            var temporadaId = $('#temporada-dropdown').val();
            if (temporadaId) {
                cargarDropdown('cargar-jornadas', 'jornada-dropdown', {id_temporada: temporadaId});
            } else {
                $('#jornada-dropdown').html('<option value="">Seleccionar Jornada</option>');
            }
        }
    JS;

    // Registrar el script en la vista
    $this->registerJs($script);
?>


    

    <?= $form->field($model, 'id_equipo_local')->dropDownList(
    [], // Este dropdown se llenará dinámicamente
    [
        'prompt' => 'Seleccionar Equipo Local',
        'id' => 'equipo-dropdown', // ID para el dropdown de equipos
    ]
    )->label('Equipos Locales') ?>

    <?= $form->field($model, 'id_equipo_visitante')->dropDownList(
        ArrayHelper::map(Equipos::find()->all(), 'id', 'nombre'),
        ['prompt' => 'Seleccionar Equipo Visitante']
    )->label('Equipos Visitantes') ?>

    <div class="form-group">
        <?= Html::submitButton('Añadir Partido', ['class' => 'botonInicioSesion']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

