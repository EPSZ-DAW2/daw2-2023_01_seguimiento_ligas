<?php
use yii\helpers\Html;
use app\models\Temporadas;
use app\models\Equipos;
use yii\db\Expression;
?> 

<div class="contenido-cabecera">  
    
    <h1>Ingreso en nueva temporada</h1> 

</div>

<div id="contenedor-principal">

<div class="marco">
    
    <p class="PaginaDeInicio">Temporada Actual: <?= $temporadaActual->texto_de_titulo ?></p>

    <ul class="enlace-lista">
        <?php foreach ($temporadasFuturas as $temporada): ?>
            <li class="paginas">
                <?= Html::a($temporada->texto_de_titulo, ['cambiar-id-temporada', 'idTemporada' => $temporada->id, 'idEq' => $idEquipo]) ?>
                
            </li>
        <?php endforeach; ?>
    </ul>

    <?= Html::button('Volver', ['class' => 'botonFormulario', 'onclick' => 'window.history.back();']) ?>

</div>
</div>