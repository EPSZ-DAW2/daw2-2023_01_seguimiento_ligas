<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = Yii::t('app', 'Registro completado');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="contenido-cabecera">

<h1>REGISTRO COMPLETADO</h1>

</div>
<div id="contenedor-principal">

    <div class="marco">

    <p class="PaginaDeInicio">Se ha completado el registro correctamente</p>
    <br>
    <a class="boton" href="<?= Yii::$app->urlManager->createUrl(['site/index']) ?>">Continuar</a>

    </div>

</div>

