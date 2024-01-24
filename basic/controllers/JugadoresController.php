<?php

namespace app\controllers;

use Yii;
use app\models\Jugadores;
use app\models\EstadisticasJugador;
use app\models\Temporadas;
use yii\web\Controller;


class JugadoresController extends Controller
{
    public function actionIndex()
    {
        // Obtén todos los equipos desde la base de datos
        $jugadores = Jugadores::find()->with('equipo')->all();

        // Renderiza la vista y pasa los equipos como parámetro
        return $this->render('index', [
            'jugadores' => $jugadores,
        ]);
    }

    public function actionCreate()
    {
        $model = new Jugadores();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $estadisticasJugador = new EstadisticasJugador();

            $estadisticasJugador->id_temporada = Temporadas::find()->orderBy(['id' => SORT_DESC])->one()->id;
            $estadisticasJugador->id_equipo = $model->id_equipo;
            $estadisticasJugador->id_jugador = $model->id;
            $estadisticasJugador->partidos_jugados = 0;
            $estadisticasJugador->puntos = 0;
            $estadisticasJugador->rebotes = 0;
            $estadisticasJugador->asistencias = 0;

            $estadisticasJugador->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model === null) {
            throw new NotFoundHttpException('El jugador solicitado no existe.');
        }

        if($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
    
        $model->load('estadisticasJugador');
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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