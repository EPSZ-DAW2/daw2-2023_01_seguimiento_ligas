<?php

namespace app\controllers;

use Yii;
use app\models\Imagenes;
use yii\web\UploadedFile;
use yii\web\Controller;

class ImagenesController extends Controller
{
    public function actionCreate()
    {
        $model = new Imagenes();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->imagenFile = UploadedFile::getInstance($model, 'imagenFile');
            
            if ($model->imagenFile) {
                if ($model->validate()) {
                    
                    if ($model->saveImagen()) {
                       
                        return $this->redirect(['index']);
                    } else {
                       
                        Yii::$app->session->setFlash('error', 'Error al guardar la imagen.');
                    }
                }
            }
        }

    
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Imagenes::findOne($id);

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->imagenFile = UploadedFile::getInstance($model, 'imagenFile');
            
            if ($model->imagenFile) {
                if ($model->validate()) {
                 
                    if ($model->saveImagen()) {
                     
                        return $this->redirect(['index']);
                    } else {
                     
                        Yii::$app->session->setFlash('error', 'Error al guardar la imagen.');
                    }
                }
            }
        }

      
        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionDelete($id)
    {
        $model = Imagenes::findOne($id);
        if ($model->deleteImagen()) {
      
            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'Error al eliminar la imagen.');
        }
    }

   
    public function actionView($id)
    {
        $model = Imagenes::findOne($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionIndex()
    {
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => Imagenes::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
?>
