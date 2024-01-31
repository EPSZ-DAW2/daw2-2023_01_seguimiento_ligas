<?php

namespace app\controllers;

use Yii;
use app\models\PartidosJornada;
use app\models\JornadasTemporada;
use app\models\Equipos;
use app\models\Temporadas;

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

    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }
    
    protected function findModel($id)
    {
        if (($model = PartidosJornada::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('El partido solicitado no existe.');
        }
    }

    public function actionCreate()
    {
        $model = new PartidosJornada();

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate()
    {
        return $this->render('update');
    }

    public function actionCargarTemporadas($id_liga)
    {
        $temporadas = Temporadas::find()->where(['id_liga' => $id_liga])->all();
    
        if ($temporadas) {
            return $this->renderAjax('_dropdown_temporadas', [
                'temporadas' => $temporadas,
            ]);
        } else {
            return 'No se encontraron temporadas para la liga seleccionada.';
        }
    }    

    public function actionCargarJornadas($id_temporada)
    {
        $jornadas = JornadasTemporada::find()->where(['id_temporada' => $id_temporada])->all();
    
        if ($jornadas) {
            return $this->renderAjax('_dropdown_jornadas', [
                'jornadas' => $jornadas,
            ]);
        } else {
            return 'No se encontraron jornadas para la temporada seleccionada.';
        }
    }  
}
