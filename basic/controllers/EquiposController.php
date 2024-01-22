<?php

namespace app\controllers;

use app\models\Equipos;
use yii\web\Controller;

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
}
