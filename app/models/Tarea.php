<?php

use \model\Model;
use \utils\Utils;

require_once "Model.php";

/*



    MIRAR LO DE FECHA FINALIZACION Y FECHA DE CREACION PORQUE PODEMOS USAR NOW() PARA LA 
    FECHA Y HORA EXACTA EN LA QUE SE CREA PERO PARA LA FECHA DE FINALIZACIÓN TENDRÍA QUE
    PENSAR CUANTO QUIERO QUE ESTÉN ACTIVAS LAS TAREAS

    También sería interesante ver si puedo lograr que ciertas tareas se pongan todos los días, 
    por ejemplo, la de aliminat a los animales




*/
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
            $query = "INSERT INTO tareas (nombre, descripcion, fecha_creacion, fecha_finalizacion, estado) VALUE(:nombre, :descripcion, NOW(), :fecha_finalizacion, :estado)";

            //Preparamos la query
            $stm = $this->conBD->prepare($query);

            $stm->bindParam(":nombre", $tarea["nombre"], PDO::PARAM_STR);
            $stm->bindParam(":descripcion", $tarea["descripcion"], PDO::PARAM_STR);
            $stm->bindParam(":fecha_finalizacion", $tarea["fecha_finalizacion"], PDO::PARAM_STR);
            $stm->bindParam(":estado", $tarea["estado"], PDO::PARAM_INT);

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


// $tarea = new Tarea();
// var_dump($tarea->get_all("tareas"));
// var_dump($tarea->insert(["nombre" => "Prueba", "descripcion" => "-", "fecha_finalizacion" => null, "estado" => "1"]));
