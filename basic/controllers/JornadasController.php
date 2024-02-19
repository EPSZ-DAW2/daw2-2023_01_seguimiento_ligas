<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\JornadasTemporada;
use app\models\Temporadas;
use app\models\PartidosJornada;

class JornadasController extends \yii\web\Controller
{
    public function actionIndex($id)
    {
        // Obtén la temporada según el ID proporcionado
        $temporada = Temporadas::findOne($id);

        // Obtén todas las jornadas de la temporada con el id proporcionado
        $jornadas = JornadasTemporada::find()->where(['id_temporada' => $id])->all();

        // Renderiza la vista y pasa las jornadas como parámetro
        return $this->render('index', [
            'temporada' => $temporada,
            'jornadas' => $jornadas,
        ]);
    }


    public function actionCreate($temporadaID)
    {
        if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2 && Yii::$app->user->identity->id_rol != 4))
        {
            // Usuario no autenticado o no tiene el rol adecuado
            Yii::$app->session->setFlash('error', 'No tienes permisos para realizar esta acción.');
            return $this->redirect(['index']);
        }
        
        $model = new JornadasTemporada();

        $model->id_temporada = $temporadaID;

        if (Yii::$app->request->isPost) {

            $model->load(Yii::$app->request->post());
  
            if ($model->save()) {
                return $this->redirect(['jornadas/index', 'id' => $temporadaID]);
            } else {
                print_r($model->errors);
                // Muestra los errores de validación del modelo Equipos
    

                return $this->render('create', [
                    'model' => $model,
                    'temporadaID' => $temporadaID,
                ]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2 && Yii::$app->user->identity->id_rol != 4))
        {
            // Usuario no autenticado o no tiene el rol adecuado
            Yii::$app->session->setFlash('error', 'No tienes permisos para realizar esta acción.');
            return $this->redirect(['index']);
        }

        // Buscar la jornada por su ID
        $jornada = JornadasTemporada::findOne($id);

        // Verificar si la jornada existe
        if ($jornada === null) {
            throw new NotFoundHttpException('La jornada no fue encontrada.');
        }

        // Procesar el formulario cuando se envía
        if (Yii::$app->request->isPost) {
            // Cargar los datos del formulario en el modelo de jornada
            if ($jornada->load(Yii::$app->request->post()) && $jornada->save()) {
                // Redirigir a la vista de detalles después de la actualización exitosa
                return $this->redirect(['view', 'id' => $jornada->id]);
            }
        }

        // Renderizar la vista de actualización con el formulario y el modelo de jornada
        return $this->render('update', [
            'jornada' => $jornada,
        ]);
    }

    public function actionView($id)
    {
        // Buscar la jornada por su ID
        $jornada = JornadasTemporada::findOne($id);

        // Verificar si el equipo existe
        if ($jornada === null) {
            throw new NotFoundHttpException('La jornada no fue encontrada.');
        }

        // Renderizar la vista de detalles del equipo
        return $this->render('view', [
            'jornada' => $jornada,
        ]);
    }

    // Acción para borrar una jornada
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2 && Yii::$app->user->identity->id_rol != 4))
        {
            // Usuario no autenticado o no tiene el rol adecuado
            Yii::$app->session->setFlash('error', 'No tienes permisos para realizar esta acción.');
            return $this->redirect(['index']);
        }

        $jornada = JornadasTemporada::findOne($id);

        if ($jornada === null) {
            throw new NotFoundHttpException('La jornada no fue encontrada.');
        }

        $id_temporada = $jornada->temporada->id;

        // Obtener el modelo de la temporada correspondiente
        $temporada = Temporadas::findOne($id_temporada);

        if ($temporada === null) {
            throw new NotFoundHttpException('La temporada no fue encontrada.');
        }

        // Obtener los partidos asociados al equipo (local o visitante)
        $partidosLocal = PartidosJornada::find()->where(['id_equipo_local' => $jornada->id])->all();
        $partidosVisitante = PartidosJornada::find()->where(['id_equipo_visitante' => $jornada->id])->all();

        $partidos = array_merge($partidosLocal, $partidosVisitante);


        // Eliminar los partidos asociados
        foreach ($partidos as $partido) {
            $partido->delete();
        }
        
        $jornada->delete();

        return $this->redirect(['jornadas/index', 'id' => $jornada->id_temporada]);

    }

    // Acción para copiar una jornada
    /*
    public function actionCopy($id)
    {
        if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2 && Yii::$app->user->identity->id_rol != 4))
        {
            // Usuario no autenticado o no tiene el rol adecuado
            Yii::$app->session->setFlash('error', 'No tienes permisos para realizar esta acción.');
            return $this->redirect(['index']);
        }
        
        $jornadaExistente = JornadasTemporada::findOne($id);
 
        if ($jornadaExistente === null) {
            throw new NotFoundHttpException('La jornada no fue encontrada.');
        }
 
        // Crear una copia de la jornada
        $nuevaJornada = new JornadasTemporada();

        // Asignar un nuevo identificador único a la nueva jornada
        $nuevaJornada->id = null;

        // Se copia el resto de campos menos el nombre
        foreach ($jornadaExistente->attributes as $attribute => $value) {
            if ($attribute !== 'id') {
                $nuevaJornada->$attribute = $value;
            }
        }

        $nuevaJornada->save();

        // Redirigir a la página de jornadas
        return $this->redirect(['index', 'id' => $nuevaJornada->id_temporada]);
    }
    */

}
