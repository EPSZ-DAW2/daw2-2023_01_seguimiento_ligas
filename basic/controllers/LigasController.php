<?php

namespace app\controllers;

use Yii;
use app\models\Ligas;
use yii\web\Controller;


class LigasController extends Controller
{
    public function actionIndex()
    {
        $this->view->title = 'ArosInsider - Ligas';

        // Obtén todos los equipos desde la base de datos
        $ligas = Ligas::find()->all();

        // Renderiza la vista y pasa los equipos como parámetro
        return $this->render('index', [
            'ligas' => $ligas,
        ]);
    }

    public function actionCreate()
    {
        $model = new Ligas();  // Crea una nueva instancia del modelo Equipos

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
        if (($model = Ligas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}