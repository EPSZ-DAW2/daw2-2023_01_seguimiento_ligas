<?php

namespace app\controllers;

use Yii;
use app\models\EstadisticasJugador;
use app\models\EstadisticasJugadorSearch;
use app\models\EstadisticasJugadorPartido;
use app\models\Jugadores;
use app\models\Ligas;
use yii\web\Controller;
use yii\data\ActiveDataProvider;

class EstadisticasJugadorController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new EstadisticasJugadorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    
        // Obtener las ligas para el dropdown
        $ligas = Ligas::find()->all();
    
        // Filtrar por la liga seleccionada
        $ligaId = Yii::$app->request->get('ligaId');
        if (!empty($ligaId)) {
            $dataProvider->query->leftJoin('equipos as e', 'estadisticas_jugador.id_equipo = e.id')
                ->andWhere(['e.id_liga' => $ligaId]);
        }
    
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'ligas' => $ligas,
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

    public function actionActualizarEstadisticas()
    {
        // Obtener todos los jugadores
        $jugadores = Jugadores::find()->all();

        foreach ($jugadores as $jugador) {
            // Obtener los registros de EstadisticasJugadorPartido para el jugador actual
            $estadisticasJugadorPartido = EstadisticasJugadorPartido::find()
                ->where(['id_jugador' => $jugador->id])
                ->andWhere(['>=', 'minutos', 0])
                ->all();

            $totalPuntos = 0;
            $totalRebotes = 0;
            $totalAsistencias = 0;
            $partidosJugados = 0; // Inicializar contador de partidos jugados

            foreach ($estadisticasJugadorPartido as $estadistica) {
                $totalPuntos += $estadistica->puntos;
                $totalRebotes += $estadistica->rebotes;
                $totalAsistencias += $estadistica->asistencias;

                // Incrementar contador si minutos > 0
                if ($estadistica->minutos > 0) {
                    $partidosJugados++;
                }
            }

            // Calcular las medias
            $mediaPuntos = count($estadisticasJugadorPartido) > 0 ? $totalPuntos / count($estadisticasJugadorPartido) : 0;
            $mediaRebotes = count($estadisticasJugadorPartido) > 0 ? $totalRebotes / count($estadisticasJugadorPartido) : 0;
            $mediaAsistencias = count($estadisticasJugadorPartido) > 0 ? $totalAsistencias / count($estadisticasJugadorPartido) : 0;

            // Actualizar la entrada en EstadisticasJugador
            $estadisticaJugador = EstadisticasJugador::find()->where(['id_jugador' => $jugador->id])->one();

            if ($estadisticaJugador !== null) {
                $estadisticaJugador->puntos = $mediaPuntos;
                $estadisticaJugador->rebotes = $mediaRebotes;
                $estadisticaJugador->asistencias = $mediaAsistencias;
                $estadisticaJugador->partidos_jugados = $partidosJugados; // Actualizar partidos jugados
                $estadisticaJugador->save();
            }
        }
        return $this->redirect(['index']);
    }
}
