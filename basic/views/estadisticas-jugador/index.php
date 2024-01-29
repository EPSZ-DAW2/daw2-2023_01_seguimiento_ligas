<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php $this->registerCssFile('@web/css/site.css'); ?>

    <title>Tabla de Estadísticas de Jugadores</title>
</head>
<body>

    <h2>Tabla de Estadísticas de Jugadores</h2>

    <table class="tabla">
        <thead class="cabecera filas">
            <tr>
                <th>ID Temporada</th>
                <th>ID Equipo</th>
                <th>ID Jugador</th>
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
                    <?= \yii\helpers\Html::a('Editar', ['update', 'id' => $estadistica->id], ['class' => 'btn btn-primary']) ?>
                    <?= \yii\helpers\Html::a('Ver', ['view', 'id' => $estadistica->id], ['class' => 'btn btn-info']) ?>
                    <?= \yii\helpers\Html::a('Eliminar', ['delete', 'id' => $estadistica->id], ['class' => 'btn btn-danger', 'data' => ['confirm' => '¿Estás seguro de que deseas eliminar esta estadística?']]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <br>

</body>
</html>
