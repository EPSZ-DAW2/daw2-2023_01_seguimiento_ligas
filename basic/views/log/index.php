<?php
use yii\helpers\Html;

$this->title = 'Logs';

//$this->params['breadcrumbs'][] = $this->title;
?>


<div class="contenido-cabecera">

    <h1>LOGS</h1>

</div>

<div id="contenedor-izquierda">

    <div class="marco">

    <table class="tabla">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tamaño</th>
                <th>Última modificación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logs as $log): ?>
                <tr>
                    <td><?= Html::encode($log['name']) ?></td>
                    <td><?= Yii::$app->formatter->asShortSize($log['size']) ?></td>
                    <td><?= Yii::$app->formatter->asDatetime($log['modified']) ?></td>
                    <td>
                        <?= Html::a('Descargar', ['descarga', 'file' => $log['name']], ['class' => 'botonFormulario']) ?>

                        <?= Html::a('Eliminar', ['borrar', 'file' => $log['name']], ['class' => 'botonFormulario', 'data' => ['confirm' => '¿Estás seguro que deseas eliminar este archivo?']]) ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    </div>
</div>
