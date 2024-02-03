<?php

namespace app\controllers;

use Yii;
use app\models\Comentarios;
use app\models\PartidosJornada;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ComentariosController extends Controller
{
    public function actionView($partidoID = null)
    {
        // Filtrar comentarios si se proporciona el partidoID
        $query = Comentarios::find();
        if ($partidoID !== null) {
            $query->where(['id_partido' => $partidoID]);
        }

        $comentarios = $query->all();

        return $this->render('view', [
            'comentarios' => $comentarios,
        ]);
    }

    protected function findModel($id)
    {
        try {
            $model = Comentarios::findOne($id);
            if ($model !== null) {
                return $model;
            }
        } catch (\Throwable $e) {
            Yii::$app->session->setFlash('error', 'Error al encontrar el comentario.');
        }

        throw new NotFoundHttpException('El comentario solicitado no existe.');
    }
}
?>