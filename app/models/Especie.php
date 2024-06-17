<?php

namespace model;

use \model\Model;
use \utils\Utils;
use \PDO;
use \PDOException;
use \Exception;
use utils\Constants;

require_once "Model.php";

class Especie extends Model
{


    // --
    // -- MÉTODOS --------------------
    // --




    /**
     * Inserta una nueva especie a la base de datos.
     * 
     * @param array Registro que queremos insertar.
     * 
     * @return mixed Devuelve true si se ha insertado correctamente y null si no se ha podido
     */
    public function insert(array $especie)
    {
        try {
            // Consulta
            $query = "INSERT INTO especies (nombre, descripcion) VALUE(:nombre, :descripcion)";

            //Preparamos la query
            $stm = $this->conBD->prepare($query);

            $stm->bindParam(":nombre", $especie["nombre"], PDO::PARAM_STR);
            $stm->bindParam(":descripcion", $especie["descripcion"], PDO::PARAM_STR);

            // Ejecutamos la query           
            // Devolvemos resultados
            if ($stm->execute()) {
                $query = "SELECT id FROM perrera.especies ORDER BY id DESC LIMIT 1";
                $stm = $this->conBD->prepare($query);
                $stm->execute();
                return $stm->fetch()['id'];
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

        return false;
    }

    public function soft_delete_especie(String $especie_id)
    {
        try {
            $this->conBD->beginTransaction(); // esto es muy chulo porque se supone que ejecuta todo y si algo falla no se realizan 
            $result = $this->queryParam(Constants::SOFT_DEL_ESPECIE_ESPECIE, ['id' => $especie_id]);
            $result = $this->queryParam(Constants::SOFT_DEL_ESPECIE_JAULA, ['id' => $especie_id]);
            $result = $this->queryParam(Constants::SOFT_DEL_ESPECIE_ANIMAL, ['id' => $especie_id]);
            $result = $this->queryParam(Constants::SOFT_DEL_ESPECIE_ASISTENCIA_VETERINARIA, ['id' => $especie_id]);
            $result = $this->queryParam(Constants::SOFT_DEL_ESPECIE_IMGS, ['id' => $especie_id]);
            $result = $this->queryParam(Constants::SOFT_DEL_ESPECIE_ANIMALES_CON_DUENIO, ['id' => $especie_id]);
            $result = $this->queryParam(Constants::SOFT_DEL_ESPECIE_TAREAS_ASIGNADAS, ['id' => $especie_id]);
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


    public function soft_undelete_especie(String $especie_id)
    {
        try {
            $this->conBD->beginTransaction();

            $result = $this->queryParam(Constants::SOFT_UNDEL_ESPECIE_ESPECIE, ['id' => $especie_id]);
            if ($result == false) throw new Exception("Error soft-undelete especie");


            $result = $this->queryParam(Constants::SOFT_UNDEL_ESPECIE_JAULA, ['id' => $especie_id]);
            if ($result == false) throw new Exception("Error soft-undelete-jaula-especie");


            // $result = $this->queryParam(Constants::SOFT_UNDEL_ESPECIE_ANIMAL, ['id' => $especie_id]);
            // if ($result == false) throw new Exception("Error soft-undelete-animales-especie");


            // $result = $this->queryParam(Constants::SOFT_UNDEL_ESPECIE_ASISTENCIA_VETERINARIA, ['id' => $especie_id]);
            // if ($result == false) throw new Exception("Error soft-undelete-atencion-veterinaria-especie");


            $this->conBD->commit();
            return true;
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


// $nombre = new Especie();
// var_dump($nombre->insert(["nombre"=>"pepe", "descripcion" => "-"]));
// var_dump($nombre->get_all("especies"));