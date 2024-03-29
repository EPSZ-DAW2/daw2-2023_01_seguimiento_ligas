<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="usuarios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'nombre:ntext',
        'apellido1:ntext',
        'apellido2:ntext',
        'email:ntext',
        'password:ntext',
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
                    return Html::img($urlImagen, ['alt' => 'Foto de usuario']);
                }

                return 'Sin foto';
            },
        ],
    ],
]) ?>

</div>
