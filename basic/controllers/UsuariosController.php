<?php

namespace app\controllers;

use Yii;
use app\models\Usuarios;
use app\models\UsuariosSearch;
use app\models\Imagenes;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsuariosController implements the CRUD actions for Usuarios model.
 */
class UsuariosController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Usuarios models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UsuariosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usuarios model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionExito()
{
    return $this->render('exito'); 
}

    /**
     * Creates a new Usuarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Usuarios();
        $imagenModel = new Imagenes();
    
        if ($this->request->isPost) {
            $model->load($this->request->post());
            $imagenModel->imagenFile = UploadedFile::getInstance($imagenModel, 'imagenFile');
    
            // Validar y guardar la imagen solo si se proporciona un archivo
            if (empty($imagenModel->imagenFile)) {
                $imagenModel->addError('imagenFile', 'La imagen es un campo obligatorio.');
            } elseif ($imagenModel->validate() && $imagenModel->saveImagen()) {
                // Asignar el ID de la imagen al modelo de Usuarios después de guardarla
                $model->id_imagen = $imagenModel->id;
    
                if (!empty($model->password)) {
                    $model->password = Yii::$app->security->generatePasswordHash($model->password);
                }

                // Validar si el nombre de usuario ya existe
                $existingUser = Usuarios::findOne(['username' => $model->username]);
                if ($existingUser) {
                $model->password = ''; // Dejar el campo de contraseña en blanco
                }

                // Validar si el correo electrónico ya existe
                $existingUser = Usuarios::findOne(['email' => $model->email]);
                if ($existingUser) {
                 $model->password = ''; // Dejar el campo de contraseña en blanco
                }
    
                if ($model->save()) {
                    return $this->redirect(['exito']);
                } else {
                    Yii::$app->session->setFlash('error', 'Error al guardar el usuario.');
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
    
    
    

    /**
     * Updates an existing Usuarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $imagenModel = new Imagenes();
    
        if ($this->request->isPost) {
            $model->load($this->request->post());
            $imagenModel->imagenFile = UploadedFile::getInstance($imagenModel, 'imagenFile');
    
            // Validar y guardar la imagen solo si se proporciona un archivo
            if (empty($imagenModel->imagenFile)) {
                $imagenModel->addError('imagenFile', 'La imagen es un campo obligatorio.');
            } elseif ($imagenModel->validate() && $imagenModel->saveImagen()) {
                // Asignar el ID de la imagen al modelo de Usuarios después de guardarla
                $model->id_imagen = $imagenModel->id;
    
                if (!empty($model->password)) {
                    $model->password = Yii::$app->security->generatePasswordHash($model->password);
                }

                // Validar si el nombre de usuario ya existe, pero no para el mismo usuario
                $existingUser = Usuarios::findOne(['username' => $model->username]);
                if ($existingUser && $existingUser->id != $model->id) {
                    $model->password = ''; // Dejar el campo de contraseña en blanco
                }

                // Validar si el correo electrónico ya existe, pero no para el mismo usuario
                $existingUser = Usuarios::findOne(['email' => $model->email]);
                if ($existingUser && $existingUser->id != $model->id) {
                    $model->password = ''; // Dejar el campo de contraseña en blanco
                }
    
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Error al actualizar el usuario.');
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
    

    /**
     * Deletes an existing Usuarios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

     
        if (Yii::$app->user->identity->id_rol == 1) {
            return $this->redirect(['index']);
        } else {
            return $this->redirect(['site/index']);
        }
       
    }

    /**
     * Finds the Usuarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Usuarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuarios::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    

    public function actionLogin()
    {
        $model = new Usuarios();
    
        // Si el usuario está logueado, redirigir a la página de inicio
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
    
        if ($this->request->isPost) {
            // Cargar datos del formulario en el modelo
            if ($model->load($this->request->post())) {
                // Validar y loguear al usuario
                if ($model->login($model->username, $model->password)) {
                    return $this->goBack();
                } else {
                    // Si la autenticación falla, mostrar un mensaje de error
                    Yii::$app->session->setFlash('error', 'Usuario o contraseña incorrectos. Vuelva a intentarlo.');
                }
            }
        }
    
        // Si no está logueado, redirigir a la página de login
        $model->password = ''; // Limpiar la contraseña por seguridad
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    

}
