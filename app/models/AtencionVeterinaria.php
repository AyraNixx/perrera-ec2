<?php


namespace model;

use \model\Model;
use \utils\Utils;
use \PDO;
use \PDOException;
use \Exception;

require_once "Model.php";

class AtencionVeterinaria extends Model
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
    public function insert(array $atencion)
    {
        var_dump($atencion);
        try {
            $query = "INSERT INTO animales_atendidos_veterinarios 
                      (animales_id, veterinarios_id, motivo, fecha_atencion, diagnostico, procedimientos, medicamentos, comentarios, coste) 
                      VALUES (:animales_id, :veterinarios_id, :motivo, :fecha_atencion, :diagnostico, :procedimientos, :medicamentos, :comentarios, :coste)";

            $stm = $this->conBD->prepare($query);

            // Asignar los valores a los parámetros
            $stm->bindParam(":animales_id", $atencion["animales_id"], PDO::PARAM_STR);
            $stm->bindParam(":veterinarios_id", $atencion["veterinarios_id"], PDO::PARAM_STR);
            $stm->bindParam(":motivo", $atencion["motivo"], PDO::PARAM_STR);
            $stm->bindParam(":fecha_atencion", $atencion["fecha_atencion"], PDO::PARAM_STR);
            $stm->bindParam(":diagnostico", $atencion["diagnostico"], PDO::PARAM_STR);
            $stm->bindParam(":procedimientos", $atencion["procedimientos"], PDO::PARAM_STR);
            $stm->bindParam(":medicamentos", $atencion["medicamentos"], PDO::PARAM_STR);
            $stm->bindParam(":comentarios", $atencion["comentarios"], PDO::PARAM_STR);
            $stm->bindParam(":coste", $atencion["coste"], PDO::PARAM_STR);

            // Ejecutar la consulta
            if ($stm->execute()) {
                return $this->conBD->lastInsertId();
            }
            return false;
        } catch (PDOException $e) {
            // Guardar el error en el log
            Utils::save_log_error("PDOException caught: " . $e->getMessage());
        } catch (Exception $e) {
            // Guardar el error en el log
            Utils::save_log_error("Unexpected error caught: " . $e->getMessage());
        }

        return false;
    }

    public function pagination_atencion_veterinaria(String $ord, string $field, int $page, int $amount)
    {
        try {
            $offset = ($page - 1) * $amount;
            $query = "SELECT aav.id, aav.animales_id, aav.veterinarios_id, aav.motivo, aav.fecha_atencion, aav.diagnostico, 
            aav.procedimientos, aav.medicamentos, aav.comentarios, aav.coste, aav.disponible,
            a.nombre AS nombre_animal, a.especies_id, e.nombre AS nombre_especie, a.tamanio, a.genero, a.peso,
            v.nombre AS nombre_veterinario, v.apellidos AS apellidos_veterinario, v.correo AS correo_veterinario,
            v.telf AS telf_veterinario, v.nombre_clinica, v.telf_clinica, v.correo_clinica,
            j.ubicacion AS ubicacion_jaula
            FROM animales_atendidos_veterinarios aav
            LEFT JOIN animales a ON aav.animales_id = a.id
            LEFT JOIN especies e ON a.especies_id = e.id
            LEFT JOIN veterinarios v ON aav.veterinarios_id = v.id
            LEFT JOIN jaulas j ON a.jaulas_id = j.id
            WHERE aav.disponible = 1
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
