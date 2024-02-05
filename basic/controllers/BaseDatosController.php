<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\BaseDatos;
use yii\web\Response;

class BaseDatosController extends Controller
{
    /**
     * Acción para realizar la copia de seguridad.
     */
    public function actionBackup()
    {
        // Ruta donde se guardará la copia de seguridad
        $rutaBackup = Yii::getAlias('@app/web/backups/') . 'backup.sql';

        // Realizar la copia de seguridad
        try {
            if (BaseDatos::hacerCopiaSeguridad($rutaBackup)) {
                Yii::$app->session->setFlash('success', 'Copia de seguridad realizada con éxito.');
            } else {
                Yii::$app->session->setFlash('error', 'Error al realizar la copia de seguridad.');
            }
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', 'Excepción al realizar la copia de seguridad: ' . $e->getMessage());
        }

        return $this->redirect(['index']);
    }

    /**
     * Acción para mostrar la vista con botón para realizar la copia de seguridad.
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
