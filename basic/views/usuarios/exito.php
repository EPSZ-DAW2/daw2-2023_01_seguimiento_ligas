//pagina que muestra un mensaje de exito si se ha compeltado el registro correctamente
<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = Yii::t('app', 'Registro completado');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-exito">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Se ha completado el registro correctamente</p>

</div>

