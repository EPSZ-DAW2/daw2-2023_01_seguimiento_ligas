<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\JornadasTemporada;
use app\models\Temporadas;

class JornadasController extends \yii\web\Controller
{
    /*
    public function actionIndex()
    {
        // Obtén todos los equipos desde la base de datos
        $jornadas = JornadasTemporada::find()->all();

        // Renderiza la vista y pasa los equipos como parámetro
        return $this->render('index', [
            'jornadas' => $jornadas,
        ]);
    }
    */

    public function actionIndex($id)
    {
        // Obtén la temporada según el ID proporcionado
        $temporada = Temporadas::findOne($id);

        // Obtén todas las jornadas de la temporada con el id proporcionado
        $jornadas = JornadasTemporada::find()->where(['id_temporada' => $id])->all();

        // Renderiza la vista y pasa las jornadas como parámetro
        return $this->render('index', [
            'temporada' => $temporada,
            'jornadas' => $jornadas,
        ]);
    }


    public function actionCreate($temporadaID)
    {
        $model = new JornadasTemporada();

        $model->id_temporada = $temporadaID;

        if (Yii::$app->request->isPost) {

            $model->load(Yii::$app->request->post());
  
            if ($model->save()) {
                return $this->redirect(['jornadas/index', 'id' => $temporadaID]);
            } else {
                print_r($model->errors);
                // Muestra los errores de validación del modelo Equipos
                Yii::$app->session->setFlash('error', 'Error al guardar la jornada.');

                return $this->render('create', [
                    'model' => $model,
                    'temporadaID' => $temporadaID,
                ]);
            }
        }

        return $this->render('create', [
            'model' => $model,
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
