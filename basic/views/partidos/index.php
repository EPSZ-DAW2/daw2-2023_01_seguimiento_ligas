<?php 
use yii\helpers\Html;
use app\models\Usuarios;
use app\models\Equipos;
?>

<?php $partidosFuturos = []; ?>

<div class="contenido-cabecera">  
    <h1>PARTIDOS</h1>  
</div>

<?php foreach ($partidos as $partido): ?>
    <div class="marco2">
        <h2><?= Html::a($partido->equipoLocal->nombre, ['equipos/vista', 'id' => $partido->equipoLocal->id]) ?> - <?= Html::a($partido->equipoVisitante->nombre, ['equipos/vista', 'id' => $partido->equipoVisitante->id]) ?></h2>
        <p>Lugar: <?= $partido->lugar ?></p>
        <p><?= $partido->jornada->temporada->texto_de_titulo ?> - Jornada <?= $partido->jornada->numero ?> </p> 
        <p><?= (new DateTime($partido->horario))->format('d/m/Y H:i:s') ?></p>

        <?php
        // Obtener la fecha actual
        $fechaActual = new DateTime();

        // Obtener la fecha del partido
        $fechaPartido = new DateTime($partido->horario);

        // Si la fecha del partido ha pasado
        if ($fechaActual > $fechaPartido) {
            echo "<p>Resultado: {$partido->resultado_local} - {$partido->resultado_visitante}</p>";
        }
        ?>

        <?= Html::a('Ver Detalles', ['partidos/view', 'id' => $partido->id], ['class' => 'btn btn-info']) ?>
        <?php if (!Yii::$app->user->isGuest && (Yii::$app->user->identity->id_rol == 1 || Yii::$app->user->identity->id_rol == 3)): ?>
            <?= Html::a('Copiar Partido', ['copy', 'id' => $partido->id], ['class' => 'btn btn-success']) ?>
        <?php endif ?>
    </div>
<?php endforeach; ?>

<br><br><br><br>

<?php if (!Yii::$app->user->isGuest && (Yii::$app->user->identity->id_rol == 1 || Yii::$app->user->identity->id_rol == 3)): ?>
    <?php if ($jornadaID !== null): ?>
        <?= Html::a('Nuevo Partido en Jornada', ['partidos/create-en-jornada', 'jornadaID' => $jornadaID], ['class' => 'botonFormulario']) ?>
    <?php else: ?>
        <?= Html::a('Nuevo Partido', ['partidos/create'], ['class' => 'botonFormulario']) ?>
    <?php endif; ?>
<?php endif; ?>
