<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Ligas;
use app\models\Usuarios;

$this->title = 'Actualizar Equipo: ' . $equipo->nombre;
//$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $equipo->nombre, 'url' => ['view', 'id' => $equipo->id]];
//$this->params['breadcrumbs'][] = 'Actualizar';

?>


<div class="contenido-cabecera">  
    
    <h1>MODIFICACION DE DATOS DE <?= $equipo->nombre; ?></h1>  

</div>

<div id="contenedor-principal">


    <div class="marco">


    <p class="PaginaDeInicio">Datos que se pueden modificar</p>

    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        ]); ?>

    <?= $form->field($equipo, 'id_liga', ['options' => ['class' => 'campoTitulo']])->dropDownList(
        ArrayHelper::map(Ligas::find()->all(), 'id', 'nombre'),
        [
            'prompt' => 'Seleccionar Liga',
            'id' => 'liga-dropdown', // ID para el dropdown de ligas
            'class' => 'campo',
        ]
    )->label('Liga')  ?>

    <br>

    <?= $form->field($equipo, 'id_temporada', ['options' => ['class' => 'campoTitulo']])->dropDownList(
        [], // Este dropdown se llenará dinámicamente
        [
            'prompt' => 'Seleccionar Temporada',
            'id' => 'temporada-dropdown', // ID para el dropdown de temporadas
            'class' => 'campo',
        ]
    )->label('Temporada') ?>

    <?= $form->field($equipo, 'nombre', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($equipo, 'descripcion', ['options' => ['class' => 'campoTitulo']])->textarea(['rows' => 6, 'class' => 'campo']) ?>
    <br>

    <?= $form->field($equipo, 'n_jugadores', ['options' => ['class' => 'campoTitulo']])->textInput([
        'maxlength' => true,
        'type' => 'number', // Establecer el tipo como "number"
        'pattern' => '[0-9]*', // Expresión regular para aceptar solo números
        'class' => 'campo',
    ]) ?>

    <?php
        $usuarios = Usuarios::find()
        ->where(['id_rol' => 6])
        ->all();

        // Convertir los usuarios en un array asociativo para usarlo en el dropdown
        $usuariosDropdown = ArrayHelper::map($usuarios, 'id', 'nombre');
    ?>

    <?= $form->field($equipo, 'gestor_eq')->dropDownList(
        $usuariosDropdown,
        ['prompt' => 'Selecciona un gestor']
    )->label('Gestor del equipo (opcional)') ?>

    <p>
        <?= Html::submitButton('Actualizar', ['class' => 'botonFormulario']) ?>
        <?= Html::a('Atras', ['view', 'id' => $equipo->id], ['class' => 'botonFormulario']) ?>

    </p>

    <?php ActiveForm::end(); ?>
    </div>

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
                    cargarDropdown('cargar-temporadas-update', 'temporada-dropdown', {id_liga: ligaId});
                }
            });
        });
        
        JS;

        // Registrar el script en la vista
        $this->registerJs($script);
?>

</div>
