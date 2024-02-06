<?php

namespace app\controllers;

use Yii;
use app\models\Ligas;
use app\models\Imagenes;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;



class LigasController extends Controller
{
    public function actionIndex()
    {
        $this->view->title = 'ArosInsider - Ligas';
    
        // Crear una instancia del modelo de búsqueda
        $searchModel = new Ligas(); // Reemplaza con el nombre real de tu modelo de búsqueda
        $ligas = Ligas::find()->all();
        $dataProvider = new ActiveDataProvider([
            'query' => Ligas::find(),
        ]);
    
        // Obtén todos los equipos desde la base de datos
        $ligas = Ligas::find()->all();
    
        // Renderiza la vista y pasa los equipos como parámetro
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'ligas' => $ligas,
        ]);
    }
    

    public function actionCreate()
    {
        $model = new Ligas();
        $imagenModel = new Imagenes();
    
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $imagenModel->imagenFile = UploadedFile::getInstance($imagenModel, 'imagenFile');
    
            // Validar y guardar la imagen solo si se proporciona un archivo
            if (empty($imagenModel->imagenFile)) {
                $imagenModel->addError('imagenFile', 'La imagen es un campo obligatorio.');
            } elseif ($imagenModel->validate() && $imagenModel->saveImagen()) {
                // Asignar el ID de la imagen al modelo de ligas después de guardarla
                $model->id_imagen = $imagenModel->id;
    
                // Guarda el modelo de ligas
                if ($model->save()) {
                    return $this->redirect(['ligas/index']);
                } else {
                    print_r($model->errors);
                    // Muestra los errores de validación del modelo ligas
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
    
    
// Action Update de LigasController
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


public function actionDelete($id)
{
    $model = $this->findModel($id);

    // Verifica si se ha enviado una solicitud POST (para evitar eliminaciones accidentales)
    if (Yii::$app->request->isPost) {
        // Elimina la imagen asociada
        $imagenModel = $model->getImagen()->one();

        $model->delete();
        if ($imagenModel) {
            $imagenModel->delete();
            //eliminar la imagen de la carpeta la ruta es web/images
            
        }

        // Elimina el modelo de la liga
       

        // Redirige a la página 'index'
        return $this->redirect(['index']);
    }

    // Si no es una solicitud POST, muestra la confirmación de eliminación
    return $this->render('delete', [
        'model' => $model,
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
}