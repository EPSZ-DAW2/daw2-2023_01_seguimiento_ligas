<?php

namespace app\controllers;

use Yii;
use app\models\EstadisticasJugadorPartido;
use app\models\Equipos;
use app\models\EstadisticasJugadorPartidoSearch;
use app\models\PartidosJornada;
use app\models\Jugadores;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

class EstadisticasJugadorPartidoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all EstadisticasJugadorPartido models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EstadisticasJugadorPartidoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EstadisticasJugadorPartido model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = PartidosJornada::findOne($id);
    
        if ($model === null) {
            throw new NotFoundHttpException('El partido no fue encontrado.');
        }
    
        $dataProviderLocal = new ActiveDataProvider([
            'query' => EstadisticasJugadorPartido::find()->where(['id_partido' => $id, 'id_equipo' => $model->equipoLocal->id]),
        ]);
    
        $dataProviderVisitante = new ActiveDataProvider([
            'query' => EstadisticasJugadorPartido::find()->where(['id_partido' => $id, 'id_equipo' => $model->equipoVisitante->id]),
        ]);
    
        return $this->render('view', [
            'model' => $model,
            'dataProviderLocal' => $dataProviderLocal,
            'dataProviderVisitante' => $dataProviderVisitante,
        ]);
    }    

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if ($model === null) {
            throw new NotFoundHttpException('Las estadísticas del jugador solicitadas no existen.');
        }
        
        $idPartido = $model->id_partido;
        
        $idJugador = $model->id_jugador;
        $idEquipo = $model->id_equipo;
    
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['partidos/view', 'id' => $idPartido]);
        }
    
        return $this->render('update', [
            'model' => $model,
            'idPartido' => $idPartido,
            'idJugador' => $idJugador,
            'idEquipo' => $idEquipo,
        ]);
    }
                  
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $idPartido = $model->id_partido;
    
        if ($model === null) {
            throw new NotFoundHttpException('El registro de estadísticas del jugador no existe.');
        }
    
        $model->delete();
    
        return $this->redirect(['partidos/view', 'id' => $idPartido]); // Redirigir a la vista de detalles del partido después de eliminar
    }

    public function actionForm($idPartido, $idEquipo)
    {
        $model = new EstadisticasJugadorPartido();

        $jugadores = Jugadores::find()
            ->where(['id_equipo' => $idEquipo, 'activo' => 1])
            ->select(['id', 'nombre'])
            ->asArray()
            ->all();

        if ($model->load(Yii::$app->request->post())) {
            $existingRecord = EstadisticasJugadorPartido::findOne([
                'id_partido' => $idPartido,
                'id_jugador' => $model->id_jugador,
            ]);

            if ($existingRecord !== null) {
                Yii::$app->session->setFlash('error', 'Ya existe una estadística para este jugador en este partido.');
                return $this->refresh();
            }

            if ($model->save()) {
                return $this->redirect(['partidos/view', 'id' => $idPartido]);
            }
        }

        return $this->render('form', [
            'model' => $model,
            'idPartido' => $idPartido,
            'idEquipo' => $idEquipo,
            'jugadores' => ArrayHelper::map($jugadores, 'id', 'nombre'),
        ]);
    }
         
    /**
     * Finds the EstadisticasJugadorPartido model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EstadisticasJugadorPartido the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EstadisticasJugadorPartido::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
