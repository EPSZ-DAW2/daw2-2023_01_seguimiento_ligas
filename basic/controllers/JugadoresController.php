<?php

namespace app\controllers;

use Yii;
use app\models\Jugadores;
use app\models\EstadisticasJugador;
use app\models\Imagenes;
use app\models\Temporadas;
use app\models\Ligas;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;

class JugadoresController extends Controller
{
    public function actionIndex()
    {
        // Obtiene el ID de la liga seleccionada
        $ligaId = Yii::$app->request->get('ligaId');
        
        // Consulta base de jugadores
        $query = Jugadores::find()->with('equipo');
        
        // Si se ha seleccionado una liga válida, filtra los jugadores por esa liga
        if (!empty($ligaId) && $ligaId != -1) {
            $query->leftJoin('equipos', 'jugadores.id_equipo = equipos.id')
                ->andWhere(['equipos.id_liga' => $ligaId]);
        }
        
        // Configura el proveedor de datos con la consulta de jugadores
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 12, // Define el número de jugadores por página
            ],
        ]);
        
        // Obtiene la lista de ligas para el desplegable
        $ligas = Ligas::find()->all();
        
        // Renderiza la vista y pasa el proveedor de datos y la lista de ligas como parámetros
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'ligas' => $ligas,
            'ligaId' => $ligaId, // Pasa el ID de la liga seleccionada a la vista
        ]);
    }
     
    
    public function actionCreate()
    {
        $model = new Jugadores();
        $imagenModel = new Imagenes();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $imagenModel->imagenFile = UploadedFile::getInstance($imagenModel, 'imagenFile');

            // Validar y guardar la imagen
            if ($imagenModel->validate() && $imagenModel->saveImagen()) {
                // Asigna el ID de la imagen al modelo de Equipos después de guardarla
                $model->id_imagen = $imagenModel->id;

                // Guarda el modelo de Equipos
                if ($model->save()) {

                    $estadisticasJugador = new EstadisticasJugador();

                    // Asigna los valores predeterminados
                    $estadisticasJugador->id_temporada = Temporadas::find()->orderBy(['id' => SORT_DESC])->one()->id;
                    $estadisticasJugador->id_equipo = $model->id_equipo;
                    $estadisticasJugador->id_jugador = $model->id;
                    $estadisticasJugador->partidos_jugados = 0;
                    $estadisticasJugador->puntos = 0;
                    $estadisticasJugador->rebotes = 0;
                    $estadisticasJugador->asistencias = 0;

                    // Guarda la nueva entrada en estadisticas_jugador
                    $estadisticasJugador->save();
                    return $this->redirect(['jugadores/index']);
                } else {
                    print_r($model->errors);
                    // Muestra los errores de validación del modelo Equipos
                    Yii::$app->session->setFlash('error', 'Error al guardar el jugador.');
                    
                    return $this->render('create', [
                        'model' => $model,
                        'imagenModel' => $imagenModel,
                    ]);
                }
            } else {
                // Muestra los errores de validación de la imagen
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
    
            // Validar y guardar la imagen
            if ($imagenModel->validate() && $imagenModel->saveImagen()) {
                // Asigna el ID de la imagen al modelo de Ligas después de guardarla
                $model->id_imagen = $imagenModel->id;
    
                // Guarda el modelo de Ligas
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Error al guardar la liga.');
                }
            } else {
                // Muestra los errores de validación de la imagen
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
    
        $model->load('estadisticasJugador');
        return $this->render('view', [
            'model' => $model,
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
}