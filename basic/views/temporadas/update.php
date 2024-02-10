<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Temporadas $model */

$this->title =  $temporada->texto_de_titulo;
//$this->params['breadcrumbs'][] = ['label' => 'Temporadas', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $temporada->id, 'url' => ['view', 'id' => $temporada->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>

<div class="contenido-cabecera">


    <h1>MODIFICACION DE LA TEMPORADA <?= Html::encode($this->title) ?></h1>

</div>

<div id="contenedor-principal">


    <?= $this->render('_form', [
        'temporada' => $temporada,
    ]) ?>

</div>
