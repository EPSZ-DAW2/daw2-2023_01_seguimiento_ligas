<?php

namespace app\controllers;

use Yii;
use app\models\Log;
use app\models\LogSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class LogController extends Controller
{
    
    public function actionIndex()
    {
        $logFiles = glob(Yii::getAlias('@runtime/logs/*.log'));

        $logs = [];
        foreach ($logFiles as $file) {
            $logs[] = [
                'name' => basename($file),
                'size' => filesize($file),
                'modified' => filemtime($file),
            ];
        }

        return $this->render('index', [
            'logs' => $logs,
        ]);
    }

    public function actionDescarga($file)
    {
        $logPath = \Yii::getAlias('@runtime/logs');
        $filePath = $logPath . '/' . $file;

        if (file_exists($filePath)) {
            \Yii::$app->response->sendFile($filePath);
        } else {
            throw new \yii\web\NotFoundHttpException('El archivo no existe.');
        }
    }

    public function actionBorrar($file)
    {
        $logPath = \Yii::getAlias('@runtime/logs');
        $filePath = $logPath . '/' . $file;

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        return $this->redirect(['log']);
    }



}