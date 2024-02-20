<?php
use yii\helpers\Html;

$this->title = 'Logs';

$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<table class="table">
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
                    <?= Html::a('Descargar', ['descarga', 'file' => $log['name']], ['class' => 'btn btn-primary']) ?>

                    <?= Html::a('Eliminar', ['borrar', 'file' => $log['name']], ['class' => 'btn btn-danger', 'data' => ['confirm' => '¿Estás seguro que deseas eliminar este archivo?']]) ?>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
