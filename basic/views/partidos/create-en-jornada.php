<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Equipos;

?>

<?php $this->title = 'Crear Partido'; ?>

<div class="marco">

    <h2 class="equipos_presentacion"><?= Html::encode($this->title) ?></h2>

    <p class="PaginaDeInicio">Por favor, rellene los campos para la creación de un partido:</p>

    <?php $form = ActiveForm::begin(); ?>

    <?php
       $equipos =  Equipos::find()
        ->joinWith('temporada') // Hacer un join con la relación 'temporada' en Equipos
        ->andWhere(['equipos.id_temporada' => $temporada])
        ->all();
    ?>

    <?= $form->field($model, 'id_equipo_local')->dropDownList(
        ArrayHelper::map($equipos, 'id', 'nombre'),
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
                // Evento al cambiar el equipo local
                $('#equipo-local-dropdown').on('change', function() {
                    var equipoId = $(this).val();
                    var temporadaId = $temporada[0];

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