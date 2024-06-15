<?php

use \model\Model;
use \utils\Utils;

require_once "Model.php";

class Existencia extends Model
{


    // --
    // -- MÉTODOS --------------------
    // --




    /**
     * Inserta una nueva existencia a la base de datos.
     * 
     * @param array Registro que queremos insertar.
     * 
     * @return mixed Devuelve true si se ha insertado correctamente y null si no se ha podido
     */
    public function insert(array $existencia)
    {
        try {
            // Consulta
            $query = "INSERT INTO existencias (nombre, descripcion, cantidad, precio_unidad, categorias_existencia_id) VALUE(:nombre, :descripcion, :cantidad, :precio_unidad, :categorias_existencia_id)";

            //Preparamos la query
            $stm = $this->conBD->prepare($query);

            $stm->bindParam(":nombre", $existencia["nombre"], PDO::PARAM_STR);
            $stm->bindParam(":descripcion", $existencia["descripcion"], PDO::PARAM_STR);
            $stm->bindParam(":cantidad", $existencia["cantidad"], PDO::PARAM_INT);
            $stm->bindParam(":precio_unidad", $existencia["precio_unidad"], PDO::PARAM_STR);           
            $stm->bindParam(":categorias_existencia_id", $existencia["categorias_existencia_id"], PDO::PARAM_INT);

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


// $nombre = new Existencia();
// var_dump($nombre->insert(["nombre"=>"pepe", "descripcion" => "-", "cantidad" => "12", "precio_unidad" => "20.50", "categorias_existencia_id" => "1"]));
// var_dump($nombre->get_all("especies"));