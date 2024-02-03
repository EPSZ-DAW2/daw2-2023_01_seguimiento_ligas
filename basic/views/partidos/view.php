<?php
/** @var yii\web\View $this */
/** @var app\models\Partido $model */
/** @var app\models\Comentarios $nuevoComentarioModel */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Detalles del Partido';
$this->params['breadcrumbs'][] = ['label' => 'Partidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="partido-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="marco">
        <h2><?= Html::encode($model->equipoLocal->nombre) ?> - <?= Html::encode($model->equipoVisitante->nombre) ?></h2>
        <p>Lugar: <?= Html::encode($model->lugar) ?></p>
        <p><?= (new DateTime($model->horario))->format('d/m/Y H:i:s') ?></p>
        <p>Resultado Local: <?= Html::encode($model->resultado_local) ?></p>
        <p>Resultado Visitante: <?= Html::encode($model->resultado_visitante) ?></p>
    </div>
</div>

<div class="marco">
    <?php if (!empty($comentarios)): ?>
        <?php foreach ($comentarios as $comentario): ?>
            <div class="comentario">
                <p><?= Html::encode($comentario->texto_comentario) ?></p>
                <small>Por: <?= Html::encode($comentario->usuario->nombre) ?> el <?= Html::encode($comentario->fecha_hora) ?></small>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay comentarios disponibles.</p>
    <?php endif; ?>

    <?php
    $nuevoComentarioModel = new \app\models\Comentarios();
    $form = ActiveForm::begin(); ?>
    <?= $form->field($nuevoComentarioModel, 'texto_comentario')->textarea(['rows' => 4]) ?>
    <div class="form-group">
        <?= Html::submitButton('Agregar Comentario', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

