<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\EstadisticasJugador $model */
/** @var yii\widgets\ActiveForm $form */

?>

<?php 
    if (Yii::$app->user->isGuest || (Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2)){ 
        echo "El acceso a está página esta restringido";
    }else{
?>

<div class="marco">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_temporada', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'id_equipo', ['options' => ['class' => 'campoTitulo']])->dropDownList(
        \yii\helpers\ArrayHelper::map(\app\models\Equipos::find()->all(), 'id', 'nombre'),
        ['prompt' => 'Selecciona un equipo', 'class' => 'campo']
    ) ?>
    <br>
    <?= $form->field($model, 'id_jugador', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo','readonly' => true]) ?>
    <br>
    <?= $form->field($model, 'partidos_jugados', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'puntos', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'rebotes', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'asistencias', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    
    <?= Html::submitButton('Guardar', ['class' => 'botonFormulario']) ?>
    <?= Html::a(Yii::t('app', 'Tabla de estadisticas'), ['estadisticas-jugador/index'], ['class' => 'botonFormulario']) ?>

    <?php ActiveForm::end(); ?>

</div>
<?php 
}
?>

