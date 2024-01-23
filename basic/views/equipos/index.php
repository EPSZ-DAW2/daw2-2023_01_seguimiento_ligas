<?php $this->registerCssFile('@web/css/equipos.css'); ?>

<?php foreach ($equipos as $equipo): ?>
    <div class="equipos_presentacion">
        <h2><?= $equipo->nombre ?></h2>
        <p><?= $equipo->descripcion ?><p>
    </div>
<?php endforeach; ?>

<?= \yii\helpers\Html::a('Crear Nuevo Equipo', ['equipos/create'], ['class' => 'btn btn-success']) ?>