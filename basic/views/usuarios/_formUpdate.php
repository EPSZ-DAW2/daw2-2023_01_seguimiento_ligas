<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\Roles; // Asegúrate de importar el modelo Roles

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
/* @var $form yii\widgets\ActiveForm */

// Obtener el ID del usuario actual
$userId = Yii::$app->user->identity->id;

// Construir la URL dinámicamente utilizando el ID del usuario actual
$url = Url::to(['usuarios/view', 'id' => $userId]);

?>


<?php if (Yii::$app->user->identity->id_rol == 1)  {?>
<div class="marco">

<?php $form = ActiveForm::begin([
    'id' => 'usuarios-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
]); ?>

    <?= $form->field($model, 'nombre', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'apellido1', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'apellido2', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'email', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'password', ['options' => ['class' => 'campoTitulo']])->passwordInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'provincia', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'id_rol', ['options' => ['class' => 'campoTitulo']])
    ->dropDownList(
        Roles::find()->select(['nombre', 'id'])->indexBy('id')->orderBy(['id' => SORT_ASC])->offset(1)->limit(6)->column(),
        ['prompt' => 'Seleccionar Rol', 'class' => 'campo']
    )
    ->label('Rol') ?>
    <?= $form->field($model, 'username', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($imagenModel, 'imagenFile', ['options' => ['class' => 'campoTitulo']])->fileInput(['class' => 'campo'])->label('Subir Imagen') ?>
    <br>


    <?php if (!Yii::$app->user->isGuest && (Yii::$app->user->identity->id_rol == 6)) {?>
    
    <p>
    <?= Html::submitButton(Yii::t('app', 'Modificar'), ['class' => 'botonFormulario']) ?>
    <?= Html::a(Yii::t('app', 'Volver'), $url, ['class' => 'botonFormulario']) ?>
    </p>

    <?php } else { ?>
    
    <p>
    <?= Html::submitButton(Yii::t('app', 'Modificar'), ['class' => 'botonFormulario']) ?>
    <?= Html::a(Yii::t('app', 'Tabla de Usuarios'), ['usuarios/index'], ['class' => 'botonFormulario']) ?>
    </p>

    <?php } ?>



<?php ActiveForm::end(); ?>

<?php } else { ?>

    <div class="marco">

<?php $form = ActiveForm::begin([
    'id' => 'usuarios-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
]); ?>

    <?= $form->field($model, 'nombre', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'apellido1', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'apellido2', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'email', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'password', ['options' => ['class' => 'campoTitulo']])->passwordInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'provincia', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($model, 'id_rol', ['options' => ['class' => 'campoTitulo']])
    ->dropDownList(
        Roles::find()->select(['nombre', 'id'])->indexBy('id')->orderBy(['id' => SORT_ASC])->offset(2)->limit(6)->column(),
        ['prompt' => 'Seleccionar Rol', 'class' => 'campo']
    )
    ->label('Rol') ?>
    <?= $form->field($model, 'username', ['options' => ['class' => 'campoTitulo']])->textInput(['maxlength' => true, 'class' => 'campo']) ?>
    <br>
    <?= $form->field($imagenModel, 'imagenFile', ['options' => ['class' => 'campoTitulo']])->fileInput(['class' => 'campo'])->label('Subir Imagen') ?>
    <br>


    <?php if (!Yii::$app->user->isGuest && (Yii::$app->user->identity->id_rol == 6)) {?>
    
    <p>
    <?= Html::submitButton(Yii::t('app', 'Modificar'), ['class' => 'botonFormulario']) ?>
    <?= Html::a(Yii::t('app', 'Volver'), $url, ['class' => 'botonFormulario']) ?>
    </p>

    <?php } else { ?>
    
    <p>
    <?= Html::submitButton(Yii::t('app', 'Modificar'), ['class' => 'botonFormulario']) ?>
    <?= Html::a(Yii::t('app', 'Tabla de Usuarios'), ['usuarios/index'], ['class' => 'botonFormulario']) ?>
    </p>

    <?php } ?>



<?php ActiveForm::end(); ?>

<?php } ?>


</div>
