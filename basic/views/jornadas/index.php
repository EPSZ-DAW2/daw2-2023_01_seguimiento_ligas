<?php $this->registerCssFile('@web/css/equipos.css');

use yii\helpers\Html;
use yii\grid\GridView;

$this->params['breadcrumbs'][] = [
    'label' => 'Temporadas',
    'url' => ['temporadas/index'],
];

$this->title = 'Jornadas de ' . $temporada->texto_de_titulo;
//$this->params['breadcrumbs'][] = $this->title;

?>

<div class="contenido-cabecera">

    <h1>JORNADAS DE LA TEMPORADA <?= Html::encode($temporada->texto_de_titulo) ?></h1>

</div>

<div id="contenedor-principal">

    <div class="marco2">
    <?php if (empty($jornadas)): ?>
        <p>No hay jornadas disponibles.</p>
    <?php else: ?>
        <?php foreach ($jornadas as $jornada): ?>
            <?php
                $fechaInicio = date('d-m-Y', strtotime($jornada->fecha_inicio));
                $fechaFinal = date('d-m-Y', strtotime($jornada->fecha_final));
            ?>
            <p><a href="<?= Yii::$app->urlManager->createUrl(['/partidos', 'jornadaID' => $jornada->id]) ?>"> Jornada <?= $jornada->numero ?> </a> <br> <?= $fechaInicio ?> - <?= $fechaFinal ?> <br></p>
            
            <?php if (!Yii::$app->user->isGuest && (Yii::$app->user->identity->id_rol == 1 || Yii::$app->user->identity->id_rol == 2 || Yii::$app->user->identity->id_rol == 4)): ?>
                <?= Html::a('Ver Detalles', ['jornadas/view', 'id' => $jornada->id], ['class' => 'botonFormulario']) ?>
                <?= Html::a('Copiar Jornada', ['copy', 'id' => $jornada->id], ['class' => 'botonFormulario']) ?>
            <?php endif ?>

            <hr>
            
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (!Yii::$app->user->isGuest && (Yii::$app->user->identity->id_rol == 1 || Yii::$app->user->identity->id_rol == 2 || Yii::$app->user->identity->id_rol == 4)): ?>
    <?= Html::a('Nueva Jornada', ['jornadas/create', 'temporadaID' => $temporada->id], ['class' => 'botonFormulario']) ?>
    <?php endif ?>

    </div>



</div>

