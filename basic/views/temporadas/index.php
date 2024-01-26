<?php $this->registerCssFile('@web/css/equipos.css'); ?>

<?php foreach ($temporadas as $temporada): ?>
    <div class="marco">
        <?= \yii\helpers\Html::a('<h2>' . $temporada->texto_de_titulo . '</h2>', ['jornadas/index', 'id' => $temporada->id]) ?>
    </div>
<?php endforeach; ?>

<?= \yii\helpers\Html::a('Añadir Temporada', ['temporadas/create'], ['class' => 'botonInicioSesion']) ?>