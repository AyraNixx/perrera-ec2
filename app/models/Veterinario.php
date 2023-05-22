<?php

use \model\Model;
use \utils\Utils;

require_once "Model.php";

class Veterinario extends Model
{


    // --
    // -- MÉTODOS --------------------
    // --




    /**
     * Inserta un nuevo veterinario a la base de datos.
     * 
     * @param array Registro que queremos insertar.
     * 
     * @return mixed Devuelve true si se ha insertado correctamente y null si no se ha podido
     */
    public function insert(array $veterinario)
    {
        try {
            // Consulta
            $query = "INSERT INTO veterinarios (nombre, apellidos, correo, telf, 
            horarios, otra_informacion) VALUE(:nombre, :apellidos, :correo, :telf, 
            :horarios, :otra_informacion)";

            //Preparamos la query
            $stm = $this->conBD->prepare($query);

            $stm->bindParam(":nombre", $veterinario["nombre"], PDO::PARAM_STR);
            $stm->bindParam(":apellidos", $veterinario["apellidos"], PDO::PARAM_STR);
            $stm->bindParam(":correo", $veterinario["correo"], PDO::PARAM_STR);
            $stm->bindParam(":telf", $veterinario["telf"], PDO::PARAM_STR);
            $stm->bindParam(":horarios", $veterinario["horarios"], PDO::PARAM_STR);
            $stm->bindParam(":otra_informacion", $veterinario["otra_informacion"], PDO::PARAM_STR);
            
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

// $veterinario = new Veterinario();
// var_dump($veterinario->get_all("veterinarios"));
// var_dump($veterinario->insert(["nombre"=>"Prueba", "apellidos"=>"Apellido", "correo" =>"correo@ejemplo.com","telf"=>"123456789", "horarios"=>"", "otra_informacion"=>"0"]));