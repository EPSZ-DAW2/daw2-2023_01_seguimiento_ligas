<?php

namespace app\controllers;

use Yii;
use app\models\EstadisticasJugadorPartido;
use app\models\EstadisticasJugadorPartidoSearch;
use app\models\PartidosJornada;
use app\models\Jugadores;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        // Buscar el partido por su ID
        $model = PartidosJornada::findOne($id);
    
        // Verificar si el partido existe
        if ($model === null) {
            throw new NotFoundHttpException('El partido no fue encontrado.');
        }
    
        // Obtener las estadísticas de los jugadores del equipo local y visitante desde la tabla estadisticasJugadorPartido
        $dataProviderLocal = new ActiveDataProvider([
            'query' => EstadisticasJugadorPartido::find()->where(['id_partido' => $id, 'id_equipo' => $model->equipoLocal->id]),
        ]);
    
        $dataProviderVisitante = new ActiveDataProvider([
            'query' => EstadisticasJugadorPartido::find()->where(['id_partido' => $id, 'id_equipo' => $model->equipoVisitante->id]),
        ]);
    
        // Renderizar la vista de detalles del partido
        return $this->render('view', [
            'model' => $model,
            'dataProviderLocal' => $dataProviderLocal,
            'dataProviderVisitante' => $dataProviderVisitante,
        ]);
    }    

    public function actionForm($idPartido, $idEquipo)
    {
        $model = new EstadisticasJugadorPartido();
    
        // Obtener los jugadores del equipo correspondiente
        $jugadores = Jugadores::find()
            ->where(['id_equipo' => $idEquipo])
            ->select(['id', 'nombre'])
            ->asArray()
            ->all();
    
        // Verificar si se envía el formulario y se guarda el modelo
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['partidos/view', 'id' => $idPartido]); // Redirigir a la vista de partidos
        } else {
            return $this->render('form', [
                'model' => $model,
                'idPartido' => $idPartido,
                'idEquipo' => $idEquipo, // Pasar el idEquipo al formulario
                'jugadores' => ArrayHelper::map($jugadores, 'id', 'nombre'),
            ]);
        }
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
