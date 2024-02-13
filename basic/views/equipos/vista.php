<?php
use yii\helpers\Html;
?> 

<div class="contenido-cabecera">  
    
    <h1><?= $equipo->nombre; ?></h1>  

</div>


<div id="contenedor-principal">
    
    <div class="liga-container3">

    <h2>Últimos Resultados:</h2>
    <?php foreach ($ultimosResultados as $resultado): ?>
            <h3><?= Html::a($resultado->equipoLocal->nombre, ['equipos/vista', 'id' => $resultado->equipoLocal->id], ['class' => 'enlace-equipo']) ?> - <?= Html::a($resultado->equipoVisitante->nombre, ['equipos/vista', 'id' => $resultado->equipoVisitante->id], ['class' => 'enlace-equipo']) ?></h3>
            <p> <?= $resultado->lugar; ?> : <?= date('d-m-Y H:i', strtotime($resultado->horario)); ?></p>
            <p>Resultado: <?= $resultado->resultado_local; ?> - <?= $resultado->resultado_visitante; ?></p>
    <?php endforeach; ?>

    </div>


    <div class="liga-container3">

    <h2>Próximos Partidos:</h2>
    <?php foreach ($proximosPartidos as $partido): ?>
            <h3> <?= Html::a($partido->equipoLocal->nombre, ['equipos/vista', 'id' => $partido->equipoLocal->id], ['class' => 'enlace-equipo']) ?> - <?= Html::a($partido->equipoVisitante->nombre, ['equipos/vista', 'id' => $partido->equipoVisitante->id], ['class' => 'enlace-equipo']) ?></h3>
            <p> <?= $partido->lugar; ?> </p>
            <p> <?= date('d-m-Y H:i', strtotime($partido->horario)); ?></p>
    <?php endforeach; ?>

    </div>

    <div class="liga-container3">

    <h2>Jugadores Destacados:</h2>
    <?php foreach ($jugadoresDestacados as $jugador): ?>
            <h3> <?= $jugador->nombre; ?> </h3>
            <p> <?= $jugador->estadisticas->puntos; ?> </p>
            <p> <?= $jugador->estadisticas->rebotes; ?> </p>
            <p> <?= $jugador->estadisticas->asistencias; ?> </p>
    <?php endforeach; ?>
    
    </div>
</div>
