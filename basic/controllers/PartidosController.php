<?php

namespace app\controllers;

use Yii;
use app\models\PartidosJornada;
use app\models\JornadasTemporada;
use app\models\Equipos;
use app\models\Temporadas;
use app\models\Ligas;

class PartidosController extends \yii\web\Controller
{
    public function actionIndex($jornadaID = null)
    {
        $this->view->title = 'ArosInsider - Partidos';

        // Filtrar partidos si se proporciona el jornadaID
        $query = PartidosJornada::find()->with('jornada.temporada');

        if ($jornadaID !== null) {
            $query->where(['id_jornada' => $jornadaID]);
        }

        $partidos = $query->all();

        return $this->render('index', [
            'partidos' => $partidos,
            'jornadaID' => $jornadaID,
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

        if (Yii::$app->request->isPost) {

            $model->load(Yii::$app->request->post());
  
            if ($model->save()) {
                return $this->redirect(['partidos/index']);
            } else {
                print_r($model->errors);
                // Muestra los errores de validación del modelo Equipos
                Yii::$app->session->setFlash('error', 'Error al guardar el equipo.');

                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    // Acción para crear un partido dentro de una jornada
    public function actionCreateEnJornada($jornadaID)
    {
        $model = new PartidosJornada();
        $model->id_jornada = $jornadaID;

        $jornada = JornadasTemporada::find()->with('temporada.liga')->where(['id' => $jornadaID])->one();

        if ($jornada && $jornada->temporada->liga) {
            $ligas = $jornada->temporada->liga;
            
            $temporadaId = [$jornada->temporada->id];
            
            // Obtener la liga
            $liga = [$jornada->temporada->liga->id => $jornada->temporada->liga->nombre];


            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['partidos/index', 'jornadaID' => $jornadaID]);
            }

            return $this->render('create-en-jornada', [
                'model' => $model,
                'jornada' => $jornada,
                'temporada' => $temporadaId,
            ]);
        
        } else {
            // Manejar el caso en el que no se cargaron las relaciones correctamente
            throw new \yii\web\NotFoundHttpException('La jornada o la temporada no existe.');
        }
    }


    public function actionUpdate()
    {
        return $this->render('update');
    }

    public function actionCargarTemporadas($id_liga)
    {
        $temporadas = Temporadas::find()
            ->where(['id_liga' => $id_liga])
            ->andWhere(['>', 'fecha_final', date('Y-m-d')]) // Filtrar por temporadas actuales y futuras
            ->all();
    
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
        $jornadas = JornadasTemporada::find()
            ->where(['id_temporada' => $id_temporada])
            ->andWhere(['>', 'fecha_inicio', date('Y-m-d')])
            ->all();
    
        if ($jornadas) {
            return $this->renderAjax('_dropdown_jornadas', [
                'jornadas' => $jornadas,
            ]);
        } else {
            return 'No se encontraron jornadas para la temporada seleccionada.';
        }
    }  
}
