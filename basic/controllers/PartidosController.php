<?php

namespace app\controllers;

use Yii;
use app\models\EstadisticasJugadorPartido;
use app\models\PartidosJornada;
use app\models\JornadasTemporada;
use app\models\Jugadores;
use app\models\JugadoresSearch;
use app\models\Equipos;
use app\models\EstadisticasEquipo;
use app\models\Temporadas;
use app\models\Comentarios;
use app\models\Ligas;
use yii\data\ActiveDataProvider;

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

    // Action in PartidosController.php
    public function actionView($id, $partidoID = null)
    {
        $model = $this->findModel($id);
        // Filtrar comentarios si se proporciona el partidoID
        $query = Comentarios::find();
        if ($partidoID !== null) {
            $query->where(['id_partido' => $partidoID]);
        }

        $comentarios = $query->all();

        // Verificar si el equipo existe
        if ($model === null) {
            throw new NotFoundHttpException('El partido no fue encontrado.');
        }

        // Obtener las estadísticas de los jugadores del equipo local y visitante
        $dataProviderLocal = new ActiveDataProvider([
            'query' => EstadisticasJugadorPartido::find()->where(['id_partido' => $id, 'id_equipo' => $model->equipoLocal->id]),
        ]);

        $dataProviderVisitante = new ActiveDataProvider([
            'query' => EstadisticasJugadorPartido::find()->where(['id_partido' => $id, 'id_equipo' => $model->equipoVisitante->id]),
        ]);

        // Renderizar la vista de detalles del partido
        return $this->render('view', [
            'model' => $model,
            'comentarios' => $comentarios,
            'dataProviderLocal' => $dataProviderLocal,
            'dataProviderVisitante' => $dataProviderVisitante,
            'partidoID' => $id, // Pasar el ID del partido a la vista
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
        if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2 && Yii::$app->user->identity->id_rol != 4))
        {
            // Usuario no autenticado o no tiene el rol adecuado
            Yii::$app->session->setFlash('error', 'No tienes permisos para realizar esta acción.');
            return $this->redirect(['index']);
        }

        $model = new PartidosJornada();

        if (Yii::$app->request->isPost) {

            $model->load(Yii::$app->request->post());
  
            if($model->id_equipo_local == $model->id_equipo_visitante)
            {
                print_r($model->errors);
                // Muestra los errores de validación del modelo Equipos
                Yii::$app->session->setFlash('error', 'Los equipos son iguales.');

                return $this->render('create', [
                    'model' => $model,
                ]);
            }

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


            if ($model->load(Yii::$app->request->post()))
            {
                if($model->id_equipo_local == $model->id_equipo_visitante)
                {
                    print_r($model->errors);
                    // Muestra los errores de validación del modelo Equipos
                    Yii::$app->session->setFlash('error', 'Los equipos son iguales.');
    
                    return $this->render('create-en-jornada', [
                        'model' => $model,
                    ]);
                }
            
                if($model->save()) {
                    return $this->redirect(['partidos/index', 'jornadaID' => $jornadaID]);
                }
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

    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2 && Yii::$app->user->identity->id_rol != 4))
        {
            // Usuario no autenticado o no tiene el rol adecuado
            Yii::$app->session->setFlash('error', 'No tienes permisos para realizar esta acción.');
            return $this->redirect(['index']);
        }

        // Buscar el partido por su ID
        $partido = PartidosJornada::findOne($id);

        // Verificar si el partido existe
        if ($partido === null) {
            throw new NotFoundHttpException('El partido no fue encontrado.');
        }

        // Procesar el formulario cuando se envía
        if (Yii::$app->request->isPost) {
            // Cargar los datos del formulario en el modelo de partido
            if ($partido->load(Yii::$app->request->post()) && $partido->save()) {
                // Determinar el equipo ganador y perdedor
            if ($partido->resultado_local > $partido->resultado_visitante) {
                $equipoGanadorId = $partido->id_equipo_local;
                $equipoPerdedorId = $partido->id_equipo_visitante;
            } elseif ($partido->resultado_local < $partido->resultado_visitante) {
                $equipoGanadorId = $partido->id_equipo_visitante;
                $equipoPerdedorId = $partido->id_equipo_local;
            } else {
                $equipoGanadorId = null;
                $equipoPerdedorId = null;
            }

            // Actualizar el contador de victorias, derrotas y empates de los equipos
            if ($equipoGanadorId !== null && $equipoPerdedorId !== null) {
                $equipoGanador = EstadisticasEquipo::findOne(['id_equipo' => $equipoGanadorId]);
                $equipoPerdedor = EstadisticasEquipo::findOne(['id_equipo' => $equipoPerdedorId]);

                if ($equipoGanador !== null && $equipoPerdedor !== null) {   
                    $equipoGanador->partidos_jugados += 1;
                    $equipoPerdedor->partidos_jugados += 1;
                    $equipoGanador->victorias += 1;
                    $equipoPerdedor->derrotas += 1;

                    // Guardar los cambios en los modelos de equipos
                    $equipoGanador->save();
                    $equipoPerdedor->save();
                }
            } else if ($equipoGanadorId === null && $equipoPerdedorId === null) {
                $equipoLocal = EstadisticasEquipo::findOne(['id_equipo' => $partido->id_equipo_local]);
                $equipoVisitante = EstadisticasEquipo::findOne(['id_equipo' => $partido->id_equipo_visitante]);

                if ($equipoLocal !== null && $equipoVisitante !== null) {
                    $equipoLocal->partidos_jugados += 1;
                    $equipoVisitante->partidos_jugados += 1;
                    $equipoLocal->empates += 1;
                    $equipoVisitante->empates += 1;

                    $equipoLocal->save();
                    $equipoVisitante->save();
                }
            }

                // Redirigir a la vista de detalles después de la actualización exitosa
                return $this->redirect(['view', 'id' => $partido->id]);
            }
        }

        // Renderizar la vista de actualización con el formulario y el modelo de partido
        return $this->render('update', [
            'partido' => $partido,
        ]);
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

    // Acción para borrar un partido
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2 && Yii::$app->user->identity->id_rol != 4))
        {
            // Usuario no autenticado o no tiene el rol adecuado
            Yii::$app->session->setFlash('error', 'No tienes permisos para realizar esta acción.');
            return $this->redirect(['index']);
        }

        $partido = PartidosJornada::findOne($id);

        if ($partido === null) {
            throw new NotFoundHttpException('El partido no fue encontrado.');
        }

        $partido->delete();

        return $this->redirect(['index']);
    }

    // Acción para copiar un partido
    public function actionCopy($id)
    {
        if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2 && Yii::$app->user->identity->id_rol != 4))
        {
            // Usuario no autenticado o no tiene el rol adecuado
            Yii::$app->session->setFlash('error', 'No tienes permisos para realizar esta acción.');
            return $this->redirect(['index']);
        }
        
        $partidoExistente = PartidosJornada::findOne($id);
 
        if ($partidoExistente === null) {
            throw new NotFoundHttpException('El partido no fue encontrado.');
        }
 
        // Crear una copia del partido
        $nuevoPartido = new PartidosJornada();
        $nuevoPartido->attributes = $partidoExistente->attributes;
 
        // Asignar un nuevo identificador único al nuevo partido
        $nuevoPartido->id = null;

        $nuevoPartido->save();

        // Redirigir a la página de partidos
        return $this->redirect(['index', 'id' => $nuevoPartido->id]);
    }

    protected function actionAgregarComentario($id_partido)
    {
        // Verifica si el usuario está autenticado
        if (Yii::$app->user->isGuest) {
            // Si el usuario no está autenticado, redirige a la página de inicio de sesión
            Yii::$app->session->setFlash('error', 'Debes iniciar sesión para escribir comentarios.');
        }

        // Crea un nuevo modelo de Comentarios
        $nuevoComentarioModel = new Comentarios();

        if (Yii::$app->request->isPost) {

            $nuevoComentarioModel->load(Yii::$app->request->post());

            // Asigna los valores del comentario
            $nuevoComentarioModel->id_partido = $id_partido;
            $nuevoComentarioModel->id_usuario = Yii::$app->user->id; // Asigna el ID del usuario actual
            $nuevoComentarioModel->fecha_hora = date('Y-m-d H:i:s'); // Asigna la fecha y hora actual

            // Guarda el comentario en la base de datos
            if ($nuevoComentarioModel->save()) {
                Yii::$app->session->setFlash('success', '¡Comentario agregado exitosamente!');
                // Redirige al usuario de vuelta a la página de detalles de partido
                return $this->redirect(['view', 'id_partido' => $id_partido]);
            } else {
                // Hubo un error al guardar el comentario.
                // Mantener el texto del comentario en el formulario.
                Yii::$app->session->setFlash('error', 'Hubo un error al guardar el comentario.');
                return $this->render('view', [
                    'id_partido' => $id_partido,
                    'nuevoComentarioModel' => $nuevoComentarioModel,
                ]);
            }
        }

        return $this->render('view', [
            'id_partido' => $id_partido,
            'nuevoComentarioModel' => $nuevoComentarioModel,
        ]);
    }
}
?>