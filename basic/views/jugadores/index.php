<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php $this->registerCssFile('@web/css/jugadores.css'); ?>

    <title>Tabla de Jugadores</title>
</head>
<body>

    <div class="marco">

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
                    <td class="filas"><?php echo $jugador['id_equipo']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>

    <div>
        <?= \yii\helpers\Html::a('Crear Nuevo Jugador', ['jugadores/create'], ['class' => 'botonInicioSesion']) ?>
    </div>
    </div>
</body>
</html>



