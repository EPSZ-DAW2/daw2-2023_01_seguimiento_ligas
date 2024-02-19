<?php
namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\FileHelper;
use yii\helpers\Url;
/**
 * Summary of Log
 */
class Log extends \yii\db\ActiveRecord
{


    // Acción para descargar un archivo LOG
    public function actionDownload($filename)
    {
        $file = Yii::getAlias('@app/runtime/logs/' . $filename);
        if (file_exists($file)) {
            Yii::$app->response->sendFile($file);
        } else {
            throw new NotFoundHttpException('The requested file does not exist.');
        }
    }

    // Acción para eliminar un archivo LOG
    public function actionDelete($filename)
    {
        $file = Yii::getAlias('@app/runtime/logs/' . $filename);
        if (file_exists($file)) {
            unlink($file);
            Yii::$app->session->setFlash('success', 'The log file has been deleted.');
        } else {
            Yii::$app->session->setFlash('error', 'The log file could not be deleted because it does not exist.');
        }
        return $this->redirect(['index']);
    }
}