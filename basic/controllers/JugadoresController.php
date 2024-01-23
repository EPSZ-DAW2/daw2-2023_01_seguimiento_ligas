<?php

namespace app\controllers;

use Yii;
use app\models\Jugadores;
use yii\web\Controller;


class JugadoresController extends Controller
{
    public function actionIndex()
    {
        // Obtén todos los equipos desde la base de datos
        $jugadores = Jugadores::find()->all();

        // Renderiza la vista y pasa los equipos como parámetro
        return $this->render('index', [
            'jugadores' => $jugadores,
        ]);
    }

    public function actionCreate()
    {
        $model = new Jugadores();  // Crea una nueva instancia del modelo Equipos

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

    public function actionView($id)
    {
        $model = $this->findModel($id);
    
        return $this->render('view', [
            'model' => $model,
        ]);
    }
    
    protected function findModel($id)
    {
        if (($model = Jugadores::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}