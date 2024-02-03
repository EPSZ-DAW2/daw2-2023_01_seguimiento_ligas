<?php

namespace app\controllers;

use Yii;
use app\models\PartidosJornada;
use app\models\JornadasTemporada;
use app\models\Equipos;
use app\models\Temporadas;
use app\models\Comentarios;

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

    public function actionView($id, $partidoID = null)
    {
        $model = $this->findModel($id);
         // Filtrar comentarios si se proporciona el partidoID
         $query = Comentarios::find();
         if ($partidoID !== null) {
             $query->where(['id_partido' => $partidoID]);
         }
 
         $comentarios = $query->all();

        return $this->render('view', [
            'model' => $model,
            'comentarios' => $comentarios,
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

    public function actionCreate($jornadaID = null)
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
