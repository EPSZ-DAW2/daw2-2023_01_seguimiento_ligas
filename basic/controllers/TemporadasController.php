<?php

namespace app\controllers;

use Yii;
use app\models\Temporadas;
use app\models\Ligas;
use app\models\Equipos;
use app\models\JornadasTemporada;
use app\models\PartidosJornada;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TemporadasController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $this->view->title = 'ArosInsider - Temporadas';

        // Obtén todas las temporadas desde la base de datos
        $temporadas= Temporadas::find()->all();

        // Renderiza la vista y pasa los equipos como parámetro
        return $this->render('index', [
            'temporadas' => $temporadas,
        ]);
    }

    public function actionCreate()
    {
        if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2 && Yii::$app->user->identity->id_rol != 4))
        {
            // Usuario no autenticado o no tiene el rol adecuado
            Yii::$app->session->setFlash('error', 'No tienes permisos para realizar esta acción.');
            return $this->redirect(['index']);
        }
    
        $model = new Temporadas();
    
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Comprobar que la fecha de final es posterior que la de inicio
            if ($model->fecha_inicial > $model->fecha_final) {
                $model->addError('fecha_final', 'La fecha de final debe ser posterior a la fecha de inicio.');
                return $this->render('create', ['model' => $model]);
            }
    
            // Validar que la temporada tenga una duración mínima de 2 semanas
            $fechaInicio = strtotime($model->fecha_inicial);
            $fechaFin = strtotime($model->fecha_final);
    
            $duracionMinima = 2 * 7 * 24 * 60 * 60; // 2 semanas en segundos
    
            if ($fechaFin - $fechaInicio < $duracionMinima) {
                $model->addError('fecha_final', 'La temporada debe tener una duración mínima de 2 semanas.');
                return $this->render('create', ['model' => $model]);
            }
    
            // Guardar la temporada en la base de datos
            $model->save();
    
            // Redirigir a la vista de index o a donde desees
            return $this->redirect(['index']);
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

        // Buscar la temporada por su ID
        $temporada = Temporadas::findOne($id);

        // Verificar si la temporada existe
        if ($temporada === null) {
            throw new NotFoundHttpException('La temporada no fue encontrada.');
        }

        // Procesar el formulario cuando se envía
        if (Yii::$app->request->isPost) {
            // Cargar los datos del formulario en el modelo de temporada
            if ($temporada->load(Yii::$app->request->post()) && $temporada->save()) {
                // Redirigir a la vista de detalles después de la actualización exitosa
                return $this->redirect(['view', 'id' => $temporada->id]);
            }
        }

        // Renderizar la vista de actualización con el formulario y el modelo de temporada
        return $this->render('update', [
            'temporada' => $temporada,
        ]);
    }

    public function actionView($id)
    {
        $temporada = $this->findModel($id);
        $jornadas = $temporada->getJornadasTemporadas()->all();

        return $this->render('view', [
            'temporada' => $temporada,
            'jornadas' => $jornadas,
        ]);
    }

    // Acción para borrar una temporada
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2 && Yii::$app->user->identity->id_rol != 4))
        {
            // Usuario no autenticado o no tiene el rol adecuado
            Yii::$app->session->setFlash('error', 'No tienes permisos para realizar esta acción.');
            return $this->redirect(['index']);
        }

        $temporada = Temporadas::findOne($id);

        if ($temporada === null) {
            throw new NotFoundHttpException('La temporada no fue encontrada.');
        }

        // Se obtienen los partidos y jornadas asociados a esta temporada
        $equipos = Equipos::find()->where(['id_temporada' => $temporada->id])->all();

        // Eliminar los equipos asociados
        foreach ($equipos as $equipo) {
            $equipo->delete();
        }
        
        $jornadas = JornadasTemporada::find()->where(['id_temporada' => $temporada->id])->all();

        // Eliminar las jornadas asociadas
        foreach ($jornadas as $jornada) {
            $jornada->delete();
        }

        $temporada->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Temporadas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('La página solicitada no existe.');
    }

    // Acción para copiar una temporada y poder actualizar los equipos a una nueva sin problema
    public function actionCopy($id)
    {
        if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2 && Yii::$app->user->identity->id_rol != 4))
        {
            // Usuario no autenticado o no tiene el rol adecuado
            Yii::$app->session->setFlash('error', 'No tienes permisos para realizar esta acción.');
            return $this->redirect(['index']);
        }
        
        $temporadaExistente = Temporadas::findOne($id);

        if ($temporadaExistente === null) {
            throw new NotFoundHttpException('La temporada no fue encontrada.');
        }

        // Crear una copia de la temporada
        $nuevaTemporada = new Temporadas();
        
        $nuevaTemporada->texto_de_titulo = $temporadaExistente->texto_de_titulo . " (copia)";

        // Se copia el resto de campos menos el nombre
        foreach ($temporadaExistente->attributes as $attribute => $value) {
            if ($attribute !== 'texto_de_titulo') {
                $nuevaTemporada->$attribute = $value;
            }
        }

        // Asignar un nuevo identificador único a la nueva temporada
        $nuevaTemporada->id = null;

        $nuevaTemporada->save();

        // Copiar los equipos de la temporada existente a la nueva temporada
        foreach ($temporadaExistente->equipos as $equipoExistente) {
            $nuevoEquipo = new Equipos();
            $nuevoEquipo->attributes = $equipoExistente->attributes;
            $nuevoEquipo->nombre = $equipoExistente->nombre;
            $nuevoEquipo->id_temporada = $nuevaTemporada->id;
            $nuevoEquipo->id = null;
            $nuevoEquipo->save();
        }

        // Copiar las jornadas de la temporada existente a la nueva temporada
        foreach ($temporadaExistente->jornadasTemporadas as $jornadaExistente) {
            $nuevaJornada = new JornadasTemporada();

            foreach ($jornadaExistente->attributes as $attribute => $value) {
                    $nuevaJornada->$attribute = $value;
            }

            $nuevaJornada->id_temporada = $nuevaTemporada->id;

            // Asignar un nuevo identificador único a la nueva jornada
            $nuevaJornada->id = null;
            
            $nuevaJornada->save();

            foreach ($jornadaExistente->partidosJornadas as $partidoExistente) {
                $nuevoPartido = new PartidosJornada();
                $nuevoPartido->attributes = $partidoExistente->attributes;
                
                // Obtener el equipo local del partido anterior
                $equipoLocalAnterior = Equipos::findOne($partidoExistente->id_equipo_local);

                $equipoVisitanteAnterior = Equipos::findOne($partidoExistente->id_equipo_visitante);

                // Buscar el equipo correspondiente en la nueva temporada con el mismo nombre
                $nuevoEquipoLocal = Equipos::findOne(['nombre' => $equipoLocalAnterior->nombre, 'id_temporada' => $nuevaTemporada->id]);

                $nuevoEquipoVisitante = Equipos::findOne(['nombre' => $equipoVisitanteAnterior->nombre, 'id_temporada' => $nuevaTemporada->id]);
                
                $nuevoPartido->id_equipo_local = $nuevoEquipoLocal->id;
                $nuevoPartido->id_equipo_visitante = $nuevoEquipoVisitante->id;

            
                // Asignar la nueva jornada al partido
                $nuevoPartido->id_jornada = $nuevaJornada->id; 
                $nuevoPartido->id = null;

                $nuevoPartido->save();
            }
        }

        // Redirigir a la página de temporadas
        return $this->redirect(['index']);
    }

}