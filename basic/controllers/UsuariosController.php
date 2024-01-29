<?php

namespace app\controllers;

use Yii;
use app\models\Usuarios;
use app\models\UsuariosSearch;
use yii\web\Controller;
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
    
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                
                $model->password = Yii::$app->security->generatePasswordHash($model->password);
                if ($model->save()) {
                   
                   return $this->redirect(['exito']);
                }
            }
        } else {
            $model->loadDefaultValues();
        }
        
        $model->password = ''; // Limpiar la contraseña por seguridad
        return $this->render('create', [
            'model' => $model,
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
    
        if ($this->request->isPost && $model->load($this->request->post())) {
            // Generar el hash de la contraseña solo si se proporciona una nueva contraseña
            if (!empty($model->password)) {
                $model->password = Yii::$app->security->generatePasswordHash($model->password);
            }
    
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
    
        return $this->render('update', [
            'model' => $model,
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
            return $this->redirect(['site/home']);
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
