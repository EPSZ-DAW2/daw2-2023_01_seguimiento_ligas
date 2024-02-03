<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Temporadas $model */

$this->title = 'Update Temporadas: ' . $temporada->id;
$this->params['breadcrumbs'][] = ['label' => 'Temporadas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $temporada->id, 'url' => ['view', 'id' => $temporada->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="temporadas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'temporada' => $temporada,
    ]) ?>

</div>
