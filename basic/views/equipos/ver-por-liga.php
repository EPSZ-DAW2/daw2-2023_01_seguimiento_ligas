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

        <?php if (!Yii::$app->user->isGuest && (Yii::$app->user->identity->id_rol == 1 || Yii::$app->user->identity->id_rol == 5)): ?>
                        <?= Html::a('Ver Detalles', ['equipos/view', 'id' => $equipo->id], ['class' => 'btn btn-info']) ?>
                        <?= Html::a('Copiar Equipo', ['copy', 'id' => $equipo->id], ['class' => 'btn btn-success']) ?>
                    <?php endif ?>
    </div>
<?php endforeach; ?>

</div>