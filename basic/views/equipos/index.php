<?php $this->registerCssFile('@web/css/equipos.css'); ?>

<?php
use yii\helpers\Html; 
?> 

<?php
$EquiposLigas = [];

// Organizar equipos por ligas
foreach ($equipos as $equipo) {
    $ligaId = $equipo->liga->id;
    $EquiposLigas[$ligaId][] = $equipo;
}
?>

<div class="contenido-cabecera">  
    
<h1>EQUIPOS</h1>  

</div>

<!--<div class="contenedor-ligas"> !-->

<div class="row">
<?php foreach ($EquiposLigas as $ligaId => $equiposPorLiga): ?>
    <div class="col-md-6">
        <div class="marco2">
            <h2><?= $equiposPorLiga[0]->liga->nombre ?></h2>
        </div>
        <br>
        <?php foreach ($equiposPorLiga as $equipo): ?>
            <div class="marco2">
                <div class="liga-content">
                    <h2><?= $equipo->nombre ?></h2>
                    <p><?= $equipo->descripcion ?><p>
                    <p><?= $equipo->temporada->texto_de_titulo ?><p>
                </div>
                <div class="liga-image2" style="background-image: url('<?= Yii::getAlias('@web/images/' . $equipo->imagen->foto) ?>');"></div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php endforeach; ?>
</div>


<?= \yii\helpers\Html::a('Crear Nuevo Equipo', ['equipos/create'], ['class' => 'botonFormulario']) ?>