<?php

namespace app\controllers;

use Yii;
use app\models\Jugadores;
use app\models\JugadoresSearch;
use app\models\EstadisticasJugador;
use app\models\Imagenes;
use app\models\Equipos;
use app\models\Temporadas;
use app\models\Ligas;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;

class JugadoresController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new JugadoresSearch();
        $ligaId = Yii::$app->request->get('ligaId');
        
        // Aplicar condiciones de búsqueda si se envían parámetros
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        // Agregar condiciones adicionales si se especifica la liga
        if (!empty($ligaId) && $ligaId != -1) {
            $query = $dataProvider->query;
            $query->leftJoin('equipos', 'jugadores.id_equipo = equipos.id')
                ->andWhere(['equipos.id_liga' => $ligaId]);
            $dataProvider->query = $query;
        }
    
        $ligas = Ligas::find()->all();
    
        // Renderiza la vista y pasa los datos necesarios
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'ligas' => $ligas,
            'ligaId' => $ligaId,
            'searchModel' => $searchModel,
        ]);
    }    
    
    public function actionCreate()
    {
        $model = new Jugadores();
        $imagenModel = new Imagenes();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $imagenModel->imagenFile = UploadedFile::getInstance($imagenModel, 'imagenFile');

            if (empty($imagenModel->imagenFile)) {
                $imagenModel->addError('imagenFile', 'La imagen es un campo obligatorio.');
            } elseif ($imagenModel->validate() && $imagenModel->saveImagen()) {
                $model->id_imagen = $imagenModel->id;

                if ($model->save()) {

                    $estadisticasJugador = new EstadisticasJugador();

                    $estadisticasJugador->id_temporada = Temporadas::find()->orderBy(['id' => SORT_DESC])->one()->id;
                    $estadisticasJugador->id_equipo = $model->id_equipo;
                    $estadisticasJugador->id_jugador = $model->id;
                    $estadisticasJugador->partidos_jugados = 0;
                    $estadisticasJugador->puntos = 0;
                    $estadisticasJugador->rebotes = 0;
                    $estadisticasJugador->asistencias = 0;

                    $estadisticasJugador->save();
                    return $this->redirect(['jugadores/index']);
                } else {
                    print_r($model->errors);
                    //Yii::$app->session->setFlash('error', 'Error al guardar el jugador.');
                    
                    return $this->render('create', [
                        'model' => $model,
                        'imagenModel' => $imagenModel,
                    ]);
                }
            } else {
                Yii::$app->session->setFlash('error', 'Error al cargar la imagen.');
            }
        }

        return $this->render('create', [
            'model' => $model,
            'imagenModel' => $imagenModel,
        ]);
    }
    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $imagenModel = ($model->imagen) ? $model->imagen : new Imagenes();
    
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $imagenModel->imagenFile = UploadedFile::getInstance($imagenModel, 'imagenFile');
    
            if ($imagenModel->validate() && $imagenModel->saveImagen()) {
                $model->id_imagen = $imagenModel->id;
    
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Error al guardar la liga.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Error al cargar la imagen.');
            }
        }
    
        return $this->render('update', [
            'model' => $model,
            'imagenModel' => $imagenModel,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        $imagenModel = ($model->imagen) ? $model->imagen : new Imagenes();
    
        $model->load('estadisticasJugador');
        return $this->render('view', [
            'model' => $model,
            'imagenModel' => $imagenModel,
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

    public function actionVerPorEquipo($id)
    {
        $this->view->title = 'ArosInsider - Jugadores del Equipo';
        
        $equipo = Equipos::findOne($id);
        $jugadores = Jugadores::find()->where(['id_equipo' => $id])->all();
    
        return $this->render('ver-por-equipo', [
            'jugadores' => $jugadores,
            'equipo' => $equipo,
        ]);
    } 

}