<div class="contenido-cabecera">
    <h1><?= Html::encode($equipo->nombre) ?></h1>
</div>

<div class="contenedor-jugadores">
    <?php foreach ($equipo->jugadores as $jugador): ?>
        <div class="marco2">
            <div class="jugador-content">
                <h2><?= $jugador->nombre ?></h2>
                <p><?= $jugador->descripcion ?></p>
                <p><?= $jugador->nacionalidad ?></p>
                <p><?= $jugador->posicion ?></p>
                <p><?= $jugador->altura ?></p>
                <p><?= $jugador->peso ?></p>
                <!-- Aquí puedes mostrar más detalles del jugador si lo deseas -->
            </div>
            <!-- Puedes mostrar la imagen del jugador si está disponible -->
            <?php if ($jugador->imagen): ?>
                <div class="jugador-image" style="background-image: url('<?= Yii::getAlias('@web/images/' . $jugador->imagen->foto) ?>');"></div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
