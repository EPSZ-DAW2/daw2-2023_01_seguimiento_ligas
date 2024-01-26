<?php

namespace app\controllers;

use Yii;
use app\models\Temporadas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TemporadasController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $this->view->title = 'ArosInsider - Temporadas';

        // Obtén todas las temporadas desde la base de datos
        $temporadas= Temporadas::find()->all();

        // Renderiza la vista y pasa los equipos como parámetro
        return $this->render('index', [
            'temporadas' => $temporadas,
        ]);
    }

    public function actionCreate()
    {
        $model = new Temporadas();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Guardar la temporada en la base de datos
            $model->save();

            // Redirigir a la vista de index o a donde desees
            return $this->redirect(['index']);
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
        $temporada = $this->findModel($id);
        $jornadas = $temporada->getJornadasTemporadas()->all();

        return $this->render('view', [
            'temporada' => $temporada,
            'jornadas' => $jornadas,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Temporadas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('La página solicitada no existe.');
    }
}
