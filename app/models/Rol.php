<?php

use \model\Model;
use \utils\Utils;

require_once "Model.php";

class Rol extends Model
{


    // --
    // -- MÉTODOS --------------------
    // --




    /**
     * Inserta un nuevo rol a la base de datos.
     * 
     * @param array Registro que queremos insertar.
     * 
     * @return mixed Devuelve true si se ha insertado correctamente y null si no se ha podido
     */
    public function insert(array $rol)
    {
        try {
            // Consulta
            $query = "INSERT INTO roles (rol, descripcion) VALUE(:rol, :descripcion)";

            //Preparamos la query
            $stm = $this->conBD->prepare($query);

            $stm->bindParam(":rol", $rol["rol"], PDO::PARAM_STR);
            $stm->bindParam(":descripcion", $rol["descripcion"], PDO::PARAM_STR);

            // Ejecutamos la query           
            // Devolvemos resultados
            return $stm->execute();
            // En caso de excepción, lo guardamos en el log
        } catch (PDOException $e) {
            echo "todo mal";
            // Guardamos el error en el log
            Utils::save_log_error("PDOException caught: " . $e->getMessage());
        } catch (Exception $e) {
            echo "todo mal";
            // Guardamos el error en el log
            Utils::save_log_error("Unexpected error caught: " . $e->getMessage());
        }

        return null;
    }
}


// $rol = new Rol();
// var_dump($rol->insert(["rol"=>"pepe", "descripcion" => "-"]));
// var_dump($rol->get_all("roles"));