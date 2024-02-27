<?php
use yii\helpers\Html;
use app\models\EstadisticasJugador;
?> 

<div class="contenido-cabecera">  
    
    <h1><?= $equipo->nombre; ?></h1>  

</div>


<div id="contenedor-principal">
    
    <div class="liga-container3">

    <h2>Estadísticas de la temporada:</h2>
    <?php if ($estadisticas !== null): ?>
    <table style="margin: 0 auto;">
        <tr>
            <th>Partidos Jugados</th>
            <th>Victorias</th>
            <th>Derrotas</th>
        </tr>
        <tr>
            <td><?= $estadisticas->partidos_jugados ?></td>
            <td><?= $estadisticas->victorias ?></td>
            <td><?= $estadisticas->derrotas ?></td>
            <td><?= $estadisticas->empates ?></td>
        </tr>
    </table>
    <?php else: ?>
        <p>No hay estadísticas disponibles para la temporada actual.</p>
    <?php endif; ?>

    </div>

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
        <h3><?= $jugador->nombre; ?></h3>
        <?php
        // Obtener las estadísticas del jugador
        $estadisticas = EstadisticasJugador::findOne(['id_jugador' => $jugador->id]);

        if ($estadisticas !== null) {
            echo "<p>Puntos: {$estadisticas->puntos}</p>";
            echo "<p>Rebotes: {$estadisticas->rebotes}</p>";
            echo "<p>Asistencias: {$estadisticas->asistencias}</p>";
        } else {
            echo "<p>No hay estadísticas disponibles para este jugador.</p>";
        }
        ?>
    <?php endforeach; ?>

    <?= Html::a('Ver todos', ['jugadores/ver-por-equipo', 'id'=>$equipo->id], ['class' => 'botonFormulario']) ?>
</div>

</div>
