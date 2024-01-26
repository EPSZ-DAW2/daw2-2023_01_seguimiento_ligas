<?php

namespace app\controllers;

use Yii;
use app\models\Equipos;
use app\models\Imagenes;
use yii\web\Controller;
use yii\web\UploadedFile;


class EquiposController extends Controller
{
    public function actionIndex()
    {
        $this->view->title = 'ArosInsider - Equipos';

        // Obtén todos los equipos desde la base de datos
        $equipos = Equipos::find()->all();

        // Renderiza la vista y pasa los equipos como parámetro
        return $this->render('index', [
            'equipos' => $equipos,
        ]);
    }

    public function actionCreate()
    {
        $model = new Equipos();
        $imagenModel = new Imagenes();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $imagenModel->imagenFile = UploadedFile::getInstance($imagenModel, 'imagenFile');

            // Validar y guardar la imagen
            if ($imagenModel->validate() && $imagenModel->saveImagen()) {
                // Asigna el ID de la imagen al modelo de Equipos después de guardarla
                $model->id_escudo = $imagenModel->id;

                // Guarda el modelo de Equipos
                if ($model->save()) {
                    return $this->redirect(['equipos/index']);
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


    public function actionUpdate()
    {
        return $this->render('update');
    }

    public function actionView()
    {
        return $this->render('view');
    }
}
