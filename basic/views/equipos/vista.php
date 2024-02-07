<?php
use yii\helpers\Html;
?> 

<?php echo $equipo->nombre; ?></p>

<h2> <?= $equipo->nombre; ?> </h2>
<h3> <?= $equipo->descripcion; ?> </h3>

<h2>Últimos Resultados</h2>
<?php foreach ($ultimosResultados as $resultado): ?>
    <div class="marco">
        <h4><?= Html::a($resultado->equipoLocal->nombre, ['equipos/vista', 'id' => $resultado->equipoLocal->id]) ?> - <?= Html::a($resultado->equipoVisitante->nombre, ['equipos/vista', 'id' => $resultado->equipoVisitante->id]) ?></h4>
        <p> <?= $resultado->lugar; ?> : <?= date('d-m-Y H:i', strtotime($resultado->horario)); ?></p>
        <p>Resultado: <?= $resultado->resultado_local; ?> - <?= $resultado->resultado_visitante; ?></p>
    </div>
<?php endforeach; ?>

<h2>Próximos Partidos</h2>
<?php foreach ($proximosPartidos as $partido): ?>
    <div class="marco2">
        <h4> <?= Html::a($partido->equipoLocal->nombre, ['equipos/vista', 'id' => $partido->equipoLocal->id]) ?> - <?= Html::a($partido->equipoVisitante->nombre, ['equipos/vista', 'id' => $partido->equipoVisitante->id]) ?></h4>
        <p> <?= $partido->lugar; ?> </p>
        <p> <?= date('d-m-Y H:i', strtotime($partido->horario)); ?></p>
    </div>
<?php endforeach; ?>

<h2>Jugadores Destacados</h2>
<?php foreach ($jugadoresDestacados as $jugador): ?>
    <div class="marco2">
        <h4> <?= $jugador->nombre; ?> </h4>
        <p> <?= $jugador->estadisticas->puntos; ?> </p>
        <p> <?= $jugador->estadisticas->rebotes; ?> </p>
        <p> <?= $jugador->estadisticas->asistencias; ?> </p>
    </div>
<?php endforeach; ?>
