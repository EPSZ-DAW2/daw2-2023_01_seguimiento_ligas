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


<div class="contenido-cabecera">

    <h1>DATOS DE USUSARIO <?= Html::encode($this->title) ?></h1>

</div>


<div id="contenedor-principal">

    <div class="marco">

    <?= DetailView::widget([
    'model' => $model,
    'options' => ['class' => 'table table-bordered detail-view', 'style' => 'background-color: rgba(255, 255, 255, 0.8); border: 1px solid #000;'], // Clase, fondo blanco y bordes
    'template' => "<tr><th style='width:20%; text-align: center; font-weight: bold;'>{label}</th><td style='width:80%; text-align: center;'>{value}</td></tr>", // Plantilla personalizada sin centrado
    'attributes' => [
        'id',
        'nombre:ntext',
        'apellido1:ntext',
        'apellido2:ntext',
        'email:ntext',
        'provincia:ntext',
        'username:ntext',
        [
            'attribute' => 'id_imagen',
            'format' => 'html',
            'value' => function ($model) {
                // Obtener el modelo de Imagenes asociado
                $imagen = \app\models\Imagenes::findOne($model->id_imagen);

                // Comprobar si se encontró la imagen y si tiene un nombre de archivo
                if ($imagen && $imagen->foto) {
                    $urlImagen = Yii::getAlias('@web/images/') . $imagen->foto;
                    return Html::img($urlImagen, ['alt' => 'Foto de usuario', 'style' => 'width: 60px; height: 60px;']);
                }

                return 'Sin foto';
            },
        ],
    ],
]) ?>


    <?php if (((Yii::$app->user->identity->id_rol == 1) || (Yii::$app->user->identity->id_rol == 2))) {?>
        
        <p>
        <?= Html::a(Yii::t('app', 'Actualizar contenido'), ['update', 'id' => $model->id], ['class' => 'botonFormulario']) ?>
        <?= Html::a(Yii::t('app', 'Borrar cuenta'), ['delete', 'id' => $model->id], [
            'class' => 'botonFormulario',
            'data' => [
                'confirm' => Yii::t('app', '¿Estas seguro que quieres eliminar la cuenta?'),
                'method' => 'post',
            ],
    ]) ?>
        <?= Html::a(Yii::t('app', 'Tabla de Usuarios'), ['usuarios/index'], ['class' => 'botonFormulario']) ?>
        </p>

    <?php } else { ?>
    
        <p>
        <?= Html::a(Yii::t('app', 'Actualizar contenido'), ['update', 'id' => $model->id], ['class' => 'botonFormulario']) ?>
        <?= Html::a(Yii::t('app', 'Borrar cuenta'), ['delete', 'id' => $model->id], [
            'class' => 'botonFormulario',
            'data' => [
                'confirm' => Yii::t('app', '¿Estas seguro que quieres eliminar la cuenta?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'Ir a Inicio'), Yii::$app->homeUrl, ['class' => 'botonFormulario']) ?>
        </p>

    <?php } ?>

        </div>
</div>
