<?php

namespace app\controllers;

use Yii;
use app\models\Equipos;
use yii\web\Controller;


class EquiposController extends Controller
{
    public function actionIndex()
    {
        // Obtén todos los equipos desde la base de datos
        $equipos = Equipos::find()->all();

        // Renderiza la vista y pasa los equipos como parámetro
        return $this->render('index', [
            'equipos' => $equipos,
        ]);
    }

    public function actionCreate()
    {
        $model = new Equipos();  // Crea una nueva instancia del modelo Equipos

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // Manejar la lógica después de guardar el modelo (por ejemplo, redirigir a la vista de detalles)
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionUpdate()
    {
        return $this->render('update');
    }

    public function actionView()
    {
        return $this->render('view');
    }
}
