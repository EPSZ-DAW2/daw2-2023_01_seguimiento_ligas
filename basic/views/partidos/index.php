<?php $this->registerCssFile('@web/css/equipos.css'); ?>

<?php foreach ($partidos as $partido): ?>
    <div class="marco">
        <h2><?= $partido->equipoLocal->nombre ?> - <?= $partido->equipoVisitante->nombre ?></h2>
        <p>Lugar: <?= $partido->lugar ?></p>
        <p><?= (new DateTime($partido->horario))->format('d/m/Y H:i:s') ?></p> 
    </div>
<?php endforeach; ?>

<?= \yii\helpers\Html::a('Nuevo Partido', ['partidos/create'], ['class' => 'botonInicioSesion']) ?>