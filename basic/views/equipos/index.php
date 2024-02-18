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
    
    <h1>EQUIPOS</h1>  

</div>

<div id="contenedor-principal">

    <div id="botonArriba">
    <?php if (!Yii::$app->user->isGuest && (Yii::$app->user->identity->id_rol == 1 || Yii::$app->user->identity->id_rol == 2 || Yii::$app->user->identity->id_rol == 6)): ?>
        <?= Html::a('Crear Nuevo Equipo', ['equipos/create'], ['class' => 'botonFormulario']) ?>
    <?php endif; ?>
    </div>
    <?php foreach ($EquiposLigas as $ligaId => $equiposPorLiga): ?>   
        
        <h2 class="tituloNegro"><?= $equiposPorLiga[0]->liga->nombre ?></h2>
            <?php foreach ($equiposPorLiga as $equipo): ?>
                <div class="liga-container2">
                    <div class="liga-content2">
                    <h2><?= Html::a($equipo->nombre, ['vista', 'id' => $equipo->id], ['class' => 'enlace-equipo']) ?></h2>
                        <p class="PaginaDeInicio"><?= $equipo->descripcion ?></p>
                        <p class="PaginaDeInicio"><?= $equipo->temporada->texto_de_titulo ?></p>
                        <?php if (!Yii::$app->user->isGuest && (Yii::$app->user->identity->id_rol == 1 || Yii::$app->user->identity->id_rol == 2 || Yii::$app->user->identity->id_rol == 6)): ?>
                            <?= Html::a('Ver Detalles', ['equipos/view', 'id' => $equipo->id], ['class' => 'botonFormulario']) ?>
                            <?= Html::a('Copiar Equipo', ['copy', 'id' => $equipo->id], ['class' => 'botonFormulario']) ?>
                        <?php endif ?>
                    </div>
                    <br>
                    <div class="liga-image" style="background-image: url('<?= Yii::getAlias('@web/images/' . $equipo->imagen->foto) ?>');"></div>
                    <br>
                </div>
            <?php endforeach; ?>
    <?php endforeach; ?>
</div>