<?php

namespace app\controllers;

use Yii;
use app\models\Equipos;
use app\models\Temporadas;
use app\models\Ligas;
use app\models\EstadisticasEquipo;
use app\models\Imagenes;
use app\models\PartidosJornada;
use app\models\Jugadores;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\db\Expression;


class EquiposController extends Controller
{

    public function actionIndex()
    {
        $this->view->title = 'ArosInsider - Equipos';

        // Obtén todos los equipos desde la base de datos
        $equipos = Equipos::find()->all();

        $ligas = Ligas::find()->all();

        // Renderiza la vista y pasa los equipos como parámetro
        return $this->render('index', [
            'equipos' => $equipos,
            'ligas' => $ligas,
        ]);
    }

    public function actionCreate()
    {
        if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2 && Yii::$app->user->identity->id_rol != 6))
        {
            // Usuario no autenticado o no tiene el rol adecuado
            Yii::$app->session->setFlash('error', 'No tienes permisos para realizar esta acción.');
            return $this->redirect(['index']);
        }

        $model = new Equipos();
        $imagenModel = new Imagenes();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $imagenModel->imagenFile = UploadedFile::getInstance($imagenModel, 'imagenFile');

            if (empty($imagenModel->imagenFile)) {
                $imagenModel->addError('imagenFile', 'La imagen es un campo obligatorio.');
            // Validar y guardar la imagen
            } elseif($imagenModel->validate() && $imagenModel->saveImagen()) {
                // Asigna el ID de la imagen al modelo de Equipos después de guardarla
                $model->id_escudo = $imagenModel->id;

                // Guarda el modelo de Equipos
                if ($model->save()) {
                    return $this->redirect(['equipos/index']);
                } else {
                    print_r($model->errors);
                    // Muestra los errores de validación del modelo Equipos
                    //Yii::$app->session->setFlash('error', 'Error al guardar el equipo.');
                    
                    return $this->render('create', [
                        'model' => $model,
                        'imagenModel' => $imagenModel,
                    ]);
                }
            } else {
                // Muestra los errores de validación de la imagen
                Yii::$app->session->setFlash('error', 'Error al cargar la imagen.');
            }
        }

        return $this->render('create', [
            'model' => $model,
            'imagenModel' => $imagenModel,
        ]);
    }

    public function actionCreateEnTemporada($temporadaID)
    {
        if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2 && Yii::$app->user->identity->id_rol != 6))
        {
            // Usuario no autenticado o no tiene el rol adecuado
            Yii::$app->session->setFlash('error', 'No tienes permisos para realizar esta acción.');
            return $this->redirect(['index']);
        }

        $model = new Equipos();

        $model->id_temporada = $temporadaID;

        $liga = Ligas::find()->where(['id' => $temporadaID])->one();

        if($liga)
        {
            $model->id_liga = $liga->id;
        }

        $imagenModel = new Imagenes();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $imagenModel->imagenFile = UploadedFile::getInstance($imagenModel, 'imagenFile');

            if (empty($imagenModel->imagenFile)) {
                $imagenModel->addError('imagenFile', 'La imagen es un campo obligatorio.');
            // Validar y guardar la imagen
            } elseif($imagenModel->validate() && $imagenModel->saveImagen()) {
                // Asigna el ID de la imagen al modelo de Equipos después de guardarla
                $model->id_escudo = $imagenModel->id;

                // Guarda el modelo de Equipos
                if ($model->save()) {
                    return $this->redirect(['equipos/index']);
                } else {
                    print_r($model->errors);
                    // Muestra los errores de validación del modelo Equipos
                    //Yii::$app->session->setFlash('error', 'Error al guardar el equipo.');
                    
                    return $this->render('create', [
                        'model' => $model,
                        'imagenModel' => $imagenModel,
                    ]);
                }
            } else {
                // Muestra los errores de validación de la imagen
                Yii::$app->session->setFlash('error', 'Error al cargar la imagen.');
            }
        }

        return $this->render('create-en-temporada', [
            'model' => $model,
            'imagenModel' => $imagenModel,
        ]);
    }


    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2 && Yii::$app->user->identity->id_rol != 6))
        {
            // Usuario no autenticado o no tiene el rol adecuado
            Yii::$app->session->setFlash('error', 'No tienes permisos para realizar esta acción.');
            return $this->redirect(['index']);
        }

        // Buscar el equipo por su ID
        $equipo = Equipos::findOne($id);

        // Verificar si el equipo existe
        if ($equipo === null) {
            throw new NotFoundHttpException('El equipo no fue encontrado.');
        }

        // Procesar el formulario cuando se envía
        if (Yii::$app->request->isPost) {
            // Cargar los datos del formulario en el modelo de equipo
            if ($equipo->load(Yii::$app->request->post()) && $equipo->save()) {
                // Redirigir a la vista de detalles después de la actualización exitosa
                return $this->redirect(['view', 'id' => $equipo->id]);
            }
        }

        // Renderizar la vista de actualización con el formulario y el modelo de equipo
        return $this->render('update', [
            'equipo' => $equipo,
        ]);
    }

    public function actionView($id)
    {
        // Buscar el equipo por su ID
        $equipo = Equipos::findOne($id);

        // Verificar si el equipo existe
        if ($equipo === null) {
            throw new NotFoundHttpException('El equipo no fue encontrado.');
        }

        // Renderizar la vista de detalles del equipo
        return $this->render('view', [
            'equipo' => $equipo,
        ]);
    }

    public function actionVerPorLiga($ligaId)
    {
        $this->view->title = 'ArosInsider - Equipos';
        
        $liga = Ligas::findOne($ligaId);
        $equipos = Equipos::find()->where(['id_liga' => $ligaId])->all();

        if ($equipos) {
            return $this->render('ver-por-liga', [
                'equipos' => $equipos,
                'liga' => $liga,
            ]);
        } else {
            return 'No se encontraron equipos para la temporada seleccionada.';
        }
    }

    // Acción para ver los partidos por liga
    public function actionVerPorTemporada($id)
    {
        $this->view->title = 'ArosInsider - Equipos';
        
        $temporada = Temporadas::findOne($id);
        $equipos = Equipos::find()->where(['id_temporada' => $id])->all();

        return $this->render('ver-por-temporada', [
            'equipos' => $equipos,
            'temporada' => $temporada
        ]);
    }

    // Acción para cargar las temporadas futuras a la fecha en el formulario de crear equipo
    public function actionCargarTemporadas($id_liga)
    {
        $temporadas = Temporadas::find()
            ->where(['id_liga' => $id_liga])
            ->andWhere(['>', 'fecha_inicial', date('Y-m-d')]) // Filtrar por temporadas futuras
            ->all();

        if ($temporadas) {
            return $this->renderAjax('_dropdown_temporadas', [
                'temporadas' => $temporadas,
            ]);
        } else {
            return 'No se encontraron temporadas para la liga seleccionada.';
        }
    }

    // Acción para cargar las temporadas en la vista de actualizar un equipo
    public function actionCargarTemporadasUpdate($id_liga)
    {
        $temporadas = Temporadas::find()
            ->where(['id_liga' => $id_liga])
            ->all();

        if ($temporadas) {
            return $this->renderAjax('_dropdown_temporadas', [
                'temporadas' => $temporadas,
            ]);
        } else {
            return 'No se encontraron temporadas para la liga seleccionada.';
        }
    }

    // Acción para cargar los equipos por la temporada seleccionada
    public function actionEquiposPorTemporada($id_temporada)
    {
        $equipos = Equipos::find()->where(['id_temporada' => $id_temporada])->all();
        
        if ($equipos) {
            return $this->renderAjax('_dropdown_equipos', [
                'equipos' => $equipos,
            ]);
        } else {
            return 'No se encontraron equipos para la temporada seleccionada.';
        }
    }

    // Acción para borrar un equipo
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2 && Yii::$app->user->identity->id_rol != 6))
        {
            // Usuario no autenticado o no tiene el rol adecuado
            Yii::$app->session->setFlash('error', 'No tienes permisos para realizar esta acción.');
            return $this->redirect(['index']);
        }

        $equipo = Equipos::findOne($id);

        if ($equipo === null) {
            throw new NotFoundHttpException('El equipo no fue encontrado.');
        }

        // Obtener los partidos asociados al equipo (local o visitante)
        $partidosLocal = PartidosJornada::find()->where(['id_equipo_local' => $equipo->id])->all();
        $partidosVisitante = PartidosJornada::find()->where(['id_equipo_visitante' => $equipo->id])->all();

        $partidos = array_merge($partidosLocal, $partidosVisitante);


        // Eliminar los partidos asociados
        foreach ($partidos as $partido) {
            $partido->delete();
        }
        
        $equipo->delete();

        return $this->redirect(['index']);
    }

    // Acción para copiar un equipo
    public function actionCopy($id)
    {
        if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2 && Yii::$app->user->identity->id_rol != 6))
        {
            // Usuario no autenticado o no tiene el rol adecuado
            Yii::$app->session->setFlash('error', 'No tienes permisos para realizar esta acción.');
            return $this->redirect(['index']);
        }
        
        $equipoExistente = Equipos::findOne($id);
 
        if ($equipoExistente === null) {
            throw new NotFoundHttpException('El equipo no fue encontrado.');
        }
 
        // Crear una copia del equipo
        $nuevoEquipo = new Equipos();

        $nuevoEquipo->nombre = $equipoExistente->nombre . ' (copia)';

        // Asignar un nuevo identificador único al nuevo equipo
        $nuevoEquipo->id = null;

        // Se copia el resto de campos menos el nombre
        foreach ($equipoExistente->attributes as $attribute => $value) {
            if ($attribute !== 'id' && $attribute !== 'nombre') {
                $nuevoEquipo->$attribute = $value;
            }
        }

        $nuevoEquipo->save();

        // Copiar los partidos asociados al equipo
        $partidos = PartidosJornada::find()
        ->where(['or', ['id_equipo_local' => $equipoExistente->id], ['id_equipo_visitante' => $equipoExistente->id]])
        ->all();
    

        foreach ($partidos as $partido) {

            $nuevoPartido = new PartidosJornada();

            $nuevoPartido->attributes = $partido->attributes;

            if ($partido->id_equipo_local === $equipoExistente->id) {
                $nuevoPartido->id_equipo_local = $nuevoEquipo->id;
            }


            if ($partido->id_equipo_visitante === $equipoExistente->id) {
                $nuevoPartido->id_equipo_visitante = $nuevoEquipo->id;
            }

            $nuevoPartido->save();
        }

        // Redirigir a la página de equipos
        return $this->redirect(['index', 'id' => $nuevoEquipo->id]);
    }

    public function actionVista($id)
    {
        $this->view->title = 'ArosInsider - Equipos';

        $equipo = Equipos::findOne($id);

        $fechaActual = new Expression('NOW()');

        $temporadaActual = Temporadas::find()
        ->joinWith('estadisticasEquipos')
        ->where(['<=', 'fecha_inicial', $fechaActual])
        ->andWhere(['>=', 'fecha_final', $fechaActual])
        ->andWhere(['estadisticas_equipo.id_equipo' => $id])
        ->one();

        if ($temporadaActual !== null) {
            // Si se encontró una temporada para el año actual, puedes acceder a su ID
            $idTemporadaActual = $temporadaActual->id;
            
            // Obtener las estadísticas del equipo
            $estadisticas = EstadisticasEquipo::find()->
                where(['id_equipo' => $id])
                ->andWhere(['id_temporada' => $idTemporadaActual])
                ->one();
        }
        else {
            $estadisticas = NULL;
        }

        // Obtener últimos resultados
        $ultimosResultados = PartidosJornada::find()
        ->where(['<', 'horario', new Expression('NOW()')])
        ->andWhere(['or',
            ['id_equipo_local' => $id],
            ['id_equipo_visitante' => $id],
        ])
        ->orderBy(['horario' => SORT_DESC])
        ->limit(5)
        ->all();

        // Obtener próximos partidos
        $proximosPartidos = PartidosJornada::find()
        ->where(['>=', 'horario', new Expression('NOW()')])
        ->andWhere(['or',
            ['id_equipo_local' => $id],
            ['id_equipo_visitante' => $id],
        ])
        ->orderBy(['horario' => SORT_ASC])
        ->limit(5)
        ->all();

        // Obtener los jugadores del equipo que tengan más puntos en las estadísticas de jugador
        $jugadoresDestacados = Jugadores::find()
        ->leftJoin('estadisticas_jugador', 'jugadores.id = estadisticas_jugador.id_jugador')
        ->where(['estadisticas_jugador.id_equipo' => $id]) // Filtrar por el ID del equipo
        ->orderBy(['estadisticas_jugador.puntos' => SORT_DESC])
        ->limit(5)
        ->all();

        return $this->render('vista', [
            'equipo' => $equipo,
            'ultimosResultados' => $ultimosResultados,
            'proximosPartidos' => $proximosPartidos,
            'jugadoresDestacados' => $jugadoresDestacados,
            'estadisticas' => $estadisticas,
        ]);

    }
    
}
