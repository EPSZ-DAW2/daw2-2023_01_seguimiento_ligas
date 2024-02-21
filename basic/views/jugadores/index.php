<?php
use app\models\Usuarios;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\grid\ActionColumn;
use yii\helpers\Url;
use yii\widgets\Pjax;

if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2 && Yii::$app->user->identity->id_rol != 6)) {
    ?>
    <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Jugadores</title>
</head>
<body>

<div class="contenido-cabecera">

<h1>JUGADORES</h1>

</div>


    <div  id="contenedor-principal">


    <div class="marco">

        <?php
        echo Html::beginForm(['jugadores/index'], 'get');
        echo Html::dropDownList('ligaId', Yii::$app->request->get('ligaId'), \yii\helpers\ArrayHelper::map($ligas, 'id', 'nombre'), ['prompt' => 'Selecciona una liga']); 
        ?>
        <br><br>
        <?php
        echo Html::submitButton('Filtrar', ['class' => 'botonFormulario']);
        echo Html::endForm();
        ?>
        <br>
        <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'tableOptions' => ['class' => 'table table-striped table-bordered', 'style' => 'background-color: rgba(255, 255, 255, 0.8); border: 2px solid #000;'],
            'summary' => '<p class="PaginaDeInicio">Mostrando {begin}-{end} de {totalCount} elementos</p>', // Personalizar el mensaje
            'emptyText' => 'No se encontraron resultados.', // Personalizar el mensaje para cuando no hay resultados
            'columns' => [
                [
                    'attribute' => 'imagen',
                    'format' => 'html',
                    'value' => function ($model) {
                        return Html::tag('div', '', [
                            'class' => 'liga-image',
                            'style' => 'background-image: url("' . Yii::getAlias('@web/images/' . $model->imagen->foto) . '");',
                        ]);
                    },
                ],
                [
                    'attribute' => 'nombre',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::a($model->nombre, ['jugadores/view', 'id' => $model->id], ['class' => 'enlace-equipo']);
                    },
                    'filter' => Html::textInput('JugadoresSearch[nombre]', isset(Yii::$app->request->get('JugadoresSearch')['nombre']) ? Yii::$app->request->get('JugadoresSearch')['nombre'] : null, ['class' => 'form-control']),
                ],
                'posicion',
                'descripcion',
                'altura',
                'peso',
                'nacionalidad',
                [
                    'attribute' => 'equipo.nombre',
                    'label' => 'Equipo',
                    'value' => function ($model) {
                        return $model->equipo->nombre; // Accede al nombre del equipo a través de la relación
                    },
                    'filter' => Html::textInput('JugadoresSearch[nombre_equipo]', isset(Yii::$app->request->get('JugadoresSearch')['nombre_equipo']) ? Yii::$app->request->get('JugadoresSearch')['nombre_equipo'] : null, ['class' => 'form-control']),
                    'filterInputOptions' => ['placeholder' => 'Buscar por nombre de equipo'],
                    'filterOptions' => ['class' => 'col-md-6'],
                ],                    
            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>


    </div>
</body>
</html>


<?php
    } else { ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">   
        <title>Tabla de Jugadores</title>
    </head>
    <body>

    <div class="contenido-cabecera">

        <h1>JUGADORES</h1>

        </div>


    <div  id="contenedor-principal">
    
        <div class="marco">

        <p class="PaginaDeInicio">Listado de jugadores</p>
        
            <?php
            echo Html::beginForm(['jugadores/index'], 'get');
            echo Html::dropDownList('ligaId', Yii::$app->request->get('ligaId'), \yii\helpers\ArrayHelper::map($ligas, 'id', 'nombre'), ['prompt' => 'Selecciona una liga']);
            ?>
            <br><br>
            <?php
            echo Html::submitButton('Filtrar', ['class' => 'botonFormulario']);
            echo Html::endForm();
            ?>
            <br>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'tableOptions' => ['class' => 'table table-striped table-bordered', 'style' => 'background-color: rgba(255, 255, 255, 0.8); border: 2px solid #000;'],
                'summary' => '<p class="PaginaDeInicio">Mostrando {begin}-{end} de {totalCount} elementos</p>', // Personalizar el mensaje
                'emptyText' => 'No se encontraron resultados.', // Personalizar el mensaje para cuando no hay resultados
                'columns' => [
                    [
                'attribute' => 'imagen',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::tag('div', '', [
                        'class' => 'liga-image',
                        'style' => 'background-image: url("' . Yii::getAlias('@web/images/' . $model->imagen->foto) . '");',
                    ]);
                },
            ],
            [
                'attribute' => 'nombre',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->nombre, ['jugadores/view', 'id' => $model->id]);
                },
            ],
                    'posicion',
                    'descripcion',
                    'altura',
                    'peso',
                    'nacionalidad',
                    [
                        'attribute' => 'equipo.nombre',
                        'label' => 'Equipo',
                    ],
                    'video',
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, app\models\Jugadores $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                         }
                    ],

                ],
            ]); ?>
        <br>
        <?= \yii\helpers\Html::a('Registrar Jugador', ['jugadores/create'], ['class' => 'botonFormulario']) ?>
    
    </body>
    </html>
<?php } ?>

