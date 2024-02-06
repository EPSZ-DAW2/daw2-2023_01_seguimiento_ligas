<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = Yii::t('app', 'Cuenta Eliminada');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="contenido-cabecera">

<h1>CUENTA ELIMINADA</h1>

</div>
<div id="contenedor-principal">

    <div class="marco">

    <p class="PaginaDeInicio">Cuenta eliminada con exito</p>
    <br>
    <a class="boton" href="<?= Yii::$app->urlManager->createUrl(['site/index']) ?>">Continuar</a>

    </div>

</div>

