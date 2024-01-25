<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Partidos $model */

$this->title = 'Crear Partido';
//$this->params['breadcrumbs'][] = ['label' => 'Partidos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;


// Registrar el archivo CSS
$this->registerCssFile('@web/css/partidos.css');

?>
<div class="marco">

    <h2><?= Html::encode($this->title) ?></h2>

    <p class="PaginaDeInicio">Por favor rellene los campos para la creacción de un partido:</p>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>