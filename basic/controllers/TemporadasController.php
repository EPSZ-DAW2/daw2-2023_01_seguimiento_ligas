<?php

namespace app\controllers;

use app\models\Temporadas;
use yii\web\Controller;

class TemporadasController extends Controller
{
    public function actionIndex()
    {
        // Obtén todos los equipos desde la base de datos
        $temporadas = Temporadas::find()->all();

        // Renderiza la vista y pasa los temporadas como parámetro
        return $this->render('index', [
            'temporadas' => $temporadas,
        ]);
    }
}
