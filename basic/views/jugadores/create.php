<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Jugadores $model */

$this->title = 'Crear Jugadores';
//$this->params['breadcrumbs'][] = ['label' => 'Jugadores', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;

?>

<div class="contenido-cabecera">

    <h1>CREADOR DE JUGADORES</h1>

</div>

<div  id="contenedor-principal">
    <div class="marco">

        <p class="PaginaDeInicio">Por favor, rellene los campos para la creación de un jugador::</p>

        <?= $this->render('_form', [
            'model' => $model,
            'imagenModel' => $imagenModel,
        ]) ?>

    </div>
</div>
