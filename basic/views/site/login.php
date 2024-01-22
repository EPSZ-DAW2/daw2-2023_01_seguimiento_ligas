<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Acceso';
/*$this->params['breadcrumbs'][] = $this->title;*/

?>
<div>
    
	<h1 class="PaginaDeInicio"><?= Html::encode($this->title) ?></h1>
	
</div>

<div class="marco">

	    <p class="PaginaDeInicio">Por favor rellene los campos para inicidiar sesión:</p>

		<?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
		]); ?>
	
	


		<?= $form->field($model, 'username')->label('Correo Electrónico', ['style' => 'white-space: nowrap;'])->textInput(['autofocus' => true, 'placeholder' => 'Ingrese su correo electrónico']) ?>


		<?= $form->field($model, 'password')->label('Contraseña', ['style' => 'white-space: nowrap;'])->passwordInput(['placeholder' => 'Ingrese su contraseña']) ?>


		<?= $form->field($model, 'rememberMe')->checkbox([
			'template' => "<div class=\"offset-lg-1 col-lg-3 custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
			'label' => 'Recuérdame',
		]) ?>


<div>
    <div>
        <?= Html::submitButton('Iniciar sesión', ['class' => 'botonInicioSesion', 'name' => 'login-button']) ?>
    </div>
</div>


    <?php ActiveForm::end(); ?>

	<!--
    <div class="offset-lg-1" style="color:#999;">
        You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
        To modify the username/password, please check out the code <code>app\models\User::$users</code>.
    </div>
	-->
</div>