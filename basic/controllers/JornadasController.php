<?php

namespace app\controllers;
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


    public function actionCreate()
    {
        return $this->render('create');
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
