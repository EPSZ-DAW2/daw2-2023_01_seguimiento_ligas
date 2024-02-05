<?php 
use yii\helpers\Html;
use app\models\Usuarios;
?>

<?php $partidosFuturos = []; ?>

<div class="contenido-cabecera">  
    <h1>PARTIDOS</h1>  
</div>

<?php foreach ($partidos as $partido): ?>
    <?php $fechaHoraActual = new DateTime(); ?>
    <?php $fechaHoraPartido = new DateTime($partido->horario); ?>
    <?php $esPartidoFuturo = $fechaHoraPartido > $fechaHoraActual; ?>

    <?php if ($esPartidoFuturo) {
        $partidosFuturos[] = [
        'partido' => $partido,
        'fechaHora' => $fechaHoraPartido,
    ];
    } 
endforeach;

// Ordenar el array de partidos futuros por fecha y hora
usort($partidosFuturos, function ($a, $b) {
    return $a['fechaHora'] <=> $b['fechaHora'];
});

    for ($i = 0; $i < min(5, count($partidosFuturos)); $i++):
        $partido = $partidosFuturos[$i]['partido'];
        $fechaHoraPartido = $partidosFuturos[$i]['fechaHora'];
    ?>

    <div class="marco">
        <h2><?= $partido->equipoLocal->nombre ?> - <?= $partido->equipoVisitante->nombre ?></h2>
        <p>Lugar: <?= $partido->lugar ?></p>
        <p><?= $partido->jornada->temporada->texto_de_titulo ?> - Jornada <?= $partido->jornada->numero ?> </p> 
        <p><?= (new DateTime($partido->horario))->format('d/m/Y H:i:s') ?></p>

        <?php if (!Yii::$app->user->isGuest && (Yii::$app->user->identity->id_rol == 1 || Yii::$app->user->identity->id_rol == 3)): ?>
            <?= Html::a('Ver Detalles', ['partidos/view', 'id' => $partido->id], ['class' => 'btn btn-info']) ?>
            <?= Html::a('Copiar Partido', ['copy', 'id' => $partido->id], ['class' => 'btn btn-success']) ?>
        <?php endif ?>
    </div>
    <?php
    endfor;
?>

<br><br><br><br>

<?php if (!Yii::$app->user->isGuest && (Yii::$app->user->identity->id_rol == 1 || Yii::$app->user->identity->id_rol == 3)): ?>
    <?php if ($jornadaID !== null): ?>
        <?= Html::a('Nuevo Partido en Jornada', ['partidos/create-en-jornada', 'jornadaID' => $jornadaID], ['class' => 'botonFormulario']) ?>
    <?php else: ?>
        <?= Html::a('Nuevo Partido', ['partidos/create'], ['class' => 'botonFormulario']) ?>
    <?php endif; ?>
<?php endif; ?>