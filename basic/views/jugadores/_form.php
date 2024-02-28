<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Jugadores;

/** @var yii\web\View $this */
/** @var app\models\Jugadores $model */
/** @var yii\widgets\ActiveForm $form */
/** @var boolean $esGestorEquipo */
/** @var integer|null $equipoId */

?>

<?php 
    if ((!Yii::$app->user->isGuest) && (in_array(Yii::$app->user->identity->id_rol, [1, 2]) || (Yii::$app->user->identity->id_rol == 6 && $esGestor))){ 
?>
<div>
    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
    ]); ?>

    <?php if (!$esGestor): ?>
        <?= $form->field($model, 'id_equipo', ['options' => ['class' => 'campoTitulo']])->dropDownList(
            \yii\helpers\ArrayHelper::map(\app\models\Equipos::find()->all(), 'id', 'nombre'),
            ['prompt' => 'Selecciona un equipo', 'class' => 'campo']
        ) ?>
        <br>
    <?php else: ?>
        <?= $form->field($model, 'id_equipo')->hiddenInput(['value' => $equipoId])->label(false) ?>
    <?php endif; ?>

    <?= $form->field($model, 'nombre', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el nombre completo del jugador', 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'descripcion', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese una breve descripcion', 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'posicion', ['options' => ['class' => 'campoTitulo']])->dropDownList([
        'Base' => 'Base',
        'Escolta' => 'Escolta',
        'Alero' => 'Alero',
        'Ala-pívot' => 'Ala-pívot',
        'Pívot' => 'Pívot',
    ], ['prompt' => 'Selecciona una posicion de Juego', 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'altura', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese la altura', 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'peso', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el peso Entre 50-180 kilos', 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'nacionalidad', ['options' => ['class' => 'campoTitulo']])->dropDownList(
        \app\models\Jugadores::getNacionalidadesList(),
        ['prompt' => 'Selecciona el país de origen', 'class' => 'campo']
    ) ?>
    <br>
    <?= $form->field($imagenModel, 'imagenFile', ['options' => ['class' => 'campoTitulo']])->fileInput(['class' => 'campo'])->label('Subir Imagen')?>
    <br>
    <?= $form->field($model, 'activo')->checkbox() ?>
    <br>
    <?= $form->field($model, 'video', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <p>
        <?= Html::submitButton('Crear/Modificar', ['class' => 'botonFormulario']) ?>
        <?= Html::a(Yii::t('app', 'Tabla de Jugadores'), ['index'], ['class' => 'botonFormulario']) ?>
    </p>

    <?php ActiveForm::end(); ?>

</div>

<?php }else{
    echo "El acceso a está página esta restringido";
}
?>