<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = $model->username;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="usuarios-view">

    <h1 class="PaginaDeInicio"><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
    'model' => $model,
    'options' => ['class' => 'table table-bordered detail-view', 'style' => 'background-color: rgba(255, 255, 255, 0.8); border: 1px solid #000;'], // Clase, fondo blanco y bordes
    'template' => "<tr><th style='width:20%; text-align: center; font-weight: bold;'>{label}</th><td style='width:80%; text-align: center;'>{value}</td></tr>", // Plantilla personalizada sin centrado
    'attributes' => [
        'nombre:ntext',
        'apellido1:ntext',
        'apellido2:ntext',
        'email:ntext',
        'provincia:ntext',
        'username:ntext',
    ],
]) ?>

    <p>
        <?= Html::a(Yii::t('app', 'Actualizar contenido'), ['update', 'id' => $model->id], ['class' => 'botonInicioSesion']) ?>
        <?= Html::a(Yii::t('app', 'Borrar cuenta'), ['delete', 'id' => $model->id], [
            'class' => 'botonInicioSesion',
            'data' => [
                'confirm' => Yii::t('app', '¿Estas seguro que quieres eliminar la cuenta?'),
                'method' => 'post',
            ],
        ]) ?>
        <!--<?= Html::a(Yii::t('app', 'Atras'), Yii::$app->request->referrer ?: Yii::$app->homeUrl, ['class' => 'botonInicioSesion']) ?>-->


    </p>
</div>
