<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCssFile('@web/css/site.css');

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            //['label' => 'Inicio', 'url' => ['/site/index']],
            ['label' => 'Ligas', 'url' => ['/ligas/index']],
            ['label' => 'Temporadas', 'url' => ['/temporadas/index']],
            ['label' => 'Equipos', 'url' => ['/equipos/index']],
            ['label' => 'Partidos', 'url' => ['/partidos/index']],
            ['label' => 'Jugadores', 'url' => ['/jugadores/index']],
            ['label' => 'Noticias', 'url' => ['/noticias/index']],
            ['label' => 'E_Jugador', 'url' => ['/estadisticas-jugador/index']],
            //['label' => 'Usuarios', 'url' => ['/usuarios/index']],
        ]
    ]);
//  si el rol del usuario es 1 (administrador)
if (!Yii::$app->user->isGuest && Yii::$app->user->identity->id_rol == 1) {
   
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => [
            [
                'label' => 'Administración',
                'items' => [
                    ['label' => 'Roles', 'url' => ['/roles/index']],
                    ['label' => 'Usuarios', 'url' => ['/usuarios/index']],
                    ['label' => 'Imagenes', 'url' => ['/imagenes/index']],
                    ['label' => 'Ligas', 'url' => ['/ligas/index']],
                    ['label' => 'Logs', 'url' => ['/log/index']],
                    ['label' => 'Copia de seguridad', 'url' => ['/base-datos/index']],
                    // Agrega más elementos desplegables aquí si es necesario
                ],
            ],
        ],
    ]);

 
}

echo Nav::widget([
    'options' => ['class' => 'navbar-nav', 'style' => 'margin-left: auto;'],
    'items' => [
        ['label' => 'Registro', 'url' => ['/usuarios/create'], 'visible' => Yii::$app->user->isGuest],
        Yii::$app->user->isGuest
            ? ['label' => 'Iniciar sesión', 'url' => ['/usuarios/login']]
            : [
                'label' => '' . Yii::$app->user->identity->username . '',
                'items' => [
                    ['label' => 'Datos usuario', 'url' => ['/usuarios/view', 'id' => Yii::$app->user->id]],
                    ['label' => 'Cerrar sesión', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post'],
                    
                ],
            ],
        ],
    ],    
]);

//solo se muestra la foto del usuario si esta logueado
if (!Yii::$app->user->isGuest) {
    echo Html::img('@web/images/' . Yii::$app->user->identity->imagen->foto, ['alt' => 'Foto de usuario', 'style' => 'width: 30px; height: 30px; margin-left: 0%;']);
}
NavBar::end();
?>




</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; <?= date('Y') ?> ArosInsider - Tu fuente de información sobre baloncesto</div>
            <div class="col-md-6 text-center text-md-end">Desarrollado con <a href="https://www.yiiframework.com/" target="_blank">Yii Framework</a></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
