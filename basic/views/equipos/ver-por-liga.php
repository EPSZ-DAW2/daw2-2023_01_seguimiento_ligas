<?php foreach ($equipos as $equipo): ?>
    <div class="liga-container">
        <div class="liga-content">
        <h2><?= $equipo->nombre ?></h2>
        <p><?= $equipo->descripcion ?><p>
        <p><?= $equipo->temporada->texto_de_titulo ?><p>
        </div>
        <div class="liga-image" style="background-image: url('<?= Yii::getAlias('@web/images/' . $equipo->imagen->foto) ?>');"></div>
    </div>
<?php endforeach; ?>