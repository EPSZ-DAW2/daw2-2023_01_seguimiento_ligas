<?php

namespace app\controllers;

use yii\web\NotFoundHttpException;
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
use app\models\Usuarios;

class JugadoresController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new JugadoresSearch();
        $ligaId = Yii::$app->request->get('ligaId');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // Filtrar jugadores por equipo si el usuario es un gestor de equipos
        if (!Yii::$app->user->isGuest && Yii::$app->user->identity->id_rol == 6) {
            $usuarioId = Yii::$app->user->identity->id;
            $equipoId = Equipos::find()->select('id')->where(['gestor_eq' => $usuarioId])->scalar();
            
            if ($equipoId !== null) {
                $dataProvider->query->andWhere(['id_equipo' => $equipoId]);
            }
        }
        
        // Agregar condiciones adicionales si se especifica la liga
        if (!empty($ligaId) && $ligaId != -1) {
            $dataProvider->query->joinWith('equipo')->andWhere(['equipos.id_liga' => $ligaId]);
        }

        // Filtrar jugadores activos
        if (Yii::$app->user->isGuest || !in_array(Yii::$app->user->identity->id_rol, [1, 2, 6])) {
            $dataProvider->query->andWhere(['activo' => 1]);
        }

        $dataProvider->pagination->pageSize = 12;
    
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

                // Obtenemos el ID de la temporada más reciente para la liga del jugador
                $temporadaReciente = Temporadas::find()
                    ->joinWith('liga')
                    ->where(['ligas.id' => $model->equipo->id_liga]) // Suponiendo que tienes una relación 'liga' en el modelo Temporadas
                    ->orderBy(['SUBSTRING_INDEX(texto_de_titulo, " ", -1)' => SORT_DESC]) // Ordenar por las dos últimas cifras del texto_de_titulo
                    ->one();

                if ($model->save()) {
                    // Crear una nueva instancia de EstadisticasJugador y guardarla
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
        $jugador = $this->findModel($id);
        
        // Eliminar las estadísticas de jugador asociadas al jugador
        EstadisticasJugador::deleteAll(['id_jugador' => $id]);
        
        // Eliminar las estadísticas de jugador partido asociadas al jugador
        EstadisticasJugadorPartido::deleteAll(['id_jugador' => $id]);
        
        // Eliminar al jugador
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