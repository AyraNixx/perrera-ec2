<?php


namespace model;

use \model\Model;
use \utils\Utils;
use \PDO;
use \PDOException;
use \Exception;

require_once "Model.php";

class Tarea extends Model
{
    // --
    // -- MÉTODOS --------------------
    // --

    /**
     * Inserta una nueva tarea a la base de datos.
     * 
     * @param array Registro que queremos insertar.
     * 
     * @return mixed Devuelve true si se ha insertado correctamente y null si no se ha podido
     */
    public function insert(array $tarea)
    {
        try {
            // Consulta
            $query = "INSERT INTO tareas (asunto, descripcion) VALUE(:asunto, :descripcion)";

            //Preparamos la query
            $stm = $this->conBD->prepare($query);

            $stm->bindParam(":asunto", $tarea["asunto"], PDO::PARAM_STR);
            $stm->bindParam(":descripcion", $tarea["descripcion"], PDO::PARAM_STR);

            // Ejecutamos la query           
            // Devolvemos resultados            
            if($stm->execute()){
                $query = "SELECT id FROM perrera.tareas ORDER BY id DESC LIMIT 1";
                $stm = $this->conBD->prepare($query);
                $stm->execute();
                return $stm->fetch()['id'];
            }else{
                return false;
            }
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


// $tarea = new Tarea();
// var_dump($tarea->get_all("tareas"));
// var_dump($tarea->insert(["asunto" => "Prueba", "descripcion" => "-", "fecha_finalizacion" => null, "estado" => "1"]));
