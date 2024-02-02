<?php 
use yii\helpers\Html; 
?>

<div class="contenido-cabecera">  
    <h1>PARTIDOS</h1>  
</div>

<?php foreach ($partidos as $partido): ?>
    <div class="marco">
        <h2><?= $partido->equipoLocal->nombre ?> - <?= $partido->equipoVisitante->nombre ?></h2>
        <p>Lugar: <?= $partido->lugar ?></p>
        <p><?= $partido->jornada->temporada->texto_de_titulo ?> - Jornada <?= $partido->jornada->numero ?> </p> 
        <p><?= (new DateTime($partido->horario))->format('d/m/Y H:i:s') ?></p>

        <!-- Agregar el botón de detalles -->
        <?= \yii\helpers\Html::a('Ver Detalles', ['partidos/view', 'id' => $partido->id], ['class' => 'botonDetalles']) ?>
    </div>
<?php endforeach; ?>

<br><br><br><br>

<?php if ($jornadaID !== null): ?>
    <?= Html::a('Nuevo Partido en Jornada', ['partidos/create-en-jornada', 'jornadaID' => $jornadaID], ['class' => 'botonFormulario']) ?>
<?php else: ?>
    <?= Html::a('Nuevo Partido', ['partidos/create'], ['class' => 'botonFormulario']) ?>
<?php endif; ?>

