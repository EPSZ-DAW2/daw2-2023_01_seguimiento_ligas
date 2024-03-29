<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Jugadores $model */

$this->title = $model->nombre;
//$this->params['breadcrumbs'][] = ['label' => 'Jugadores', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$idJugador = $model->id;

// Verificar si existen estadísticas para el jugador actual
$existeEstadisticas = \app\models\EstadisticasJugador::find()
    ->where(['id_jugador' => $idJugador])
    ->exists();
    
?>

<div class="contenido-cabecera">

    <h1>DATOS DE <?= Html::encode($this->title) ?></h1>

</div>

<div id="contenedor-principal">

<?php
if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2 && Yii::$app->user->identity->id_rol != 6)) {
?>

<div class="marco">

    <p class="PaginaDeInicio">Datos de <?= Html::encode($this->title) ?></p>

    <?= DetailView::widget([
        'model' => $model,
        'options' => ['class' => 'table table-bordered detail-view', 'style' => 'background-color: rgba(255, 255, 255, 0.8); border: 1px solid #000;'], // Clase, fondo blanco y bordes
        'template' => "<tr><th style='width:20%; text-align: center; font-weight: bold;'>{label}</th><td style='width:80%; text-align: center;'>{value}</td></tr>", // Plantilla personalizada sin centrado
        'attributes' => [
            [
                'label' => 'Imagen',
                'attribute' => 'id_imagen',
                'format' => 'html',
                'value' => function ($model) {
                    $imagen = \app\models\Imagenes::findOne($model->id_imagen);

                    if ($imagen && $imagen->foto) {
                        $urlImagen = Yii::getAlias('@web/images/') . $imagen->foto;
                        return Html::img($urlImagen, ['alt' => 'Foto de jugador', 'style' => 'width: 60px; height: 60px;']);
                    }
    
                    return 'Sin foto';
                },
            ],
            [
                'label' => 'Equipo',
                'value' => $model->equipo->nombre,
            ],
            'nombre',
            'descripcion',
            'posicion',
            'altura',
            'peso',
            'nacionalidad',
        ],
    ]) ?>

    <p class="PaginaDeInicio">Videos con sus mejores jugadas</p>
    <iframe width="560" height="315" src="<?= Html::encode($model->video) ?>"
        title="YouTube video player" frameborder="0"
        allowfullscreen></iframe>
    <br><br>
    <p>

    <?php
    if ($existeRegistro) {
        echo Html::a('Ver Estadísticas', ['estadisticas-jugador/index', 'id_jugador' => $model->id, 'fromPlayerView' => true], ['class' => 'botonFormulario']);
    }
?>
        <?= Html::a(Yii::t('app', 'Atras'), ['index'], ['class' => 'botonFormulario']) ?>
    </p>

</div>

<?php
    } else { ?>
    
    <div class="marco">

    <p class="PaginaDeInicio">Datos de <?= Html::encode($this->title) ?></p>

    <?= DetailView::widget([
    'model' => $model,
    'options' => ['class' => 'table table-bordered detail-view', 'style' => 'background-color: rgba(255, 255, 255, 0.8); border: 1px solid #000;'], // Clase, fondo blanco y bordes
    'template' => "<tr><th style='width:20%; text-align: center; font-weight: bold;'>{label}</th><td style='width:80%; text-align: center;'>{value}</td></tr>", // Plantilla personalizada sin centrado
    'attributes' => [
        [
            'attribute' => 'id_imagen',
            'format' => 'html',
            'value' => function ($model) {
                $imagen = \app\models\Imagenes::findOne($model->id_imagen);

                if ($imagen && $imagen->foto) {
                    $urlImagen = Yii::getAlias('@web/images/') . $imagen->foto;
                    return Html::img($urlImagen, ['alt' => 'Foto de jugador', 'style' => 'width: 60px; height: 60px;']);
                }

                return 'Sin foto';
            },
        ],
        'id',
        'id_equipo',
        'nombre',
        'descripcion',
        'posicion',
        'altura',
        'peso',
        'nacionalidad',
        'video',
        [
            'attribute' => 'activo',
            'label' => 'Activo',
            'value' => $model->activo ? 'Sí' : 'No',
        ],
    ],
]) ?>

<p>
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'botonFormulario']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'botonFormulario',
            'data' => [
                'confirm' => '¿Estas seguro que quieres eliminar este jugador?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    </div>
<?php } ?>
    </div>