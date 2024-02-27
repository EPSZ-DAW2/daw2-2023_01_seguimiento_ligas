<?php

namespace app\controllers;

use yii\web\NotFoundHttpException;
use Yii;
use app\models\Jugadores;
use app\models\JugadoresSearch;
use app\models\EstadisticasJugador;
use app\models\EstadisticasJugadorPartido;
use app\models\Imagenes;
use app\models\Equipos;
use app\models\Temporadas;
use app\models\Ligas;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use app\models\Usuarios;

class JugadoresController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new JugadoresSearch();
        $ligaId = Yii::$app->request->get('ligaId');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $equipoId = null;
        $esGestor = false;

        if (!Yii::$app->user->isGuest && Yii::$app->user->identity->id_rol == 6) {
            $usuarioId = Yii::$app->user->identity->id;
            $equipoId = Equipos::find()->select('id')->where(['gestor_eq' => $usuarioId])->scalar();

            if ($equipoId !== false) {
                $esGestor = true;
                $dataProvider->query->andWhere(['id_equipo' => $equipoId]);
            }
            else
            {
                $dataProvider->query->andWhere(['id_equipo' => 0]);
            }
        }

        if (!empty($ligaId) && $ligaId != -1) {
            $dataProvider->query->joinWith('equipo')->andWhere(['equipos.id_liga' => $ligaId]);
        }

        if (Yii::$app->user->isGuest || !in_array(Yii::$app->user->identity->id_rol, [1, 2, 6])) {
            $dataProvider->query->andWhere(['activo' => 1]);
        }

        $dataProvider->pagination->pageSize = 12;

        $ligas = Ligas::find()->all();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'ligas' => $ligas,
            'ligaId' => $ligaId,
            'searchModel' => $searchModel,
            'equipoId' => $equipoId,
            'esGestor' => $esGestor,
        ]);
    }

    public function actionCreate()
    {
        $model = new Jugadores();
        $imagenModel = new Imagenes();
        $esGestor = false;
        $equipoId = null;

        if (!Yii::$app->user->isGuest && Yii::$app->user->identity->id_rol == 6) {
            $usuarioId = Yii::$app->user->identity->id;
            $equipoId = Equipos::find()->select('id')->where(['gestor_eq' => $usuarioId])->scalar();

            if ($equipoId !== null) {
                $esGestor = true;
            }
        }

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $imagenModel->imagenFile = UploadedFile::getInstance($imagenModel, 'imagenFile');

            if (empty($imagenModel->imagenFile)) {
                $imagenModel->addError('imagenFile', 'La imagen es un campo obligatorio.');
            } elseif ($imagenModel->validate() && $imagenModel->saveImagen()) {
                $model->id_imagen = $imagenModel->id;

                $temporadaReciente = Temporadas::find()
                    ->joinWith('liga')
                    ->where(['ligas.id' => $model->equipo->id_liga])
                    ->orderBy(['SUBSTRING_INDEX(texto_de_titulo, " ", -1)' => SORT_DESC])
                    ->one();

                if ($model->save()) {
                    $estadisticasJugador = new EstadisticasJugador();
                    if ($temporadaReciente) {
                        $estadisticasJugador->id_temporada = $temporadaReciente->id;
                    }
                    else
                    {
                        $estadisticasJugador->id_temporada = null;
                    }
                    $estadisticasJugador->id_equipo = $model->id_equipo;
                    $estadisticasJugador->id_jugador = $model->id;
                    $estadisticasJugador->partidos_jugados = 0;
                    $estadisticasJugador->puntos = 0;
                    $estadisticasJugador->rebotes = 0;
                    $estadisticasJugador->asistencias = 0;
                    $estadisticasJugador->save();

                    return $this->redirect(['jugadores/index']);
                } else {
                    Yii::$app->session->setFlash('error', 'Error al guardar el jugador.');
                    return $this->render('create', [
                        'model' => $model,
                        'imagenModel' => $imagenModel,
                    ]);
                }
            }
            else {
                Yii::$app->session->setFlash('error', 'Error al cargar la imagen.');
            }
        }

        return $this->render('create', [
            'model' => $model,
            'imagenModel' => $imagenModel,
            'esGestor' => $esGestor,
            'equipoId' => $equipoId,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $imagenModel = ($model->imagen) ? $model->imagen : new Imagenes();
    
        $esGestorEquipo = !Yii::$app->user->isGuest && Yii::$app->user->identity->id_rol == 6;
        $equipoId = null;
    
        if ($esGestorEquipo) {
            $usuarioId = Yii::$app->user->identity->id;
            $equipoId = Equipos::find()->select('id')->where(['gestor_eq' => $usuarioId])->scalar();
        }
    
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $imagenModel->imagenFile = UploadedFile::getInstance($imagenModel, 'imagenFile');
    
            if ($imagenModel->validate() && $imagenModel->saveImagen()) {
                $model->id_imagen = $imagenModel->id;
                if ($esGestorEquipo) {
                    $model->id_equipo = $equipoId;
                }
    
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
            'esGestorEquipo' => $esGestorEquipo,
            'equipoId' => $equipoId,
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
        $jugador = $this->findModel($id);
        
        EstadisticasJugador::deleteAll(['id_jugador' => $id]);
        
        EstadisticasJugadorPartido::deleteAll(['id_jugador' => $id]);
        
        $jugador->delete();
    
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