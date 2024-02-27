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
    <?php 
    if ((!Yii::$app->user->isGuest) && (in_array(Yii::$app->user->identity->id_rol, [1, 2]) || (Yii::$app->user->identity->id_rol == 6 && $esGestor))){ 
    ?>

        <p class="PaginaDeInicio">Por favor, rellene los campos para la creación de un jugador:</p>

        <?= $this->render('_form', [
            'model' => $model,
            'imagenModel' => $imagenModel,
            'esGestor' => $esGestor,
            'equipoId' => $equipoId,
        ]) ?>

    </div>
</div>
<?php }else{
    echo "El acceso a está página esta restringido";
}
?>
