<?php


namespace model;

use \model\Model;
use \utils\Utils;
use \PDO;
use \PDOException;
use \Exception;

require_once "Model.php";

class AsignarTarea extends Model
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
            $query = "INSERT INTO tareas_asignadas 
                  (asunto, estado_asignacion, prioridad, fecha_asignacion, fecha_finalizacion, jaulas_id, empleados_id, tareas_id1, voluntarios_id) 
                  VALUES (:asunto, :estado_asignacion, :prioridad, :fecha_asignacion, :fecha_finalizacion, :jaulas_id, :empleados_id, :tareas_id1, :voluntarios_id)";

            // Preparamos la query
            $stm = $this->conBD->prepare($query);

            // Asignamos los valores a los parámetros
            $stm->bindParam(":asunto", $tarea["asunto"], PDO::PARAM_STR);
            $stm->bindParam(":estado_asignacion", $tarea["estado_asignacion"], PDO::PARAM_INT);
            $stm->bindParam(":prioridad", $tarea["prioridad"], PDO::PARAM_STR);
            $stm->bindParam(":fecha_asignacion", $tarea["fecha_asignacion"], PDO::PARAM_STR);
            $stm->bindParam(":fecha_finalizacion", $tarea["fecha_finalizacion"], PDO::PARAM_STR);
            $stm->bindParam(":jaulas_id", $tarea["jaulas_id"], PDO::PARAM_STR);
            $stm->bindParam(":empleados_id", $tarea["empleados_id"], PDO::PARAM_STR);
            $stm->bindParam(":tareas_id1", $tarea["tareas_id1"], PDO::PARAM_STR);
            $stm->bindParam(":voluntarios_id", $tarea["voluntarios_id"], PDO::PARAM_STR);

            // Ejecutamos la query
            if ($stm->execute()) {
                return $this->conBD->lastInsertId();
            }
            return false;
        } catch (PDOException $e) {
            // Guardamos el error en el log
            Utils::save_log_error("PDOException caught: " . $e->getMessage());
        } catch (Exception $e) {
            // Guardamos el error en el log
            Utils::save_log_error("Unexpected error caught: " . $e->getMessage());
        }

        return null;
    }

    public function pagination_tareas_asignadas(String $ord, string $field, int $page, int $amount)
    {
        try {
            $offset = ($page - 1) * $amount;
            $query = "SELECT ta.id, ta.asunto, ta.estado_asignacion, ta.prioridad, ta.fecha_asignacion, ta.fecha_finalizacion, ta.empleados_id, ta.voluntarios_id,
                     j.ubicacion AS ubicacion, j.tamanio AS tamanio, j.ocupada AS ocupada, j.estado_comida AS estado_comida, 
                     j.estado_limpieza AS estado_limpieza, CONCAT(e.nombre, ' ', e.apellidos) AS nombre_empleado, 
                     CONCAT(v.nombre, ' ', v.apellidos) AS nombre_voluntario, t.asunto AS tarea_asunto, 
                     t.descripcion AS tarea_descripcion, es.nombre AS especie_nombre 
              FROM tareas_asignadas ta 
              LEFT JOIN jaulas j ON ta.jaulas_id = j.id 
              LEFT JOIN empleados e ON ta.empleados_id = e.id 
              LEFT JOIN voluntarios v ON ta.voluntarios_id = v.id 
              LEFT JOIN tareas t ON ta.tareas_id1 = t.id 
              LEFT JOIN especies es ON j.especies_id = es.id 
              WHERE ta.disponible = 1 
              ORDER BY $field $ord 
              LIMIT :amount OFFSET :offset";

            $stm = $this->conBD->prepare($query);

            $stm->bindParam(":amount", $amount, PDO::PARAM_INT);
            $stm->bindParam(":offset", $offset, PDO::PARAM_INT);

            $stm->execute();

            return $stm->fetchAll();
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


// $tarea = new Tarea();
// var_dump($tarea->get_all("tareas"));
// var_dump($tarea->insert(["asunto" => "Prueba", "descripcion" => "-", "fecha_finalizacion" => null, "estado" => "1"]));
