<?php

namespace app\controllers;

use Yii;
use app\models\Jugadores;
use app\models\EstadisticasJugador;
use app\models\Imagenes;
use app\models\Temporadas;
use yii\web\Controller;
use yii\web\UploadedFile;


class JugadoresController extends Controller
{
    public function actionIndex()
    {
        // Obtén todos los equipos desde la base de datos
        $jugadores = Jugadores::find()->with('equipo')->all();

        // Renderiza la vista y pasa los equipos como parámetro
        return $this->render('index', [
            'jugadores' => $jugadores,
        ]);
    }

    public function actionCreate()
    {
        $model = new Jugadores();
        $imagenModel = new Imagenes(); // Crea una instancia de ImagenModel

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $imagenModel->imagenFile = UploadedFile::getInstance($imagenModel, 'imagenFile');

            // Validar y guardar la imagen
            if ($imagenModel->validate() && $imagenModel->saveImagen()) {
                // Asigna el ID de la imagen al modelo de Jugadores después de guardarla
                $model->id_imagen = $imagenModel->id;

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    // Resto de tu lógica de creación...
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

        if ($model === null) {
            throw new NotFoundHttpException('El jugador solicitado no existe.');
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