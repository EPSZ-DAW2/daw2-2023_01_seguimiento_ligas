<?php 
use yii\helpers\Html;
use app\models\Usuarios;
?>

<div class="contenido-cabecera">  
    <h1>PATROCINADORES</h1>  
</div>

<?php foreach ($patrocinadores as $patrocinador): ?>
    <div class="marco2">
        <h2><?= $patrocinador->nombre ?></h2>
        <br>
        <div class="liga-image" style="background-image: url('<?= Yii::getAlias('@web/images/' . $patrocinador->imagen->foto) ?>');"></div>
        <br>
        <?= Html::a('Ver Detalles', ['patrocinadores/vista', 'id' => $patrocinador->id], ['class' => 'botonFormulario']) ?>
        <?php if (!Yii::$app->user->isGuest && (Yii::$app->user->identity->id_rol == 1 || Yii::$app->user->identity->id_rol == 2 || Yii::$app->user->identity->id_rol == 5)): ?>
            <?= Html::a('Copiar Patrocinador', ['copy', 'id' => $patrocinador->id], ['class' => 'botonFormulario']) ?>
        <?php endif ?>
    </div>
<?php endforeach; ?>

<div id="botonAbajo">
    <?php if (!Yii::$app->user->isGuest && (Yii::$app->user->identity->id_rol == 1 || Yii::$app->user->identity->id_rol == 2 || Yii::$app->user->identity->id_rol == 6)): ?>
        <?= Html::a('Crear Nuevo Patrocinador', ['patrocinadores/create'], ['class' => 'botonFormulario']) ?>
    <?php endif; ?>
</div>