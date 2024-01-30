<?php

namespace app\controllers;

use Yii;
use app\models\PartidosJornada;
use app\models\JornadasTemporada;
use app\models\Equipos;
use app\models\Temporadas;

class PartidosController extends \yii\web\Controller
{
    public function actionIndex($jornadaID = null)
    {
        // Filtrar partidos si se proporciona el jornadaID
        $query = PartidosJornada::find();
        if ($jornadaID !== null) {
            $query->where(['id_jornada' => $jornadaID]);
        }

        $partidos = $query->all();

        return $this->render('index', [
            'partidos' => $partidos,
        ]);
    }


    public function actionCreate($jornadaID = null)
    {
        $model = new PartidosJornada();

        if ($jornadaID !== null) {
            $model->id_jornada = $jornadaID;
        }
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // Éxito al guardar el partido, puedes redirigir o hacer lo que necesites
            return $this->redirect(['view', 'id' => $model->id]);
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
