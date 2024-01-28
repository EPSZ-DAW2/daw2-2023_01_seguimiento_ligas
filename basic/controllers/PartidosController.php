<?php

namespace app\controllers;

use Yii;
use app\models\PartidosJornada;

class PartidosController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $this->view->title = 'ArosInsider - Partidos';
        
        // Obtén todos los partidos desde la base de datos
        $partidos= PartidosJornada::find()->all();

        // Renderiza la vista y pasa los equipos como parámetro
        return $this->render('index', [
            'partidos' => $partidos,
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
