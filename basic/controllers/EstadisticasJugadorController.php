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
    
        $ligas = Ligas::find()->all();
    
        $ligaId = Yii::$app->request->get('ligaId');
        if (!empty($ligaId)) {
            $dataProvider->query->leftJoin('equipos as e', 'estadisticas_jugador.id_equipo = e.id')
                ->andWhere(['e.id_liga' => $ligaId]);
        }
    
        $showAll = Yii::$app->request->get('showAll', false);
        if (!$showAll) {
            $dataProvider->query->andWhere(['estadisticas_jugador.activo' => 1])
                                 ->andWhere(['>=', 'estadisticas_jugador.partidos_jugados', 1]);
        }
    
        $fromPlayerView = Yii::$app->request->get('fromPlayerView');
        if ($fromPlayerView) {
            $id_jugador = Yii::$app->request->get('id_jugador');
            $dataProvider->query->andWhere(['id_jugador' => $id_jugador]);
        }

        $dataProvider->pagination->pageSize = 10;
    
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'ligas' => $ligas,
        ]);
    }        
       
    public function actionCreate()
    {
        $model = new EstadisticasJugador();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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

        $jugadores = Jugadores::find()->all();

        foreach ($jugadores as $jugador) {
            $estadisticasJugadorPartido = EstadisticasJugadorPartido::find()
                ->where(['id_jugador' => $jugador->id])
                ->andWhere(['>=', 'minutos', 0])
                ->all();

            $temporadas = array_unique(array_map(function ($estadistica) {
                return $estadistica->partido->jornada->temporada->id;
            }, $estadisticasJugadorPartido));

            foreach ($temporadas as $temporadaId) {
                $totalPuntos = 0;
                $totalRebotes = 0;
                $totalAsistencias = 0;
                $partidosJugados = 0;

                $estadisticasTemporada = array_filter($estadisticasJugadorPartido, function ($estadistica) use ($temporadaId) {
                    return $estadistica->partido->jornada->temporada->id == $temporadaId;
                });

                foreach ($estadisticasTemporada as $estadistica) {
                    if ($estadistica->minutos > 0) {
                        $partidosJugados++;
                        $totalPuntos += $estadistica->puntos;
                        $totalRebotes += $estadistica->rebotes;
                        $totalAsistencias += $estadistica->asistencias;
                    }
                }

                $mediaPuntos = count($estadisticasTemporada) > 0 ? $totalPuntos / $partidosJugados : 0;
                $mediaRebotes = count($estadisticasTemporada) > 0 ? $totalRebotes / $partidosJugados : 0;
                $mediaAsistencias = count($estadisticasTemporada) > 0 ? $totalAsistencias / $partidosJugados : 0;

                $estadisticaJugador = EstadisticasJugador::find()
                    ->where(['id_jugador' => $jugador->id, 'id_temporada' => $temporadaId])
                    ->one();

                if ($estadisticaJugador === null) {
                    $estadisticaJugador = new EstadisticasJugador();
                    $estadisticaJugador->id_jugador = $jugador->id;
                    $estadisticaJugador->id_temporada = $temporadaId;
                }

                $estadisticaJugador->puntos = $mediaPuntos;
                $estadisticaJugador->rebotes = $mediaRebotes;
                $estadisticaJugador->asistencias = $mediaAsistencias;
                $estadisticaJugador->partidos_jugados = $partidosJugados;
                $estadisticaJugador->save();
            }
        }

        $medias = [
            'puntos' => $mediaPuntos,
            'rebotes' => $mediaRebotes,
            'asistencias' => $mediaAsistencias,
            'id_estadisticas' => $estadisticaJugador->id,
        ];
        var_dump($medias);

        return $this->redirect(['estadisticas-jugador/index']);
    }

    public function actionCrearEstadisticas($idTemporada, $idEquipo)
    {
        $jugadoresEquipo = Jugadores::find()->where(['id_equipo' => $idEquipo])->all();

        foreach ($jugadoresEquipo as $jugador) {
            $existingStats = EstadisticasJugador::find()
                ->where(['id_temporada' => $idTemporada, 'id_jugador' => $jugador->id])
                ->exists();

            if (!$existingStats) {
                $estadisticas = new EstadisticasJugador();
                $estadisticas->id_temporada = $idTemporada;
                $estadisticas->id_equipo = $idEquipo;
                $estadisticas->id_jugador = $jugador->id;
                $estadisticas->partidos_jugados = 0;
                $estadisticas->puntos = 0;
                $estadisticas->rebotes = 0;
                $estadisticas->asistencias = 0;

                if (!$estadisticas->save()) {
                    Yii::error('Error al guardar las estadísticas para el jugador: ' . $jugador->nombre);
                }
            }
        }

        return $this->redirect(['equipos/ver-por-temporada', 'id' => $idTemporada]);
    }
}
