<?php

namespace app\controllers;

use Yii;
use app\models\Noticias;
use yii\web\Controller;


class NoticiasController extends Controller{

    public function actionCreate()
    {
        $model = new Noticias();  // Crea una nueva instancia del modelo Noticias

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