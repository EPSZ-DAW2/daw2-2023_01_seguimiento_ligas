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

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if ($model === null) {
            throw new NotFoundHttpException('Las estadísticas del jugador solicitadas no existen.');
        }
        
        $idPartido = $model->id_partido; // Obtener el ID del partido asociado al modelo
        
        // Obtener el ID del jugador y del equipo asociados a la estadística de jugador actual
        $idJugador = $model->id_jugador;
        $idEquipo = $model->id_equipo;
    
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // Redirigir a la vista del partido correspondiente
            return $this->redirect(['partidos/view', 'id' => $idPartido]);
        }
    
        return $this->render('update', [
            'model' => $model,
            'idPartido' => $idPartido, // Pasar el ID del partido a la vista
            'idJugador' => $idJugador, // Pasar el ID del jugador a la vista
            'idEquipo' => $idEquipo, // Pasar el ID del equipo a la vista
        ]);
    }
                  
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $idPartido = $model->id_partido; // Obtener el ID del partido antes de eliminar el registro
    
        if ($model === null) {
            throw new NotFoundHttpException('El registro de estadísticas del jugador no existe.');
        }
    
        $model->delete();
    
        return $this->redirect(['partidos/view', 'id' => $idPartido]); // Redirigir a la vista de detalles del partido después de eliminar
    }

    public function actionForm($idPartido, $idEquipo)
    {
        $model = new EstadisticasJugadorPartido();

        // Obtener los jugadores del equipo correspondiente con activo = 1
        $jugadores = Jugadores::find()
            ->where(['id_equipo' => $idEquipo, 'activo' => 1]) // Filtrar por activo = 1
            ->select(['id', 'nombre'])
            ->asArray()
            ->all();

        // Verificar si se envía el formulario y se guarda el modelo
        if ($model->load(Yii::$app->request->post())) {
            // Verificar si ya existe un registro para el jugador en este partido
            $existingRecord = EstadisticasJugadorPartido::findOne([
                'id_partido' => $idPartido,
                'id_jugador' => $model->id_jugador,
            ]);

            if ($existingRecord !== null) {
                // Si ya existe un registro, puedes mostrar un mensaje de error o manejarlo según tus necesidades
                Yii::$app->session->setFlash('error', 'Ya existe una estadística para este jugador en este partido.');
                return $this->refresh(); // Recargar la página actual
            }

            // Si no hay un registro existente, intenta guardar el nuevo registro
            if ($model->save()) {
                return $this->redirect(['partidos/view', 'id' => $idPartido]); // Redirigir a la vista de partidos
            }
        }

        // Renderizar el formulario con los datos necesarios
        return $this->render('form', [
            'model' => $model,
            'idPartido' => $idPartido,
            'idEquipo' => $idEquipo, // Pasar el idEquipo al formulario
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
