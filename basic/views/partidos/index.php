<h1>Partidos</h1>

<?php foreach ($partidos as $partido): ?>
    <div class="equipos_presentacion">
        <h2><?= $partido->equipoLocal->nombre ?> (<?= $partido->resultado_local ?> puntos)</h2>
        <h2><?= $partido->equipoVisitante->nombre ?> (<?= $partido->resultado_visitante ?> puntos)</h2>
    </div>
<?php endforeach; ?>