<?php 
use yii\helpers\Html; 
?>

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

<div id="contenedor-principal">
    <?php foreach ($ligasTemporadas as $ligaId => $temporadasPorLiga): ?>
        <div class="marco2">
            <h2><?= $temporadasPorLiga[0]->liga->nombre ?></h2>
            <br>
            <?php foreach ($temporadasPorLiga as $temporada): ?>
                <br>
                <p><?= Html::a($temporada->texto_de_titulo, ['jornadas/index', 'id' => $temporada->id]) ?></p>
                
                <?php if (!Yii::$app->user->isGuest && (Yii::$app->user->identity->id_rol == 1 || Yii::$app->user->identity->id_rol == 2 || Yii::$app->user->identity->id_rol == 4)): ?>
                    <?= Html::a('Ver Detalles', ['temporadas/view', 'id' => $temporada->id], ['class' => 'botonFormulario']) ?>
                    <br>
                <?php endif ?>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>

    <div style="text-align: center; margin-top: 20px;">
        <?php if (!Yii::$app->user->isGuest && (Yii::$app->user->identity->id_rol == 1 || Yii::$app->user->identity->id_rol == 2 || Yii::$app->user->identity->id_rol == 4)): ?>
            <?= Html::a('Añadir Temporada', ['temporadas/create'], ['class' => 'botonFormulario']) ?>
        <?php endif ?>
    </div>
</div>
