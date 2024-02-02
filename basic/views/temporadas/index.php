<?php $this->registerCssFile('@web/css/equipos.css'); ?>

<div class="contenido-cabecera">  
    <h1>TEMPORADAS</h1>  
</div>

<?php
$ligasTemporadas = [];

// Organizar temporadas por ligas
foreach ($temporadas as $temporada) {
    $ligaId = $temporada->liga->id;
    $ligasTemporadas[$ligaId][] = $temporada;
}
?>

<div class="row">
    <?php foreach ($ligasTemporadas as $ligaId => $temporadasPorLiga): ?>
        <div class="col-md-6">
            <div class="marco2">
                <h2><?= $temporadasPorLiga[0]->liga->nombre ?></h2>
            </div>
            <br>
            <?php foreach ($temporadasPorLiga as $temporada): ?>
                <div class="marco">
                    <?= \yii\helpers\Html::a('<h3>' . $temporada->texto_de_titulo . '</h3>', ['jornadas/index', 'id' => $temporada->id]) ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>

<?= \yii\helpers\Html::a('Añadir Temporada', ['temporadas/create'], ['class' => 'botonInicioSesion']) ?>
