<?php

namespace app\controllers;

use Yii;
use app\models\Temporadas;
use app\models\Ligas;
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

            // Comprobar que la fecha de final es posterior que la de inicio
            if ($model->fecha_inicial > $model->fecha_final) {
                Yii::$app->session->setFlash('error', 'La fecha de inicio de la temporada debe ser anterior a la fecha de fin.');
                return $this->render('create', ['model' => $model]);
            }

            // Validar que la temporada tenga una duración mínima de 2 semanas
            $fechaInicio = strtotime($model->fecha_inicial);
            $fechaFin = strtotime($model->fecha_final);

            $duracionMinima = 2 * 7 * 24 * 60 * 60; // 2 semanas en segundos

            if ($fechaFin - $fechaInicio < $duracionMinima) {
                Yii::$app->session->setFlash('error', 'La temporada debe tener una duración mínima de 2 semanas.');
                return $this->render('create', ['model' => $model]);
            }

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