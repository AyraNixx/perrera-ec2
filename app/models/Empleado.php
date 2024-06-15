<?php

namespace model;

use \utils\Utils;
use \PDO;
use \PDOException;
use \Exception;

require_once "Model.php";

class Empleado extends Model
{


    // --
    // -- MÉTODOS --------------------
    // --



    /**
     * Devuelve un registro de la tabla indicada
     * 
     * @param String email
     */
    public function user_found(String $email)
    {
        // Rodeamos el código en un try catch para controlar las excepciones
        try {
            // Query
            $query = "SELECT * FROM empleados WHERE correo = :correo LIMIT 1";
            // Preparamos la consulta para su ejecución
            $stm = $this->conBD->prepare($query);
            // Vinculamos los parámetros al nombre de la variable especificada
            $stm->bindParam(":correo", $email, PDO::PARAM_STR);
            // Ejecutamos la consulta
            $stm->execute();
            // Devolvemos resultado obtenido
            return $stm->fetch();
        } catch (PDOException $e) {
            // Guardamos el error en el log
            Utils::save_log_error("PDOException caught: " . $e->getMessage());
        } catch (Exception $e) {
            // Guardamos el error en el log
            Utils::save_log_error("Unexpected error caught: " . $e->getMessage());
        }

        return null;
    }




    /**
     * Inserta un nuevo empleado a la base de datos.
     * 
     * @param array Registro que queremos insertar.
     * 
     * @return mixed Devuelve true si se ha insertado correctamente y null si no se ha podido
     */
    public function insert(array $empleado)
    {
        try {
            $query = "INSERT INTO empleados (nombre, apellidos, NIF, fech_nac, direccion, ciudad, pais, codigo_postal, telf, correo, passwd, code, roles_id) 
            VALUES (:nombre, :apellidos, :NIF, :fech_nac, :direccion, :ciudad, :pais, :codigo_postal, :telf, :correo, :passwd, :code, :roles_id)";
    
            // Preparamos la query
            $stm = $this->conBD->prepare($query);
    
            $stm->bindParam(":nombre", $empleado["nombre"], PDO::PARAM_STR);
            $stm->bindParam(":apellidos", $empleado["apellidos"], PDO::PARAM_STR);
            $stm->bindParam(":NIF", $empleado["NIF"], PDO::PARAM_STR);
            $stm->bindParam(":fech_nac", $empleado["fech_nac"], PDO::PARAM_STR);
            $stm->bindParam(":direccion", $empleado["direccion"], PDO::PARAM_STR);
            $stm->bindParam(":ciudad", $empleado["ciudad"], PDO::PARAM_STR);
            $stm->bindParam(":pais", $empleado["pais"], PDO::PARAM_STR);
            $stm->bindParam(":codigo_postal", $empleado["codigo_postal"], PDO::PARAM_STR);
            $stm->bindParam(":telf", $empleado["telf"], PDO::PARAM_STR);
            $stm->bindParam(":correo", $empleado["correo"], PDO::PARAM_STR);
            $stm->bindParam(":passwd", $empleado["passwd"], PDO::PARAM_STR);
            $stm->bindParam(":code", $empleado["code"], PDO::PARAM_STR);
            $stm->bindParam(":roles_id", $empleado["roles_id"], PDO::PARAM_STR);
    
            // Ejecutamos la query      
            if($stm->execute()){
                $query = "SELECT id FROM empleados ORDER BY id DESC LIMIT 1";
                $stm = $this->conBD->prepare($query);
                $stm->execute();
    
                $id = $stm->fetch()['id']; // Guardamos id
                return $id;
            } else {
                return false;
            }
            // En caso de excepción, lo guardamos en el log
        } catch (PDOException $e) {
            // Guardamos el error en el log
            Utils::save_log_error("PDOException caught: " . $e->getMessage());
        } catch (Exception $e) {
            // Guardamos el error en el log
            Utils::save_log_error("Unexpected error caught: " . $e->getMessage());
        }

        return null;
    }

    /**
     * Obtiene el rol del empleado
     * 
     * @param String rol_id
     * @return String Rol del empleado
     * @author Paula Moreno Hermoso
     */
    public function get_rol(String $rol_id)
    {
        try
        {
            //Consulta
            $query = "SELECT rol FROM perrera.roles WHERE id = :rol_id";

            // Preparamos la query
            $stm = $this->conBD->prepare($query);

            // Vinculamos los parámetros
            $stm->bindParam(":rol_id", $rol_id, PDO::PARAM_STR);
            
            // Ejecutamos la query
            $stm->execute();
            // Devolvemos los resultados
            return $stm->fetch()["rol"];

        } catch (PDOException $e) {
            // Guardamos el error en el log
            Utils::save_log_error("PDOException caught: " . $e->getMessage());
        } catch (Exception $e) {
            // Guardamos el error en el log
            Utils::save_log_error("Unexpected error caught: " . $e->getMessage());
        }
        return null;
    }
}

// $empleado = new Empleado();
// var_dump($empleado->user_found($_SESSION['correo']));
// var_dump($empleado->get_all("empleados"));
// var_dump(password_hash('paula123',PASSWORD_DEFAULT));
// var_dump($empleado->insert(["nombre"=>"Prueba", "apellidos"=>"Apellido", "NIF"=>"12345678B", "correo" =>"thejokerjune@gmail.com", "passwd" => '$2y$10$yyYAn7DhMmkyArnf5a9jSOANF74Y/8k5kNbPEM34aTwGEPFXM3YMq', "salt" => "12385753","telf"=>"123456789", "roles_id"=>"001100879583489818908"]));