<?php
use yii\helpers\Html;
?>

<div class="contenido-cabecera">

<h1><?= Html::encode($liga->nombre) ?></h1>

</div>

<div class="contenedor-ligas">

<?php foreach ($equipos as $equipo): ?>
    <div class="marco2">
        <div class="liga-content">
            <h2><?= $equipo->nombre ?></h2>
            <p><?= $equipo->descripcion ?></p>
            <p><?= $equipo->temporada->texto_de_titulo ?></p>
        </div>
        <div class="liga-image" style="background-image: url('<?= Yii::getAlias('@web/images/' . $equipo->imagen->foto) ?>');"></div>
    </div>
<?php endforeach; ?>

</div>