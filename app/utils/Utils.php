<?php


namespace utils;

use \PDO;
use \PDOException;
use \Exception;

class Utils
{


    /**
     * Inicia conexión con una base de datos.
     * @return PDO Devuelve una conexión PDO
     */
    public static function connectBD()
    {
        require_once "global.php";
        // Definimos conBD
        $conBD = null;

        //Englobamos el codigo en un try/catch para que en caso de error de conexión
        //se lance un objeto PDOException
        try {
            //Para establecer una conexion, creamos una instancia de la clase PDO.
            //Se le pasarán como argumentos el host, el nombre de la base de datos, 
            //el usuario y su contraseña en caso de que tuviese una.
            //En mi caso, no he especificado contrasenia porque no tengo.
            //Si usase contraseá, la añadiría después de $DB_USER
            return $conBD = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_SCHEMA, DB_USER, DB_PASSWD);
            
        } catch (PDOException $e) {
            //Llamamos a la funcion save_log_error de la misma clase
            self::save_log_error($e->getMessage());
            //Devolvemos $conBD, que será null si no se pudo realizar la conexion 
            //correctamente.
            return $conBD;
            //Alias de exit(), finaliza el script. 
            die();
        } catch (Exception $e) {
            //Llamamos a la funcion save_log_error de la misma clas
            self::save_log_error($e->getMessage());
            //Devolvemos $conBD, que será null si no se pudo realizar la conexion 
            //correctamente.
            return $conBD;
            //Alias de exit(), finaliza el script. 
            exit();
        }
    }









    /***********************************************************************
     *                                                                     *
     *                         EXCEPCIONES - LOG                           *
     *                                                                     *
     ***********************************************************************/

    /**
     * Guarda las excepciones en un log, indicando la fecha y hora en el que se produjo
     */
    public static function save_log_error($error, $path = "../logs/log.log")
    {
        //Utilizamos error_log que envia un mensaje de error según lo indicado
        //Le pasamos el error (que pasamos con print_r para que se vea más claro)
        //Indicamos que el tipo de registro es 3, lo que indica que el mensaje
        //se adjuntará al archivo de destino
        //Y por último la ruta del archivo
        //Utilizamos date para que saque la fecha y hora actual
        error_log(print_r(date("Y-m-d H:i:s") . ": " . $error . "\xA", true), 3, $path);
    }
    







    /***********************************************************************
     *                                                                     *
     *                         CODE ACTIVACIÓN O SALT                      *
     *                                                                     *
     ***********************************************************************/


}
