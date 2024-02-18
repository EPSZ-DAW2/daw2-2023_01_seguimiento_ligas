<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Exception;
use yii\db\Transaction;
use yii\helpers\FileHelper;

class BaseDatos extends Model
{
 

    public static function obtenerCopiasSeguridad()
    {
        $dir = Yii::getAlias('@app/copiaSeguridad/');
        $archivos = [];
        if (is_dir($dir)) {
            $archivos = array_diff(scandir($dir), array('..', '.'));
        }
        return $archivos;
    }
}
