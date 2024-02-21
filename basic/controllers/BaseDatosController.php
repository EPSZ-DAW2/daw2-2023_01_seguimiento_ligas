<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\BaseDatos;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;
use yii\db\Transaction;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class BaseDatosController extends Controller
{

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    
 
    public function actionIndex()
    {
        $error = "";
        $copias = [];
        $archivos = [];

        $archivos = BaseDatos::obtenerCopiasSeguridad();

        if (Yii::$app->request->isPost) {
            if ($archivoZip = Yii::$app->request->post('archivoZip')) {
                
            } elseif ($nombreArchivo = Yii::$app->request->post('nombreArchivo')) {
            
                Yii::$app->session->setFlash('error', 'Operación no válida.');
            }
        }

        return $this->render('index', [
            'error' => $error,
            'copias' => $copias,
            'archivos' => $archivos, 
        ]);
    }

/*
 * Restaura un fichero zip de los que almacenan la copia de seguridad
 */
public function actionRestaurarcopia()
{
    $error = "";
    $archivos = [];
    
    $rutaDir = Yii::getAlias('@app') . '/copiaSeguridad';
    $indice = Yii::$app->request->post('archivoZip');
    $archivos = BaseDatos::obtenerCopiasSeguridad();
    
    if ($indice !== null && array_key_exists($indice, $archivos)) {
        $nombreArchivo = $archivos[$indice];
        $rutaFichero = $rutaDir . '/' . $nombreArchivo;
        
        if (file_exists($rutaFichero)) {
            $tempDir = sys_get_temp_dir() . '/' . uniqid('temp_', true);
            mkdir($tempDir);
            
            $zip = new \ZipArchive;
            if ($zip->open($rutaFichero) === TRUE) {
                $zip->extractTo($tempDir);
                $zip->close();
                
                $sqlFile = $tempDir . '/ArosInsider.sql';
                if (file_exists($sqlFile)) {
                    $sqlContent = file_get_contents($sqlFile);
                    $connection = Yii::$app->db;
                    $transaction = $connection->beginTransaction();
                    try {
                        $connection->createCommand($sqlContent)->execute();
                        $transaction->commit();
                        $error = "Copia de seguridad restaurada correctamente";
                    } catch (\Exception $e) {
                        $transaction->rollBack();
                        $error = "Error al restaurar la copia de seguridad: " . $e->getMessage();
                    }
                } else {
                    $error = "No se encontró el archivo de respaldo de la base de datos en la copia de seguridad.";
                }
                
                $this->removeDir($tempDir);
            } else {
                $error = "No se pudo restaurar la copia de seguridad";
            }
        } else {
            $error = "El archivo $nombreArchivo no existe";
        }
    } else {
        $error = "Índice de archivo no válido";
    }

    $copias = BaseDatos::obtenerCopiasSeguridad();
    
    // Renderizar la vista con los resultados
    return $this->render('index', [
        'error' => $error,
        'copias' => $copias,
        'archivos' => $archivos, 
    ]);
}



private function removeDir($dir) {
    $files = array_diff(scandir($dir), array('.', '..'));
    foreach ($files as $file) {
        (is_dir("$dir/$file")) ? $this->removeDir("$dir/$file") : unlink("$dir/$file");
    }
    return rmdir($dir);
}


    
    
    
    public function actionCopiaseguridad()
    {
        $error = "";
        $archivos = [];
        
 
        $backupDir = Yii::getAlias('@app') . '/copiaSeguridad';
  
        $Directorio = Yii::getAlias('@app') . '/web/images';

        $backupName = 'ArosInsider_' . date('Y-m-d_H-i-s') . '.zip';
        $backupPath = $backupDir . '/' . $backupName;
        
    
        $zip = new \ZipArchive();
        if ($zip->open($backupPath, \ZipArchive::CREATE) === TRUE) {
            $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($Directorio), \RecursiveIteratorIterator::SELF_FIRST);
            $zip->addEmptyDir('images');
            foreach ($iterator as $file) {
               
                if ($file->isFile() && strpos($file->getPathname(), $Directorio) !== false) {
                   
                    $nombre = 'images/' . $file->getFilename();
                    $zip->addFile($file->getPathname(), $nombre);
                }
            }
            $db = Yii::$app->db;
            $tablas = $db->schema->getTableNames();
            $backupFile = 'ArosInsider' . '.sql';
            $handle = fopen($backupDir . '/' . $backupFile, 'w');

            fwrite($handle, "SET FOREIGN_KEY_CHECKS = 0 ;\n");
            $sql = 'SET FOREIGN_KEY_CHECKS = 0;';
            $db->createCommand($sql)->execute();
            foreach ($tablas as $tabla) {
                fwrite($handle, "DELETE FROM `$tabla`;\n");
            
               
            
                
                $sql = 'SHOW CREATE TABLE `' . $tabla . '`';
                $CrearTabla = $db->createCommand($sql)->queryOne();
                if ($CrearTabla) {
                    
                    $query = new \yii\db\Query;
                    $query->select('*')->from($tabla);
                    $result = $query->all();
                    if (!empty($result)) {
                        $keys = array_keys($result[0]);
                        foreach ($result as $row) {
                            $values = array_map('addslashes', $row);
                            fwrite($handle, "INSERT INTO `$tabla` (`" . implode('`,`', $keys) . "`) VALUES ('" . implode("','", $values) . "');\n");
                        }
                    }
                }
            
               
                
            }
            fwrite($handle, "SET FOREIGN_KEY_CHECKS = 1 ;\n");
                $db->createCommand($sql)->execute();
            fclose($handle);
            $zip->addFile($backupDir . '/' . $backupFile, $backupFile);
            $zip->close();
            unlink($backupDir . '/' . $backupFile);
        } else {
            $error = 'Error al crear el archivo ZIP.';
        }
        
   
        $copias =BaseDatos::obtenerCopiasSeguridad();
        
        return $this->redirect(['index', 'error' => $error, 'copias' => $copias]);
    }
    

public function actionEliminarcopia()
{
    $error = "";
    $archivos = [];
    

    $rutaDir = Yii::getAlias('@app') . '/copiaSeguridad';
    
  
    $indice = Yii::$app->request->post('nombreArchivo');
    
   
    $archivos = BaseDatos::obtenerCopiasSeguridad();
    
  
    if ($indice !== null && array_key_exists($indice, $archivos)) {
     
        $nombreArchivo = $archivos[$indice];
       
        $rutaFichero = $rutaDir . '/' . $nombreArchivo;
        
        if (file_exists($rutaFichero)) {
            if (unlink($rutaFichero)) {
                $error = "El archivo $nombreArchivo ha sido eliminado correctamente";
            } else {
                $error = "No se pudo eliminar el archivo $nombreArchivo";
            }
        } else {
            $error = "El archivo $nombreArchivo no existe";
        }
    } else {
        $error = "Índice de archivo no válido";
    }

  
    $copias = BaseDatos::obtenerCopiasSeguridad();
    
   
    return $this->render('index', [
        'error' => $error,
        'copias' => $copias,
        'archivos' => $archivos, 
    ]);
}


}
