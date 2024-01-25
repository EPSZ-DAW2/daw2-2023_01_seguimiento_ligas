<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php $this->registerCssFile('@web/css/partidos.css'); ?>

    <title>Partidos</title>
</head>
<body>
    <div class="marco">
        <h1>Partidos</h1>

        <table class="tabla">
        <thead class="cabecera filas">
            <tr>
                <th>Equipo Local</th>
                <th>Puntos Local</th>
                <th>Puntos Visit</th>
                <th>Equipo Visit</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($partidos as $partido): ?>
                <tr class="filas">
                    <td class="filas"><?= $partido['equipo_local']['nombre'] ?></td>
                    <td class="filas"><?php echo $partido['resultado_local']; ?></td>
                    <td class="filas"><?php echo $partido['resultado_visitante']; ?></td>
                    <td class="filas"><?= $partido['equipo_visitante']['nombre'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>

        <!-- Botón para agregar partido -->
        <div>
            <?= \yii\helpers\Html::a('Crear Nuevo Partido', ['partidos/create'], ['class' => 'botonInicioSesion']) ?>
        </div>
    </div>
</body>