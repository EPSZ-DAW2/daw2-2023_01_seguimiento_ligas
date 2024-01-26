<?php

namespace app\controllers;

use Yii;
use app\models\Ligas;
use app\models\LigasSearch;
use app\models\Imagenes;
use yii\web\Controller;
use yii\web\UploadedFile;




class LigasController extends Controller
{
    public function actionIndex()
    {
        $this->view->title = 'ArosInsider - Ligas';

        // Obtén todos los equipos desde la base de datos
        $ligas = Ligas::find()->all();

        // Renderiza la vista y pasa los equipos como parámetro
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    

    public function actionCreate()
    {
        $model = new Ligas();
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
                    return $this->redirect(['ligas/index']);
                } else {
                    print_r($model->errors);
                    // Muestra los errores de validación del modelo Equipos
                    Yii::$app->session->setFlash('error', 'Error al guardar el equipo.');
                    
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
        $imagenModel = new Imagenes(); // Puedes ajustar esto según tu lógica de negocio
    
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // Realizar acciones después de guardar el modelo principal
    
            // Verifica si hay una imagen para cargar
            $imagenModel->imagenFile = UploadedFile::getInstance($imagenModel, 'imagenFile');
            if ($imagenModel->validate() && $imagenModel->saveImagen()) {
                // Asigna el ID de la imagen al modelo de Ligas después de guardarla
                $model->id_imagen = $imagenModel->id;
                $model->save(); // Guarda el modelo de Ligas con la nueva ID de imagen
            }
    
            return $this->redirect(['view', 'id' => $model->id]);
        }
    
        return $this->render('update', [
            'model' => $model,
            'imagenModel' => $imagenModel, // Pasa el modelo de imagen a la vista
        ]);
    }
    

    public function actionView($id)
    {
        $model = $this->findModel($id);
    
        return $this->render('view', [
            'model' => $model,
        ]);
    }
    
    protected function findModel($id)
    {
        if (($model = Ligas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionDelete($id)
{
    $model = $this->findModel($id);
    $imagenModel = Imagenes::findOne($model->id_imagen); // Ajusta según tu relación entre Ligas e Imagenes

    // Elimina el modelo principal
    $model->delete();



    // Redirecciona según el rol del usuario
    if (Yii::$app->user->identity->id_rol == 1) {
        return $this->redirect(['index']);
    } else {
        return $this->redirect(['site/home']);
    }
}
}