<?php

use yii\helpers\Html;

$this->title = 'Actualizar Partido: ' . $partido->equipoLocal->nombre . ' vs ' . $partido->equipoVisitante->nombre;
//$this->params['breadcrumbs'][] = ['label' => 'Partidos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $partido->equipoLocal->nombre . ' vs ' . $partido->equipoVisitante->nombre, 'url' => ['view', 'id' => $partido->id]];
//$this->params['breadcrumbs'][] = 'Actualizar';

?>

<div class="contenido-cabecera">

    <h1>ACTUALIZAR PARTIDOS</h1>

</div>

<div id="contenedor-principal">

<div class="marco">

    <?= $this->render('_form', [
        'model' => $partido,
    ]) ?>

</div>
</div>
