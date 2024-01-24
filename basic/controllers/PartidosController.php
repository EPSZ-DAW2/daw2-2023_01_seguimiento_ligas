<?php

namespace app\controllers;

use app\models\Partidos;
use yii\web\Controller;

class PartidosController extends Controller
{
    public function actionIndex()
    {
        // Obtén todos los equipos desde la base de datos
        $partidos = Partidos::find()->all();

        // Renderiza la vista y pasa los equipos como parámetro
        return $this->render('index', [
            'partidos' => $partidos,
        ]);
    }
}
?>