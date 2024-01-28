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
                    // Guarda la imagen en la tabla imagenes
                    if ($model->saveImagen()) {

                        // Redirige a la vista de imágenes o a donde desees
                        return $this->redirect(['index']);

                    } else {
                        // Manejo de errores, por ejemplo, mostrar un mensaje de error
                        Yii::$app->session->setFlash('error', 'Error al guardar la imagen.');
                    }
                }
            }
        }

        // Renderiza la vista del formulario
        return $this->render('create', [
            'model' => $model,
        ]);
    }

}
?>