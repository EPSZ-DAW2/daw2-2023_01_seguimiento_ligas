<?php
namespace app\models;

use Yii;
use yii\base\Model;

class BaseDatos extends Model
{
    /**
     * Copia de seguridad de toda la base de datos.
     *
     * @param string $rutaBackup Ruta donde se guardará la copia de seguridad.
     * @return bool Si la copia de seguridad se realizó con éxito.
     */
    public static function hacerCopiaSeguridad($rutaBackup)
    {
        try {
            // Obtener los detalles de conexión de la aplicación Yii
            $db = Yii::$app->getDb();

            // Construir el comando de copia de seguridad según el tipo de base de datos (en este caso, MySQL)
            $dsnParts = parse_url($db->dsn);
            $databaseName = ltrim($dsnParts['path'], '/');
            $comando = 'C:\xampp2\mysql\bin\mysqldump.exe -u root -p daw2_2023_01_seguimiento_ligas_deportivas';
            
            

            // Registra el comando en los logs
            Yii::info("Ejecutando el comando de copia de seguridad: $comando", __METHOD__);

            // Ejecutar el comando
            exec($comando, $output, $returnVar);

            // Registra la salida del comando en los logs
            Yii::info("Salida del comando de copia de seguridad: " . implode(PHP_EOL, $output), __METHOD__);

            // Verificar si la copia de seguridad fue exitosa
            if ($returnVar === 0) {
                Yii::info("Copia de seguridad realizada con éxito.", __METHOD__);
                return true;
            } else {
                // Imprimir detalles del error
                Yii::error("Error en la ejecución de mysqldump: " . implode(PHP_EOL, $output), __METHOD__);
                Yii::error("Código de retorno: $returnVar", __METHOD__);
                return false;
            }
        } catch (\Exception $e) {
            // Capturar cualquier excepción y registrarla
            Yii::error("Excepción al realizar la copia de seguridad: " . $e->getMessage(), __METHOD__);
            return false;
        }
    }
}
?>