<?php
use yii\helpers\Html;
?>

<div class="contenido-cabecera">
    <h1><?= Html::encode($equipo->nombre) ?></h1>
</div>

<div class="contenedor-jugadores">
    <?php foreach ($jugadores as $jugador): ?>
        <div class="marco2">
            <div class="jugador-content">
                <?php
                // Mostrar la foto del jugador con estilos CSS
                if ($jugador->imagen) {
                    echo Html::a(
                        Html::img(Yii::getAlias('@web/images/') . $jugador->imagen->foto, ['alt' => 'Foto de ' . $jugador->nombre, 'style' => 'max-width: 200px; max-height: 200px;']),
                        ['jugadores/view', 'id' => $jugador->id], // Enlace a la vista 'jugadores/view.php' con el ID del jugador
                        ['class' => 'jugador-link']
                    );
                }
                ?>
                <h2><?= Html::a(Html::encode($jugador->nombre), ['jugadores/view', 'id' => $jugador->id], ['class' => 'jugador-link']) ?></h2>
                <p><?= Html::encode($jugador->posicion) ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>
