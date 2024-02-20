<?php
use yii\helpers\Html;
use app\models\Temporadas;
use app\models\Equipos;
use yii\db\Expression;
?>

<div class="contenido-cabecera">

<h1><?= Html::encode($temporada->texto_de_titulo) ?></h1>

</div>

<br>
<br>

<div class="contenedor-ligas">

<?php foreach ($equipos as $equipo): ?>
    <div class="marco2">
        <div class="liga-content">
            <h2><?= Html::a($equipo->nombre, ['vista', 'id' => $equipo->id], ['class' => 'enlace-equipo']) ?></h2>
            <p><?= $equipo->descripcion ?></p>
            <p><?= $equipo->temporada->texto_de_titulo ?></p>
        </div>
        <div class="liga-image" style="background-image: url('<?= Yii::getAlias('@web/images/' . $equipo->imagen->foto) ?>');"></div>

        <?php if (!Yii::$app->user->isGuest && (Yii::$app->user->identity->id_rol == 1 || Yii::$app->user->identity->id_rol == 2 || Yii::$app->user->identity->id_rol == 6)): ?>
                <?= Html::a('Ver Detalles', ['equipos/view', 'id' => $equipo->id], ['class' => 'btn btn-info']) ?>
                <?= Html::a('Copiar Equipo', ['copy', 'id' => $equipo->id], ['class' => 'btn btn-success']) ?>
        <?php endif ?>
    </div>
<?php endforeach; ?>

    <div style="text-align: center; margin-top: 20px;">
        <?php if (!Yii::$app->user->isGuest && (Yii::$app->user->identity->id_rol == 1 || Yii::$app->user->identity->id_rol == 2 || Yii::$app->user->identity->id_rol == 6)): ?>
            <?= Html::a('Crear Equipo en Temporada', ['equipos/create-en-temporada', 'temporadaID' => $temporada->id], ['class' => 'botonFormulario']) ?>
        <?php endif ?>
    </div>
</div>