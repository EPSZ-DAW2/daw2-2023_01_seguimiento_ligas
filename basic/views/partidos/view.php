<?php
/** @var yii\web\View $this */
/** @var app\models\PartidosJornada $model */
/** @var app\models\Comentarios $nuevoComentarioModel */

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\EstadisticasJugador;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use app\models\PartidosJornada;
use app\models\Comentarios;

/* @var $this yii\web\View */
/* @var $model app\models\PartidosJornada */

$this->title = 'Detalles del Partido: ' . $model->equipoLocal->nombre . ' vs ' . $model->equipoVisitante->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Partidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<<<<<<< HEAD
<div class="partidos-jornada-view">
    <h1><?= Html::encode($this->title) ?></h1>
=======
<?php
if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2)) {
?>
    <div class="partidos-jornada-view">
>>>>>>> fd999738c508f1fb2f51727de9d93bfb576488d8

        <h1><?= Html::encode($this->title) ?></h1>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'fecha',
                'hora',
                'lugar',
                'resultado_local',
                'resultado_visitante',
                'observaciones:ntext',
            ],
        ]) ?>

        <h2>Estadísticas de Jugadores</h2>

        <h3>Equipo Local: <?= Html::encode($model->equipoLocal->nombre) ?></h3>
        <?= GridView::widget([
        'dataProvider' => $dataProviderLocal, // Utiliza el proveedor de datos para el equipo local
        'columns' => [
            'jugador.nombre', // Utiliza el nombre del jugador en lugar del nombreJugador
            'minutos',
            'puntos',
            'rebotes',
            'asistencias',
        ],
    ]); ?>

        <h3>Equipo Visitante: <?= Html::encode($model->equipoVisitante->nombre) ?></h3>
        <?= GridView::widget([
        'dataProvider' => $dataProviderVisitante, // Utiliza el proveedor de datos para el equipo visitante
        'columns' => [
            'jugador.nombre', // Utiliza el nombre del jugador en lugar del nombreJugador
            'minutos',
            'puntos',
            'rebotes',
            'asistencias',
        ],
    ]); ?>

    </div>
<?php 
    } else { ?>
        <div class="partidos-jornada-view">

        <h1><?= Html::encode($this->title) ?></h1>

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

    <?php if (!Yii::$app->user->isGuest): ?>
        <?php $form = ActiveForm::begin(['action' => ['PartidosController/actionAgregarComentario($id_partido)']]); ?>
            <?php $comentario = new Comentarios(); ?>
            <?= $form->field($comentario, 'texto_comentario')->textInput(['maxlength' => true]) ?>
            <?= Html::submitButton('Guardar Comentario', ['class' => 'btn btn-success']) ?>
        <?php ActiveForm::end(); ?>
    <?php else: ?>
        <?php // Si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión ?>
        <?php return Yii::$app->controller->redirect(['usuarios/login']); ?>
    <?php endif; ?>
</div>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'fecha',
                'hora',
                'lugar',
                'resultado_local',
                'resultado_visitante',
                'observaciones:ntext',
            ],
        ]) ?>

        <h2>Estadísticas de Jugadores</h2>

        <h3>Equipo Local: <?= Html::encode($model->equipoLocal->nombre) ?></h3>
        <?= Html::a('Añadir Estadísticas', ['estadisticas-jugador-partido/form', 'idPartido' => $model->id, 'idEquipo' => $model->equipoLocal->id], ['class' => 'btn btn-success']) ?>
        <?= GridView::widget([
        'dataProvider' => $dataProviderLocal, // Utiliza el proveedor de datos para el equipo local
        'columns' => [
            'jugador.nombre', // Utiliza el nombre del jugador en lugar del nombreJugador
            'minutos',
            'puntos',
            'rebotes',
            'asistencias',
        ],
        ]); ?>

        <h3>Equipo Visitante: <?= Html::encode($model->equipoVisitante->nombre) ?></h3>
        <?= Html::a('Añadir Estadísticas', ['estadisticas-jugador-partido/form', 'idPartido' => $model->id, 'idEquipo' => $model->equipoVisitante->id], ['class' => 'btn btn-success']) ?>
        <?= GridView::widget([
        'dataProvider' => $dataProviderVisitante, // Utiliza el proveedor de datos para el equipo visitante
        'columns' => [
            'jugador.nombre', // Utiliza el nombre del jugador en lugar del nombreJugador
            'minutos',
            'puntos',
            'rebotes',
            'asistencias',
        ],
        ]); ?>

        </div>
<?php } ?>
