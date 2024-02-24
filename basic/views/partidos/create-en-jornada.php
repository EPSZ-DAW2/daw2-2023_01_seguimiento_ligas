<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Equipos;

?>

<?php $this->title = 'Crear Partido'; ?>


<div class="contenido-cabecera">

    <h1><?= Html::encode($this->title) ?></h1>

</div>


<div id="contenedor-principal">

    <div class="marco">

        <p class="PaginaDeInicio">Por favor, rellene los campos para la creación de un partido:</p>

        <?php $form = ActiveForm::begin(['enableAjaxValidation' => false,
        'enableClientValidation' => true,]); ?>

        <?php
        $equipos =  Equipos::find()
            ->joinWith('temporada', ['options' => ['class' => 'campoTitulo']]) // Hacer un join con la relación 'temporada' en Equipos
            ->andWhere(['equipos.id_temporada' => $temporada])
            ->all();
        ?>
        <br>
        <?= $form->field($model, 'id_equipo_local', ['options' => ['class' => 'campoTitulo']])->dropDownList(
            ArrayHelper::map($equipos, 'id', 'nombre'),
            [
                'prompt' => 'Seleccionar Equipo',
                'id' => 'equipo-local-dropdown', // ID para el dropdown de equipos
                'class' => 'campo',
            ]
            )->label('Equipos Locales') ?>
        <br>
        <?= $form->field($model, 'id_equipo_visitante', ['options' => ['class' => 'campoTitulo']])->dropDownList(
            [], // Este dropdown se llenará dinámicamente
            [
                'prompt' => 'Seleccionar Equipo',
                'id' => 'equipo-dropdown',
                'class' => 'campo',
            ]
            )->label('Equipos Visitantes') ?>
        <br>
            <?= $form->field($model, 'horario', ['options' => ['class' => 'campoTitulo']])->textInput(['type' => 'datetime-local', 'class' => 'campo'])->label('Horario') ?>
        <br>
            <?= $form->field($model, 'lugar', ['options' => ['class' => 'campoTitulo']])->textInput(['placeholder' => 'Ingrese la ubicación...', 'class' => 'campo']) ?>
        <br>
            
        <p>
                <?= Html::submitButton('Añadir Partido', ['class' => 'botonFormulario']) ?>
                <?= Html::a('Atras', Yii::$app->request->referrer ?: Yii::$app->homeUrl, ['class' => 'botonFormulario']) ?>

        </p>

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
</div>