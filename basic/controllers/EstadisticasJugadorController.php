<?php

namespace app\controllers;

use Yii;
use app\models\EstadisticasJugador;
use app\models\Jugadores;
use yii\web\Controller;

class EstadisticasJugadorController extends Controller
{
    public function actionIndex()
    {
        // Obtén todas las estadísticas de jugadores desde la base de datos
        $estadisticasJugadores = EstadisticasJugador::find()
            ->with(['equipo', 'jugador', 'temporada'])
            ->all();

        // Renderiza la vista y pasa las estadísticas de jugadores como parámetro
        return $this->render('index', [
            'estadisticasJugadores' => $estadisticasJugadores,
        ]);
    }

    public function actionCreate()
    {
        $model = new EstadisticasJugador();  // Crea una nueva instancia del modelo EstadisticasJugador

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // Manejar la lógica después de guardar el modelo (por ejemplo, redirigir a la vista de detalles)
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
            throw new NotFoundHttpException('Las estadísticas del jugador solicitadas no existen.');
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
        $jugador = Jugadores::findOne($model->id_jugador);
    
        return $this->render('view', [
            'model' => $model,
            'jugador' => $jugador,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    protected function findModel($id)
    {
        if (($model = EstadisticasJugador::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Las estadísticas del jugador solicitadas no existen.');
        }
    }
}
