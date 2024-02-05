<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Copia de Seguridad';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="base-datos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Realizar Copia de Seguridad', ['backup'], ['class' => 'btn btn-success']) ?>
    </p>

</div>
