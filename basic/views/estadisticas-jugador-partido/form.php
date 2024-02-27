<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EstadisticasJugadorPartido */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="contenido-cabecera">  
    <h1>DETALLES DEL PARTIDO</h1>  
</div>

<div id="contenedor-principal">

    <div class="marco">
    <?php 
    if (Yii::$app->user->isGuest || (Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2)){ 
        echo "El acceso a está página esta restringido";
    }else{
    ?>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'id_partido', ['options' => ['class' => 'campoTitulo']])->hiddenInput(['value' => $idPartido, 'class' => 'campo'])->label(false) ?>
        
        <?= $form->field($model, 'id_jugador', ['options' => ['class' => 'campoTitulo']])->dropDownList($jugadores, ['prompt' => 'Seleccionar Jugador', 'class' => 'campo']) ?>
        
        <?= $form->field($model, 'id_equipo', ['options' => ['class' => 'campoTitulo']])->hiddenInput(['value' => $idEquipo])->label(false) ?>
        <br>
        <?= $form->field($model, 'minutos', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese minutos', 'class' => 'campo']) ?>
        <br>
        <?= $form->field($model, 'puntos', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese los puntos', 'class' => 'campo']) ?>
        <br>
        <?= $form->field($model, 'rebotes', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese los rebotes', 'class' => 'campo']) ?>
        <br>
        <?= $form->field($model, 'asistencias', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese las asistencias', 'class' => 'campo']) ?>
        <br>

        <p>
            <?= Html::submitButton('Guardar', ['class' => 'botonFormulario']) ?>
            <?= Html::a('Atras', Yii::$app->request->referrer ?: Yii::$app->homeUrl, ['class' => 'botonFormulario']) ?>
        </p>

        <?php ActiveForm::end(); ?>

    </div>
</div>

<?php     
}
?>
