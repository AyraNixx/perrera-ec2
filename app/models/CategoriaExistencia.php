<?php

use \model\Model;
use \utils\Utils;

require_once "Model.php";

class CategoriaExistencia extends Model
{


    // --
    // -- MÉTODOS --------------------
    // --




    /**
     * Inserta una nueva categoria de existencia a la base de datos.
     * 
     * @param array Registro que queremos insertar.
     * 
     * @return mixed Devuelve true si se ha insertado correctamente y null si no se ha podido
     */
    public function insert(array $categoria)
    {
        try {
            // Consulta
            $query = "INSERT INTO categorias_existencia (nombre, descripcion) VALUE(:nombre, :descripcion)";

            //Preparamos la query
            $stm = $this->conBD->prepare($query);

            $stm->bindParam(":nombre", $categoria["nombre"], PDO::PARAM_STR);
            $stm->bindParam(":descripcion", $categoria["descripcion"], PDO::PARAM_STR);

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


// $nombre = new CategoriaExistencia();
// var_dump($nombre->insert(["nombre"=>"pepe", "descripcion" => "-"]));
// var_dump($nombre->get_all("especies"));