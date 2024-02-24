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
    
       
        $searchModel = new Ligas(); 
        $ligas = Ligas::find()->all();
        $dataProvider = new ActiveDataProvider([
            'query' => Ligas::find(),
        ]);
    
       
        $ligas = Ligas::find()->all();
    
        
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

            // Validar y guardar la imagen
            if ($imagenModel->validate() && $imagenModel->saveImagen()) {
                
                $model->id_imagen = $imagenModel->id;

               
                if ($model->save()) {
                    return $this->redirect(['ligas/index']);
                } else {
                    print_r($model->errors);
                    
                    //Yii::$app->session->setFlash('error', 'Error al guardar el equipo.');
                    
                    return $this->render('create', [
                        'model' => $model,
                        'imagenModel' => $imagenModel,
                    ]);
                }
            } else {
                
                //Yii::$app->session->setFlash('error', 'Error al cargar la imagen.');
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

public function actionDelete($id)
{
    $model = $this->findModel($id);

    
    if (Yii::$app->request->isPost) {
       
        $imagenModel = $model->getImagen()->one();

        $model->delete();
        if ($imagenModel) {
            $imagenModel->delete();
            
            
        }

        
       

     
        return $this->redirect(['index']);
    }

    
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