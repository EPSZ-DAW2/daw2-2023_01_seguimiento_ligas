<?php 
use yii\helpers\Html;
use app\models\Usuarios;
use yii\widgets\DetailView;
use app\models\Patrocinadores;

$this->title = 'Detalles del Patrocinador ' . $model->nombre;
//$this->params['breadcrumbs'][] = ['label' => 'Patrocinadores', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>


<div class="contenido-cabecera">  
    <h1><?= Html::encode($this->title) ?></h1>
</div>

<div id="contenedor-principal">

<div class="marco">

    <div class="liga-image" style="background-image: url('<?= Yii::getAlias('@web/images/' . $model->imagen->foto) ?>');"></div>
    <br>
    <p class="PaginaDeInicio">Descripción:</p>
    
    <p><?= $model->descripcion ?></p>
    <?php if (!Yii::$app->user->isGuest && (Yii::$app->user->identity->id_rol == 1 || Yii::$app->user->identity->id_rol == 2 || Yii::$app->user->identity->id_rol == 5)): ?>
        <?= Html::a('Editar Patrocinador', ['patrocinadores/update', 'id' => $model->id], ['class' => 'botonFormulario']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'botonFormulario',
            'data' => [
                'confirm' => '¿Estás seguro de que deseas eliminar este equipo?',
                'method' => 'post',
            ],
        ]) ?>
    <?php endif ?>
    <?= Html::a(Yii::t('app', 'Atras'), ['index'], ['class' => 'botonFormulario']) ?>

</div>
</div>
</div>