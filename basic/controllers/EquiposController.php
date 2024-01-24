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

            if ($imagenModel->saveImagen()) {
                // Guarda la imagen en la tabla imagenes
                $imagenModel->save(false);

                // Asigna el ID de la imagen al modelo de Equipos
                $model->id_escudo = $imagenModel->id;
                
                // Guarda el modelo de Equipos
                if ($model->save()) {
                    // Redirige o realiza otras acciones después de guardar
                }
            }
        }

        // Renderiza la vista del formulario
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
