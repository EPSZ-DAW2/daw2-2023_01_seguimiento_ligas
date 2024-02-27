<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\EstadisticasJugador $model */

$this->title = $model->id_jugador; // Usar el contenido de id_jugador como título
//$this->params['breadcrumbs'][] = ['label' => 'Estadisticas Jugadores', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="contenido-cabecera">

    <h1>ESTADÍSTICAs DEl JUGADOR</h1>

</div>


<div id="contenedor-principal">

    <div class="marco">

    <p class="PaginaDeInicio">Estadisticas de <?= $model->jugador->nombre ?></p>
    <?= DetailView::widget([
        'model' => $model,
        'options' => ['class' => 'table table-bordered detail-view', 'style' => 'background-color: rgba(255, 255, 255, 0.8); border: 1px solid #000;'], // Clase, fondo blanco y bordes
        'template' => "<tr><th style='width:20%; text-align: center; font-weight: bold;'>{label}</th><td style='width:80%; text-align: center;'>{value}</td></tr>", // Plantilla personalizada sin centrado
        'attributes' => [
            [
                'label' => 'Nombre',
                'value' => $model->jugador->nombre,
            ],
            [
                'label' => 'Temporada',
                'value' => $model->temporada->texto_de_titulo,
            ],
            [
                'label' => 'Equipo',
                'value' => $model->equipo->nombre,
            ],
            'partidos_jugados',
            'puntos',
            'rebotes',
            'asistencias',
        ],
    ]) ?>

<?php if (!Yii::$app->user->isGuest && (Yii::$app->user->identity->id_rol == 1 || Yii::$app->user->identity->id_rol == 2 || Yii::$app->user->id == $equipo->gestor_eq)) { ?>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'botonFormulario']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'botonFormulario',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php } ?>
    <?= Html::a(Yii::t('app', 'Tabla de estadisticas'), ['estadisticas-jugador/index'], ['class' => 'botonFormulario']) ?>
    <?= Html::a(Yii::t('app', 'Tabla de jugadores'), ['jugadores/index'], ['class' => 'botonFormulario']) ?>

    </div>
</div>
