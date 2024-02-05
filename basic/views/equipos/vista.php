<?php
use yii\helpers\Html;
?> 

<h2>Últimos Resultados</h2>
<?php foreach ($ultimosResultados as $resultado): ?>
    <!-- Mostrar detalles de los últimos resultados -->
<?php endforeach; ?>

<h2>Próximos Partidos</h2>
<?php foreach ($proximosPartidos as $partido): ?>
    <!-- Mostrar detalles de los próximos partidos -->
<?php endforeach; ?>

<h2>Jugadores Destacados</h2>
<?php foreach ($jugadoresDestacados as $jugador): ?>
    <!-- Mostrar detalles de los jugadores destacados -->
<?php endforeach; ?>
