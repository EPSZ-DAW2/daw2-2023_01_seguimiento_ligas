<?php foreach ($ligas as $liga): ?>
    <div class="liga-container">
        <div class="liga-content">
            <h2><?= $liga->nombre ?></h2>
        </div>
        <div class="liga-image" style="background-image: url('<?= Yii::getAlias('@web/images/' . $liga->imagen->foto) ?>');"></div>
    </div>
<?php endforeach; ?>