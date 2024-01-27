<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php $this->registerCssFile('@web/css/site.css'); ?>

    <style>
        /* Estilo para centrar los divs */
        .estadisticas-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .estadisticas-item {
            display: inline-block;
            width: 30%;
            text-align: left;
        }
    </style>

    <title>Tabla de Jugadores</title>
</head>
<body>

    <!-- Sección de Estadísticas Destacadas -->
    <div class="estadisticas-container">
        <h2>Estadísticas Destacadas</h2>

        <!-- Div izquierdo: Jugador con más puntos -->
        <div class="estadisticas-item">
            <h3>Jugador con más puntos</h3>
            <h4>
            <?php
                $jugadorMasPuntos = \app\models\EstadisticasJugador::find()
                    ->orderBy(['puntos' => SORT_DESC])
                    ->one();

                echo $jugadorMasPuntos ? "{$jugadorMasPuntos->jugador->nombre} - Puntos: {$jugadorMasPuntos->puntos}" : 'Sin datos';
            ?>
            </h4>
            <?php
                $siguientesPuntos = \app\models\EstadisticasJugador::find()
                ->where(['not', ['id' => $jugadorMasPuntos->id]])
                ->orderBy(['puntos' => SORT_DESC])
                ->limit(2)
                ->all();
        
                foreach ($siguientesPuntos as $jugadorPuntos) {
                    echo "<p class='nombre-secundario'>{$jugadorPuntos->jugador->nombre}</p>";
                }
            ?>
        </div>

        <!-- Div centro: Jugador con más asistencias -->
        <div class="estadisticas-item">
            <h3>Jugador con más asistencias</h3>
            <h4>
            <?php
                $jugadorMasAsistencias = \app\models\EstadisticasJugador::find()
                    ->orderBy(['asistencias' => SORT_DESC])
                    ->one();

                echo $jugadorMasAsistencias ? "{$jugadorMasAsistencias->jugador->nombre} - Asistencias: {$jugadorMasAsistencias->asistencias}" : 'Sin datos';
            ?>
            </h4>
            <?php
                $siguientesAsistencias = \app\models\EstadisticasJugador::find()
                ->where(['not', ['id' => $jugadorMasAsistencias->id]])
                ->orderBy(['asistencias' => SORT_DESC])
                ->limit(2)
                ->all();
        
                foreach ($siguientesAsistencias as $jugadorAsistencias) {
                    echo "<p class='nombre-secundario'>{$jugadorAsistencias->jugador->nombre}</p>";
                }
            ?>
        </div>

        <!-- Div derecho: Jugador con más rebotes -->
        <div class="estadisticas-item">
            <h3>Jugador con más rebotes</h3>
            <h4>
            <?php
                $jugadorMasRebotes = \app\models\EstadisticasJugador::find()
                    ->orderBy(['rebotes' => SORT_DESC])
                    ->one();

                echo $jugadorMasRebotes ? "{$jugadorMasRebotes->jugador->nombre} - Rebotes: {$jugadorMasRebotes->rebotes}" : 'Sin datos';
            ?>
            </h4>
            <?php
                $siguientesRebotes = \app\models\EstadisticasJugador::find()
                ->where(['not', ['id' => $jugadorMasRebotes->id]])
                ->orderBy(['rebotes' => SORT_DESC])
                ->limit(2)
                ->all();
        
                foreach ($siguientesRebotes as $jugadorRebotes) {
                    echo "<p class='nombre-secundario'>{$jugadorRebotes->jugador->nombre}</p>";
                }
            ?>
        </div>
    </div>

    <!-- Sección de Tabla de Jugadores -->
    <div>
        <h2>Tabla de Jugadores</h2>

        <table class="tabla">
            <thead class="cabecera filas">
                <tr>
                    <th>Nombre</th>
                    <th>Posición</th>
                    <th>Descripción</th>
                    <th>Altura</th>
                    <th>Peso</th>
                    <th>Nacionalidad</th>
                    <th>Equipo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jugadores as $jugador): ?>
                    <tr class="filas">
                        <td class="filas"><?php echo $jugador['nombre']; ?></td>
                        <td class="filas"><?php echo $jugador['posicion']; ?></td>
                        <td class="filas"><?php echo $jugador['descripcion']; ?></td>
                        <td class="filas"><?php echo $jugador['altura']; ?></td>
                        <td class="filas"><?php echo $jugador['peso']; ?></td>
                        <td class="filas"><?php echo $jugador['nacionalidad']; ?></td>
                        <td class="filas"><?= isset($jugador->equipo) ? $jugador->equipo->nombre : 'Sin equipo' ?></td>
                        <td class="filas">
                            <!-- Botones de Acciones -->
                            <?= \yii\helpers\Html::a('Editar', ['jugadores/update', 'id' => $jugador['id']], ['class' => 'btn btn-primary']) ?>
                            <?= \yii\helpers\Html::a('Ver', ['jugadores/view', 'id' => $jugador['id']], ['class' => 'btn btn-info']) ?>
                            <?= \yii\helpers\Html::a('Eliminar', ['jugadores/delete', 'id' => $jugador['id']], ['class' => 'btn btn-danger', 'data' => ['confirm' => '¿Estás seguro de que deseas eliminar este jugador?']]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
    </div>

    <?= \yii\helpers\Html::a('Crear Nuevo Jugador', ['jugadores/create'], ['class' => 'btn btn-success']) ?>

</body>
</html>
