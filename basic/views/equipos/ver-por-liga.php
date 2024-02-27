<?php
use yii\helpers\Html;
use app\models\Temporadas;
use app\models\Equipos;
use yii\db\Expression;
?>

<?php
$EquiposLigas = [];

// Consulta para obtener los equipos de la temporada actual
$fechaActual = date('Y-m-d');
$subquery = Temporadas::find()
    ->select('id')
    ->where(new Expression(':fechaActual BETWEEN fecha_inicial AND fecha_final', [':fechaActual' => $fechaActual]));

$query = Equipos::find()
    ->where(['id_temporada' => $subquery])
    ->with('liga', 'imagen');

// Organizar equipos por ligas
foreach ($query->each() as $equipo) {
    $ligaId = $equipo->liga->id;
    $EquiposLigas[$ligaId][] = $equipo;
}
?>

<div class="contenido-cabecera">

<h1><?= Html::encode($liga->nombre) ?></h1>

</div>

<div class="contenedor-ligas">

<?php foreach ($equipos as $equipo): ?>
    <div class="marco2">
        <div class="liga-content">
            <h2><?= Html::a($equipo->nombre, ['vista', 'id' => $equipo->id], ['class' => 'enlace-equipo']) ?></h2>
            <p><?= $equipo->descripcion ?></p>
            <p><?= $equipo->temporada->texto_de_titulo ?></p>
        </div>
        <div class="liga-image" style="background-image: url('<?= Yii::getAlias('@web/images/' . $equipo->imagen->foto) ?>');"></div>
        <br>
        <?php if (!Yii::$app->user->isGuest && (Yii::$app->user->identity->id_rol == 1 || Yii::$app->user->identity->id_rol == 2 || Yii::$app->user->id == $equipo->gestor_eq)): ?>
                <?= Html::a('Ver Detalles', ['equipos/view', 'id' => $equipo->id], ['class' => 'btn btn-info']) ?>
        <?php endif ?>
    </div>
<?php endforeach; ?>

</div>