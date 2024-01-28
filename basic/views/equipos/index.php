<?php $this->registerCssFile('@web/css/equipos.css'); ?>

<?php foreach ($equipos as $equipo): ?>
    <div class="liga-container">
        <div class="liga-content">
        <h2><?= $equipo->nombre ?></h2>
        <p><?= $equipo->descripcion ?><p>
        </div>
        <div class="liga-image" style="background-image: url('<?= Yii::getAlias('@web/images/' . $equipo->imagen->foto) ?>');"></div>
    </div>
<?php endforeach; ?>

<?= \yii\helpers\Html::a('Crear Nuevo Equipo', ['equipos/create'], ['class' => 'botonInicioSesion']) ?>