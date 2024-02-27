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
    
        // Mostrar todos los registros si se activa el parámetro showAll
        $showAll = Yii::$app->request->get('showAll', false);
        if (!$showAll) {
            $dataProvider->query->andWhere(['>', 'partidos_jugados', 0]);
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

        // Obtener temporadas únicas de los registros del jugador actual
        $temporadas = array_unique(array_map(function ($estadistica) {
            return $estadistica->partido->jornada->temporada->id;
        }, $estadisticasJugadorPartido));

        // Iterar sobre cada temporada
        foreach ($temporadas as $temporadaId) {
            // Reiniciar variables para calcular medias y partidos jugados
            $totalPuntos = 0;
            $totalRebotes = 0;
            $totalAsistencias = 0;
            $partidosJugados = 0;

            // Filtrar registros por temporada actual
            $estadisticasTemporada = array_filter($estadisticasJugadorPartido, function ($estadistica) use ($temporadaId) {
                return $estadistica->partido->jornada->temporada->id == $temporadaId;
            });

            // Calcular las medias y partidos jugados para la temporada actual
            foreach ($estadisticasTemporada as $estadistica) {
                $totalPuntos += $estadistica->puntos;
                $totalRebotes += $estadistica->rebotes;
                $totalAsistencias += $estadistica->asistencias;

                // Incrementar contador si minutos > 0
                if ($estadistica->minutos > 0) {
                    $partidosJugados++;
                }
            }

            // Calcular las medias para la temporada actual
            $mediaPuntos = count($estadisticasTemporada) > 0 ? $totalPuntos / count($estadisticasTemporada) : 0;
            $mediaRebotes = count($estadisticasTemporada) > 0 ? $totalRebotes / count($estadisticasTemporada) : 0;
            $mediaAsistencias = count($estadisticasTemporada) > 0 ? $totalAsistencias / count($estadisticasTemporada) : 0;

            // Actualizar la entrada en EstadisticasJugador para la temporada actual
            $estadisticaJugador = EstadisticasJugador::find()
                ->where(['id_jugador' => $jugador->id, 'id_temporada' => $temporadaId])
                ->one();

            if ($estadisticaJugador === null) {
                $estadisticaJugador = new EstadisticasJugador();
                $estadisticaJugador->id_jugador = $jugador->id;
                $estadisticaJugador->id_temporada = $temporadaId;
            }

            // Asignar nuevas medias y partidos jugados
            $estadisticaJugador->puntos = $mediaPuntos;
            $estadisticaJugador->rebotes = $mediaRebotes;
            $estadisticaJugador->asistencias = $mediaAsistencias;
            $estadisticaJugador->partidos_jugados = $partidosJugados;
            $estadisticaJugador->save();
        }
    }

    // Mostrar los valores de las medias
    $medias = [
        'puntos' => $mediaPuntos,
        'rebotes' => $mediaRebotes,
        'asistencias' => $mediaAsistencias,
        'id_estadisticas' => $estadisticaJugador->id,
    ];
    var_dump($medias);

    // Redirigir a la página de estadísticas del jugador
    return $this->redirect(['estadisticas-jugador/index']);
}


    public function actionCrearEstadisticas($idTemporada, $idEquipo)
    {
        // Obtener la lista de jugadores del equipo para la temporada actual
        $jugadoresEquipo = Jugadores::find()->where(['id_equipo' => $idEquipo])->all();

        // Iterar sobre cada jugador del equipo
        foreach ($jugadoresEquipo as $jugador) {
            // Verificar si ya existe una entrada para este jugador y esta temporada
            $existingStats = EstadisticasJugador::find()
                ->where(['id_temporada' => $idTemporada, 'id_jugador' => $jugador->id])
                ->exists();

            // Si no existe una entrada para este jugador y esta temporada, crear una nueva
            if (!$existingStats) {
                $estadisticas = new EstadisticasJugador();
                $estadisticas->id_temporada = $idTemporada;
                $estadisticas->id_equipo = $idEquipo;
                $estadisticas->id_jugador = $jugador->id;
                $estadisticas->partidos_jugados = 0;
                $estadisticas->puntos = 0;
                $estadisticas->rebotes = 0;
                $estadisticas->asistencias = 0;

                // Guardar las estadísticas
                if (!$estadisticas->save()) {
                    Yii::error('Error al guardar las estadísticas para el jugador: ' . $jugador->nombre);
                    // Manejar el error según sea necesario
                }
            }
        }

        // Redirigir a la vista de la temporada
        return $this->redirect(['equipos/ver-por-temporada', 'id' => $idTemporada]);
    }

}
