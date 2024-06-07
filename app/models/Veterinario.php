<?php

namespace model;

use \model\Model;
use \utils\Utils;
use \PDO;
use \PDOException;
use \Exception;

require_once "Model.php";

class Veterinario extends Model
{


    // --
    // -- MÉTODOS --------------------
    // --




    /**
     * Inserta un nuevo veterinario a la base de datos.
     * 
     * @param array Registro que queremos insertar.
     * 
     * @return mixed Devuelve true si se ha insertado correctamente y null si no se ha podido
     */
    public function insert(array $veterinario)
    {
        try {
            // Consulta
            $query = "INSERT INTO veterinarios (nombre, apellidos, correo, telf, 
            direccion, especialidad, nombre_clinica, direccion_clinica, telf_clinica,
            correo_clinica, hora_apertura, hora_cierre, otra_informacion) VALUE(:nombre, :apellidos, :correo, :telf, 
            :direccion, :especialidad, :nombre_clinica, :direccion_clinica, :telf_clinica,
            :correo_clinica, :hora_apertura, :hora_cierre, :otra_informacion)";

            //Preparamos la query
            $stm = $this->conBD->prepare($query);

            $stm->bindParam(":nombre", $veterinario["nombre"], PDO::PARAM_STR);
            $stm->bindParam(":apellidos", $veterinario["apellidos"], PDO::PARAM_STR);
            $stm->bindParam(":correo", $veterinario["correo"], PDO::PARAM_STR);
            $stm->bindParam(":telf", $veterinario["telf"], PDO::PARAM_STR);
            $stm->bindParam(":direccion", $veterinario["direccion"], PDO::PARAM_STR);
            $stm->bindParam(":especialidad", $veterinario["especialidad"], PDO::PARAM_STR);
            $stm->bindParam(":nombre_clinica", $veterinario["nombre_clinica"], PDO::PARAM_STR);
            $stm->bindParam(":direccion_clinica", $veterinario["direccion_clinica"], PDO::PARAM_STR);
            $stm->bindParam(":telf_clinica", $veterinario["telf_clinica"], PDO::PARAM_STR);
            $stm->bindParam(":correo_clinica", $veterinario["correo_clinica"], PDO::PARAM_STR);
            $stm->bindParam(":hora_apertura", $veterinario["hora_apertura"], PDO::PARAM_STR);
            $stm->bindParam(":hora_cierre", $veterinario["hora_cierre"], PDO::PARAM_STR);
            $stm->bindParam(":otra_informacion", $veterinario["otra_informacion"], PDO::PARAM_STR);
            
            // Ejecutamos la query           
            // Devolvemos resultados 
            if($stm->execute()){
                $query = "SELECT id FROM perrera.veterinarios ORDER BY id DESC LIMIT 1";
                $stm = $this->conBD->prepare($query);
                $stm->execute();
                return $stm->fetch()['id'];
            }else{
                return false;
            }
        } catch (PDOException $e) {
            echo "todo mal";
            // Guardamos el error en el log
            Utils::save_log_error("PDOException caught: " . $e->getMessage());
        } catch (Exception $e) {
            echo "todo mal";
            // Guardamos el error en el log
            Utils::save_log_error("Unexpected error caught: " . $e->getMessage());
        }
    }
}

// $veterinario = new Veterinario();
// var_dump($veterinario->get_all("veterinarios"));
// var_dump($veterinario->insert(["nombre"=>"Prueba", "apellidos"=>"Apellido", "correo" =>"correo@ejemplo.com","telf"=>"123456789", "horarios"=>"", "otra_informacion"=>"0"]));