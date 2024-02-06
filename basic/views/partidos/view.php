<?php
/** @var yii\web\View $this */
/** @var app\models\Partido $model */
/** @var app\models\Comentarios $nuevoComentarioModel */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Detalles del Partido: ' . $model->equipoLocal->nombre . ' vs ' . $model->equipoVisitante->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Partidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="partido-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Lugar: <?= Html::encode($model->lugar) ?></p>
    <p>Fecha y Hora: <?= (new DateTime($model->horario))->format('d/m/Y H:i:s') ?></p>
    <p>Jornada: <?= Html::encode($model->jornada->numero) ?></p>
    <p>Temporada: <?= Html::encode($model->jornada->temporada->texto_de_titulo) ?></p>

    <?php
        // Obtener la fecha actual
        $fechaActual = new DateTime();

        // Obtener la fecha del partido
        $fechaPartido = new DateTime($model->horario);

        // Si la fecha del partido ha pasado
        if ($fechaActual > $fechaPartido) {
            echo "<p>Resultado: {$model->resultado_local} - {$model->resultado_visitante}</p>";
        } else {
            // Si el partido es futuro, mostrar la fecha y hora futuras
            echo "<p>". $fechaPartido->format('d/m/Y H:i:s') . "</p>";
        }
        ?>

    <?= Html::a('Actualizar Partido', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Eliminar Partido', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => '¿Estás seguro de que quieres eliminar este partido?',
            'method' => 'post',
        ],
    ]) ?>

</div>

<div class="marco">
    <?php if (!empty($comentarios)): ?>
        <?php foreach ($comentarios as $comentario): ?>
            <?php if ($comentario->id_partido == $model->id): ?>
                <div class="comentario">
                    <p><?= Html::encode($comentario->texto_comentario) ?></p>
                    <small>Por: <?= Html::encode($comentario->usuario->nombre) ?> el <?= Html::encode($comentario->fecha_hora) ?></small>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay comentarios disponibles.</p>
    <?php endif; ?>

    <?php
    if (!Yii::$app->user->isGuest) {
        $nuevoComentarioModel = new \app\models\Comentarios();
        $form = ActiveForm::begin(); ?>
        <?= $form->field($nuevoComentarioModel, 'texto_comentario')->textarea(['rows' => 4]) ?>
        <div class="form-group">
            <?= Html::submitButton('Agregar Comentario', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end();
    } else {
        // Si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
        Yii::$app->session->setFlash('error', 'Debes iniciar sesión para escribir comentarios.');
    }?>
</div>