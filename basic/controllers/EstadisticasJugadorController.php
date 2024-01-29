<?php

namespace app\controllers;

use Yii;
use app\models\EstadisticasJugador;
use app\models\Jugadores;
use yii\web\Controller;
use yii\data\ActiveDataProvider;

class EstadisticasJugadorController extends Controller
{
    public function actionIndex()
    {
        // Configura el proveedor de datos con paginación
        $dataProvider = new ActiveDataProvider([
            'query' => EstadisticasJugador::find()->with('equipo'),
            'pagination' => [
                'pageSize' => 12, // Define el número de jugadores por página
            ],
        ]);
    
        // Renderiza la vista y pasa el proveedor de datos como parámetro
        return $this->render('index', [
            'dataProvider' => $dataProvider,
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
