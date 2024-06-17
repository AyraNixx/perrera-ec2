<?php

namespace model;

use \model\Model;
use \utils\Utils;
use \PDO;
use \PDOException;
use \Exception;

require_once "Model.php";

class Duenio extends Model
{

    // --
    // -- MÉTODOS --------------------
    // --




    /**
     * Inserta un nuevo duenio a la base de datos.
     * 
     * @param array Registro que queremos insertar.
     * 
     * @return mixed Devuelve true si se ha insertado correctamente y null si no se ha podido
     */
    public function insert(array $duenio)
    {
        try {
            $query = "INSERT INTO duenios (nombre, apellidos, fech_nac, NIF, correo, telf, ocupacion,
        direccion, ciudad, codigo_postal, pais, permiso_visita, fecha_ultima_visita, observaciones) 
        VALUES (:nombre, :apellidos, :fech_nac, :NIF, :correo, :telf, :ocupacion, :direccion, :ciudad, 
        :codigo_postal, :pais, :permiso_visita, :fecha_ultima_visita, :observaciones)";

            //Preparamos la query
            $stm = $this->conBD->prepare($query);

            $stm->bindParam(":nombre", $duenio["nombre"], PDO::PARAM_STR);
            $stm->bindParam(":apellidos", $duenio["apellidos"], PDO::PARAM_STR);
            $stm->bindParam(":fech_nac", $duenio["fech_nac"], PDO::PARAM_STR);
            $stm->bindParam(":NIF", $duenio["NIF"], PDO::PARAM_STR);
            $stm->bindParam(":correo", $duenio["correo"], PDO::PARAM_STR);
            $stm->bindParam(":telf", $duenio["telf"], PDO::PARAM_STR);
            $stm->bindParam(":ocupacion", $duenio["ocupacion"], PDO::PARAM_STR);
            $stm->bindParam(":direccion", $duenio["direccion"], PDO::PARAM_STR);
            $stm->bindParam(":ciudad", $duenio["ciudad"], PDO::PARAM_STR);
            $stm->bindParam(":codigo_postal", $duenio["codigo_postal"], PDO::PARAM_STR);
            $stm->bindParam(":pais", $duenio["pais"], PDO::PARAM_STR);
            $stm->bindParam(":permiso_visita", (isset($duenio["permiso_visita"]) ? $duenio["permiso_visita"] : 0), PDO::PARAM_INT);
            $stm->bindParam(":fecha_ultima_visita", $duenio["fecha_ultima_visita"], PDO::PARAM_STR);
            $stm->bindParam(":observaciones", $duenio["observaciones"], PDO::PARAM_STR);

            // Ejecutamos la query   
            if ($stm->execute()) {
                // Recuperamos id del registro recién insertado
                $query = "SELECT id FROM perrera.duenios ORDER BY id DESC LIMIT 1";
                $stm = $this->conBD->prepare($query);
                $stm->execute();

                $id = $stm->fetch()['id'];
                return $id;
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

    public function insert_into_historial(String $duenio, String $animales)
    {
        try {
            $animales_a = explode(',', $animales);
    
            if (!is_array($animales_a)) {
                throw new Exception("No es un array");
            }
    
            // Preparar la consulta para insertar en historial_animal_duenio
            $query = "INSERT INTO historial_animal_duenio (duenios_id, animales_id, estado_actual) VALUES ";
            $values = [];
    
            // Construir los valores para la inserción
            foreach ($animales_a as $animales_id) {
                $values[] = "(:duenio_id, :animales_id, 'Activo')";
            }
    
            $query .= implode(", ", $values);
            $stm_insert = $this->conBD->prepare($query);
    
            foreach ($animales_a as $animales_id) {
                $stm_insert->bindParam(":duenio_id", $duenio, PDO::PARAM_STR);
                $stm_insert->bindParam(":animales_id", $animales_id, PDO::PARAM_STR);
            }
    
            return $stm_insert->execute();
            
        } catch (PDOException $e) {
            // Guardamos el error en el log
            Utils::save_log_error("PDOException caught: " . $e->getMessage());
        } catch (Exception $e) {
            // Guardamos el error en el log
            Utils::save_log_error("Unexpected error caught: " . $e->getMessage());
        }
    }
}
