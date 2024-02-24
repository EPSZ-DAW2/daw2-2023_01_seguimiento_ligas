<?php

namespace app\controllers;

use Yii;
use app\models\Patrocinadores;
use yii\web\Controller;
use app\models\Imagenes;
use yii\web\UploadedFile;

class PatrocinadoresController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $this->view->title = 'ArosInsider - Pratrocinadores';

        $query = Patrocinadores::find();

        $patrocinadores = $query->all();

        return $this->render('index', [
            'patrocinadores' => $patrocinadores,
        ]);
    }

    public function actionVista($id)
    {
        $model = $this->findModel($id);

        // Verificar si el equipo existe
        if ($model === null) {
            throw new NotFoundHttpException('El partido no fue encontrado.');
        }

        return $this->render('vista', [
            'model' => $model,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Patrocinadores::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('El partido solicitado no existe.');
        }
    }

    public function actionCreate()
    {
        if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2 && Yii::$app->user->identity->id_rol != 5))
        {
            // Usuario no autenticado o no tiene el rol adecuado
            Yii::$app->session->setFlash('error', 'No tienes permisos para realizar esta acción.');
            return $this->redirect(['index']);
        }

        $model = new Patrocinadores();
        $imagenModel = new Imagenes();

        if (Yii::$app->request->isPost) {

            $model->load(Yii::$app->request->post());
            $imagenModel->imagenFile = UploadedFile::getInstance($imagenModel, 'imagenFile');
  
            if (empty($imagenModel->imagenFile)) {
                $imagenModel->addError('imagenFile', 'La imagen es un campo obligatorio.');
            // Validar y guardar la imagen
            } elseif($imagenModel->validate() && $imagenModel->saveImagen()) {
                // Asigna el ID de la imagen al modelo de Equipos después de guardarla
                $model->id_imagen = $imagenModel->id;

                // Guarda el modelo de Equipos
                if ($model->save()) {
                    return $this->redirect(['patrocinadores/index']);
                } else {
                    print_r($model->errors);
                    // Muestra los errores de validación del modelo Equipos
                    //Yii::$app->session->setFlash('error', 'Error al guardar el equipo.');
                    
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

    // Acción para copiar un equipo
    public function actionCopy($id)
    {
        if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2 && Yii::$app->user->identity->id_rol != 5))
        {
            // Usuario no autenticado o no tiene el rol adecuado
            Yii::$app->session->setFlash('error', 'No tienes permisos para realizar esta acción.');
            return $this->redirect(['index']);
        }
        
        $patroncinadorExistente = Patrocinadores::findOne($id);
 
        if ($patroncinadorExistente === null) {
            throw new NotFoundHttpException('El equipo no fue encontrado.');
        }
 
        // Crear una copia del equipo
        $nuevoPatrocinador = new Patrocinadores();

        $nuevoPatrocinador->nombre = $patroncinadorExistente->nombre . ' (copia)';

        // Asignar un nuevo identificador único al nuevo equipo
        $nuevoPatrocinador->id = null;

        // Se copia el resto de campos menos el nombre
        foreach ($patroncinadorExistente->attributes as $attribute => $value) {
            if ($attribute !== 'id' && $attribute !== 'nombre') {
                $nuevoPatrocinador->$attribute = $value;
            }
        }

        $nuevoPatrocinador->save();

        // Redirigir a la página de equipos
        return $this->redirect(['index', 'id' => $nuevoPatrocinador->id]);
    }

    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2 && Yii::$app->user->identity->id_rol != 5))
        {
            // Usuario no autenticado o no tiene el rol adecuado
            Yii::$app->session->setFlash('error', 'No tienes permisos para realizar esta acción.');
            return $this->redirect(['index']);
        }

        // Buscar el patrocinador por su ID
        $patrocinador = Patrocinadores::findOne($id);

        // Verificar si el patrocinador existe
        if ($patrocinador === null) {
            throw new NotFoundHttpException('El patrocinador no fue encontrado.');
        }

        // Procesar el formulario cuando se envía
        if (Yii::$app->request->isPost) {
            // Cargar los datos del formulario en el modelo de equipo
            if ($patrocinador->load(Yii::$app->request->post()) && $patrocinador->save()) {
                // Redirigir a la vista de detalles después de la actualización exitosa
                return $this->redirect(['vista', 'id' => $patrocinador->id]);
            }
        }

        // Renderizar la vista de actualización con el formulario y el modelo de patrocinador
        return $this->render('update', [
            'patrocinador' => $patrocinador,
        ]);
    }

    // Acción para borrar un equipo
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2 && Yii::$app->user->identity->id_rol != 5))
        {
            // Usuario no autenticado o no tiene el rol adecuado
            Yii::$app->session->setFlash('error', 'No tienes permisos para realizar esta acción.');
            return $this->redirect(['index']);
        }

        $patrocinador = Patrocinadores::findOne($id);

        if ($patrocinador === null) {
            throw new NotFoundHttpException('El equipo no fue encontrado.');
        }
        
        $patrocinador->delete();

        return $this->redirect(['index']);
    }
};
?>