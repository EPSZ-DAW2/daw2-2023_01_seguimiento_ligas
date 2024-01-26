<?php $this->registerCssFile('@web/css/equipos.css'); ?>

<?php foreach ($equipos as $equipo): ?>
    <div class="marco">
        <?php if ($equipo->escudo): ?>
            <?= \yii\helpers\Html::img(Yii::getAlias('@web/' . $equipo->escudo->foto), ['class' => 'equipo-imagen', 'width' => '50px']) ?>
        <?php else: ?>
            <p>Imagen no encontrada</p>
        <?php endif; ?>
        <h2><?= $equipo->nombre ?></h2>
        <p><?= $equipo->descripcion ?><p>
        <p><?= $equipo->escudo->foto ?></p>
    </div>
<?php endforeach; ?>

<?= \yii\helpers\Html::a('Crear Nuevo Equipo', ['equipos/create'], ['class' => 'botonInicioSesion']) ?>
