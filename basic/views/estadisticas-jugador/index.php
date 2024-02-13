<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\grid\ActionColumn;
use yii\helpers\Url;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $this->registerCssFile('@web/css/site.css'); ?>
    <title>Tabla de Estadísticas de Jugadores</title>
</head>
<body>
    <div class="contenido-cabecera">
        <h1>ESTADISTICA DE JUGADORES</h1>
    </div>

    
<div id="contenedor-principal">
    <div class="marco">
    <div class="estadisticas-container">
        <div class="estadistica">
            <h3>Jugador con más puntos</h3>
            <h4>
            <?php
                $jugadorMasPuntos = \app\models\EstadisticasJugador::find()
                    ->orderBy(['puntos' => SORT_DESC])
                    ->one();

                echo $jugadorMasPuntos ? "{$jugadorMasPuntos->jugador->nombre}: {$jugadorMasPuntos->puntos}" : 'Sin datos';
            ?>
            </h4>
            <?php
            if($jugadorMasPuntos) {
                $siguientesPuntos = \app\models\EstadisticasJugador::find()
                ->where(['not', ['id' => $jugadorMasPuntos->id]])
                ->orderBy(['puntos' => SORT_DESC])
                ->limit(2)
                ->all();
        
                foreach ($siguientesPuntos as $jugadorPuntos) {
                    echo "<p class='nombre-secundario'>{$jugadorPuntos->jugador->nombre}</p>";
                }
            }
            ?>
        </div>
        
        <div class="estadistica">
            <h3>Jugador con más asistencias</h3>
            <h4>
            <?php
                $jugadorMasAsistencias = \app\models\EstadisticasJugador::find()
                    ->orderBy(['asistencias' => SORT_DESC])
                    ->one();

                echo $jugadorMasAsistencias ? "{$jugadorMasAsistencias->jugador->nombre}: {$jugadorMasAsistencias->asistencias}" : 'Sin datos';
            ?>
            </h4>
            <?php
            if($jugadorMasAsistencias) {
                $siguientesAsistencias = \app\models\EstadisticasJugador::find()
                ->where(['not', ['id' => $jugadorMasAsistencias->id]])
                ->orderBy(['asistencias' => SORT_DESC])
                ->limit(2)
                ->all();
        
                foreach ($siguientesAsistencias as $jugadorAsistencias) {
                    echo "<p class='nombre-secundario'>{$jugadorAsistencias->jugador->nombre}</p>";
                }
            }
            ?>
        </div>
        
        <div class="estadistica">
            <h3>Jugador con más rebotes</h3>
            <h4>
            <?php
                $jugadorMasRebotes = \app\models\EstadisticasJugador::find()
                    ->orderBy(['rebotes' => SORT_DESC])
                    ->one();

                echo $jugadorMasRebotes ? "{$jugadorMasRebotes->jugador->nombre}: {$jugadorMasRebotes->rebotes}" : 'Sin datos';
            ?>
            </h4>
            <?php
            if($jugadorMasRebotes) {
                $siguientesRebotes = \app\models\EstadisticasJugador::find()
                ->where(['not', ['id' => $jugadorMasRebotes->id]])
                ->orderBy(['rebotes' => SORT_DESC])
                ->limit(2)
                ->all();
        
                foreach ($siguientesRebotes as $jugadorRebotes) {
                    echo "<p class='nombre-secundario'>{$jugadorRebotes->jugador->nombre}</p>";
                }
            }
            ?>
        </div>
    </div>
</div>

        <div class="marco">
            <table class="tabla">
                <thead class="cabecera filas">
                    <tr>
                        <th>ID Jugador</th>
                        <th>ID Equipo</th>
                        <th>ID Temporada</th>
                        <th>Partidos Jugados</th>
                        <th>Puntos</th>
                        <th>Rebotes</th>
                        <th>Asistencias</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($estadisticasJugadores as $estadistica): ?>
                        <tr class="filas">
                            <td class="filas"><?= $estadistica->jugador->nombre ?></td>
                            <td class="filas"><?= $estadistica->equipo->nombre ?></td>
                            <td class="filas"><?= $estadistica->temporada->texto_de_titulo ?></td>
                            <td class="filas"><?= $estadistica->partidos_jugados ?></td>
                            <td class="filas"><?= $estadistica->puntos ?></td>
                            <td class="filas"><?= $estadistica->rebotes ?></td>
                            <td class="filas"><?= $estadistica->asistencias ?></td>
                            <td class="filas">
                                <!-- Botones de Acciones -->
                                <?= \yii\helpers\Html::a('Editar', ['update', 'id' => $estadistica->id], ['class' => 'botonPequeño']) ?>
                                <?= \yii\helpers\Html::a('Ver', ['view', 'id' => $estadistica->id], ['class' => 'botonPequeño']) ?>
                                <?= \yii\helpers\Html::a('Eliminar', ['delete', 'id' => $estadistica->id], ['class' => 'botonPequeño', 'data' => ['confirm' => '¿Estás seguro de que deseas eliminar esta estadística?']]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

