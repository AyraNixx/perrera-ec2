<?php

namespace model;

use \model\Model;
use \utils\Utils;
use \PDO;
use \PDOException;
use \Exception;
use utils\Constants;

require_once "Model.php";

class Voluntario extends Model
{


    // --
    // -- MÉTODOS --------------------
    // --




    /**
     * Inserta un nuevo voluntario a la base de datos.
     * 
     * @param array Registro que queremos insertar.
     * 
     * @return mixed Devuelve true si se ha insertado correctamente y null si no se ha podido
     */
    public function insert(array $voluntario)
    {
        try {
            // Consulta
            $query = "INSERT INTO voluntarios (nombre, apellidos, fech_nac, NIF, correo, telf, disponibilidad, experiencia_previa, 
            comentarios, fecha_inicio, fecha_fin, informacion_relevante) 
            VALUES (:nombre, :apellidos, :fech_nac, :NIF, :correo, :telf, :disponibilidad, :experiencia_previa, :comentarios, 
            :fecha_inicio, :fecha_fin, :informacion_relevante)";

            //Preparamos la query
            $stm = $this->conBD->prepare($query);

            // Vinculamos los parámetros
            $stm->bindParam(":nombre", $voluntario["nombre"], PDO::PARAM_STR);
            $stm->bindParam(":apellidos", $voluntario["apellidos"], PDO::PARAM_STR);
            $stm->bindParam(":fech_nac", $voluntario["fech_nac"], PDO::PARAM_STR);
            $stm->bindParam(":NIF", $voluntario["NIF"], PDO::PARAM_STR);
            $stm->bindParam(":correo", $voluntario["correo"], PDO::PARAM_STR);
            $stm->bindParam(":telf", $voluntario["telf"], PDO::PARAM_STR);
            $stm->bindParam(":disponibilidad", $voluntario["disponibilidad"], PDO::PARAM_INT);
            $stm->bindParam(":experiencia_previa", $voluntario["experiencia_previa"], PDO::PARAM_INT);
            $stm->bindParam(":comentarios", $voluntario["comentarios"], PDO::PARAM_STR);
            $stm->bindParam(":fecha_inicio", $voluntario["fecha_inicio"], PDO::PARAM_STR);
            $stm->bindParam(":fecha_fin", $voluntario["fecha_fin"], PDO::PARAM_STR);
            $stm->bindParam(":informacion_relevante", $voluntario["informacion_relevante"], PDO::PARAM_STR);
            // Ejecutamos la query           

            // Devolvemos resultados 
            if ($stm->execute()) {
                $query = "SELECT id FROM perrera.voluntarios ORDER BY id DESC LIMIT 1";
                $stm = $this->conBD->prepare($query);
                $stm->execute();
                return $stm->fetch()['id'];
            } else {
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

    
    public function soft_delete_voluntario(String $voluntario_id)
    {
        try {
            $this->conBD->beginTransaction(); // esto es muy chulo porque se supone que ejecuta todo y si algo falla no se realizan 
            $result = $this->queryParam(Constants::SOFT_DEL_VOLUNTARIO_VOLUNTARIO, ['id' => $voluntario_id]);
            $result = $this->queryParam(Constants::SOFT_DEL_VOLUNTARIO_TAREAS_ASIGNADAS, ['id' => $voluntario_id]);
            $this->conBD->commit();

            return $result;

        } catch (PDOException $e) {
            // Guardamos el error en el log
            Utils::save_log_error("PDOException caught: " . $e->getMessage());
        } catch (Exception $e) {
            // Guardamos el error en el log
            Utils::save_log_error("Unexpected error caught: " . $e->getMessage());
        }
        return false;
    }

    public function undelete_voluntario(String $voluntario_id)
    {
        try {
            $this->conBD->beginTransaction(); // esto es muy chulo porque se supone que ejecuta todo y si algo falla no se realizan 
            $result = $this->queryParam(Constants::UNDEL_VOLUNTARIO_VOLUNTARIO, ['id' => $voluntario_id]);
            $result = $this->queryParam(Constants::UNDEL_VOLUNTARIO_TAREA_ASIGNADA, ['id' => $voluntario_id]);
            $this->conBD->commit();

            return $result;

        } catch (PDOException $e) {
            // Guardamos el error en el log
            Utils::save_log_error("PDOException caught: " . $e->getMessage());
        } catch (Exception $e) {
            // Guardamos el error en el log
            Utils::save_log_error("Unexpected error caught: " . $e->getMessage());
        }
        return false;
    }
}

// $voluntario = new Voluntario();
// var_dump($voluntario->get_all("voluntarios"));
// var_dump($voluntario->insert(["nombre"=>"Prueba", "apellidos"=>"Apellido", "fech_nac"=>"1999-04-30", "NIF"=>"12345678B", "correo" =>"correo@ejemplo.com","telf"=>"123456789", "experiencia_previa"=>"1", "disponibilidad"=>"0", "infromacion_relevante"=>"-"]));