<?php $this->registerCssFile('@web/css/equipos.css');

use yii\helpers\Html;
use yii\grid\GridView;

$this->params['breadcrumbs'][] = [
    'label' => 'Temporadas',
    'url' => ['temporadas/index'],
];

$this->title = 'Jornadas de ' . $temporada->texto_de_titulo;
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="marco">

<?php if (empty($jornadas)): ?>
    <p>No hay jornadas disponibles.</p>
<?php else: ?>
    <?php foreach ($jornadas as $jornada): ?>
        <?php
            $fechaInicio = date('d-m-Y', strtotime($jornada->fecha_inicio));
            $fechaFinal = date('d-m-Y', strtotime($jornada->fecha_final));
        ?>
        <p><a href="<?= Yii::$app->urlManager->createUrl(['/partidos', 'jornadaID' => $jornada->id]) ?>"> Jornada <?= $jornada->numero ?> </a> <br> <?= $fechaInicio ?> - <?= $fechaFinal ?> <br></p>
        <hr>
    <?php endforeach; ?>
<?php endif; ?>

</div>

<?php if (!Yii::$app->user->isGuest && (Yii::$app->user->identity->id_rol == 1 || Yii::$app->user->identity->id_rol == 3)): ?>
    <?= Html::a('Nueva Jornada', ['jornadas/create', 'temporadaID' => $temporada->id], ['class' => 'botonFormulario']) ?>
<?php endif ?>