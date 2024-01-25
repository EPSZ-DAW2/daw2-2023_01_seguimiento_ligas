<?php

namespace app\controllers;

use Yii;
use app\models\Partidos;
use yii\web\Controller;

class PartidosController extends Controller
{
    public function actionIndex()
    {
        // Obtén todos los equipos desde la base de datos
        $partidos = Partidos::find()->all();

        // Renderiza la vista y pasa los equipos como parámetro
        return $this->render('index', [
            'partidos' => $partidos,
        ]);
    }

    public function actionCreate()
    {
        $model = new Partidos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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
        if (($model = Partidos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
?>