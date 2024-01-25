<?php

namespace app\controllers;

use app\models\Jornadas;
use yii\web\Controller;

class JornadasController extends Controller
{
    public function actionIndex()
    {
        // Obtén todos los equipos desde la base de datos
        $temporadas = Jornadas::find()->all();

        // Renderiza la vista y pasa los temporadas como parámetro
        return $this->render('index', [
            'temporadas' => $temporadas,
        ]);
    }
}
