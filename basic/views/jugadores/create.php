<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Jugadores $model */

$this->title = 'Crear Jugadores';
//$this->params['breadcrumbs'][] = ['label' => 'Jugadores', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;


$this->registerCssFile('@web/css/jugadores.css');

?>
<div class="marco">

    <h2><?= Html::encode($this->title) ?></h2>

    <p class="PaginaDeInicio">Introduzca los datos del jugador:</p>

    <?= $this->render('_form', [
        'model' => $model,
        'imagenModel' => $imagenModel,
    ]) ?>

</div>
