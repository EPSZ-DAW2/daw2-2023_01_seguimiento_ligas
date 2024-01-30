<?php

/** @var yii\web\View $this */
use yii\helpers\Html;
$this->registerCssFile('@web/css/site.css');


$this->title = 'ArosInsider';
?>


<div>

    <div class="contenido-cabecera">

    <h1>AROSINSIDER</h1>

    </div>
	
	<div class="marco">
	
        <p class="PaginaDeInicio">BIENVENIDO A LA MEJOR WEB DE SEGUIMIENTO DE BASKET DEL MUNDO</p>
        
		<p class="PaginaDeInicio">ArosInsider es tu destino principal para el seguimiento en tiempo real de Múltiples ligas de baloncesto.
		Sumérgete en el emocionante mundo del baloncesto con acceso a marcadores en vivo, estadísticas detalladas de equipos y jugadores, noticias exclusivas y mucho más.
		Con nuestra plataforma intuitiva, Podrás explorar resultados de partidos, seguir el rendimiento de tus equipos y jugadores favoritos, y mantener un pulso constante
		sobre las últimas actualizaciones en el mundo del baloncesto. Ya seas un seguidor apasionado, un aficionado casual o un ávido analista, ArosInsider te brinda la
		experiencia definitiva de seguimiento de liga de baloncesto. ¡Suma canastas con nosotros y mantente en la cima del juego!</p>

        <h2>Contenido:</h2>
        <br>
        
        <div class="contenedor-imagenes">
        <?php echo Html::img('@web/ImagenesVideos/ligas.jpg', ['class' => 'imagenPrincipal', 'title' => 'Ligas de Baloncesto del mundo']); ?>
        <?php echo Html::img('@web/ImagenesVideos/equipos.jpg', ['class' => 'imagenPrincipal', 'title' => 'equipos de baloncesto']); ?>
        <?php echo Html::img('@web/ImagenesVideos/jugadores.jpg', ['class' => 'imagenPrincipal',  'title' => 'Jugadores de baloncesto']); ?>
        <?php echo Html::img('@web/ImagenesVideos/estadisitcas.jpg', ['class' => 'imagenPrincipal',  'title' => 'Estadisticas de jugadores']); ?>
        <?php echo Html::img('@web/ImagenesVideos/calendario.jpg', ['class' => 'imagenPrincipal',  'title' => 'Partidos de las temporadas']); ?>
        <?php echo Html::img('@web/ImagenesVideos/noticia.png', ['class' => 'imagenPrincipal',  'title' => 'Todas las noticias de relacionadas del basket']); ?>

        </div>


        <!--
        <div class="botones-Linea">
        <a class="boton" href="<?= Yii::$app->urlManager->createUrl(['ligas/index']) ?>">LIGAS</a>
        <a class="boton" href="<?= Yii::$app->urlManager->createUrl(['temporadas/index']) ?>">TEMPORADAS</a>
        <a class="boton" href="<?= Yii::$app->urlManager->createUrl(['equipos/index']) ?>">EQUIPOS</a>
        <a class="boton" href="<?= Yii::$app->urlManager->createUrl(['partidos/index']) ?>">PARTIDOS</a>
        <a class="boton" href="<?= Yii::$app->urlManager->createUrl(['jugadores/index']) ?>">JUGADORES</a>
        <a class="boton" href="<?= Yii::$app->urlManager->createUrl(['noticias/index']) ?>">NOTICIAS</a>
        <a class="boton" href="<?= Yii::$app->urlManager->createUrl(['estadisticas-jugador/index']) ?>">E_JUGADOR</a>

        </div>
        -->
    </div>
	<div>
	
		
	
	</div>
<!--
    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
-->
</div>