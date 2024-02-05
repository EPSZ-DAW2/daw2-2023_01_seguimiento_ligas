<?php

use yii\helpers\Html;

$this->title = 'Actualizar Partido: ' . $partido->equipoLocal->nombre . ' vs ' . $partido->equipoVisitante->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Partidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $partido->equipoLocal->nombre . ' vs ' . $partido->equipoVisitante->nombre, 'url' => ['view', 'id' => $partido->id]];
$this->params['breadcrumbs'][] = 'Actualizar';

?>

<div class="partidos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $partido,
    ]) ?>

</div>
