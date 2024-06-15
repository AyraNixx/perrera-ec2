<?php

use \model\Model;
use \utils\Utils;

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
            $query = "INSERT INTO voluntarios (nombre, apellidos, fech_nac, NIF, correo, telf, 
            experiencia_previa, disponibilidad, informacion_relevante) VALUE(:nombre, :apellidos, :fech_nac, :NIF, :correo, :telf, 
            :experiencia_previa, :disponibilidad, :informacion_relevante)";

            //Preparamos la query
            $stm = $this->conBD->prepare($query);

            $stm->bindParam(":nombre", $voluntario["nombre"], PDO::PARAM_STR);
            $stm->bindParam(":apellidos", $voluntario["apellidos"], PDO::PARAM_STR);
            $stm->bindParam(":fech_nac", $voluntario["fech_nac"], PDO::PARAM_STR);
            $stm->bindParam(":NIF", $voluntario["NIF"], PDO::PARAM_STR);
            $stm->bindParam(":correo", $voluntario["correo"], PDO::PARAM_STR);
            $stm->bindParam(":telf", $voluntario["telf"], PDO::PARAM_STR);
            $stm->bindParam(":experiencia_previa", $voluntario["experiencia_previa"], PDO::PARAM_BOOL);
            $stm->bindParam(":disponibilidad", $voluntario["disponibilidad"], PDO::PARAM_BOOL);
            $stm->bindParam(":informacion_relevante", $voluntario["informacion_relevante"], PDO::PARAM_STR);

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
    }
}

// $voluntario = new Voluntario();
// var_dump($voluntario->get_all("voluntarios"));
// var_dump($voluntario->insert(["nombre"=>"Prueba", "apellidos"=>"Apellido", "fech_nac"=>"1999-04-30", "NIF"=>"12345678B", "correo" =>"correo@ejemplo.com","telf"=>"123456789", "experiencia_previa"=>"1", "disponibilidad"=>"0", "infromacion_relevante"=>"-"]));