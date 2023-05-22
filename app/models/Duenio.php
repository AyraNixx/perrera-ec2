<?php

use \model\Model;
use \utils\Utils;

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
            // Consulta
            $query = "INSERT INTO duenios (
            nombre,
            apellidos,
            fecha_nacimiento,
            NIF,
            correo,
            telf,
            direccion,
            animales_id,
            permiso_visita,
            fecha_ultima_visita,
            observaciones)

            VALUE(:nombre,
            :apellidos,
            :fecha_nacimiento,
            :NIF,
            :correo,
            :telf,            
            :direccion,
            :animales_id,
            :permiso_visita,
            :fecha_ultima_visita,
            :observaciones)";

            //Preparamos la query
            $stm = $this->conBD->prepare($query);

            $stm->bindParam(":nombre", $duenio["nombre"], PDO::PARAM_STR);
            $stm->bindParam(":apellidos", $duenio["apellidos"], PDO::PARAM_STR);
            $stm->bindParam(":fecha_nacimiento", $duenio["fecha_nacimiento"], PDO::PARAM_STR);
            $stm->bindParam(":NIF", $duenio["NIF"], PDO::PARAM_STR);
            $stm->bindParam(":correo", $duenio["correo"], PDO::PARAM_STR);
            $stm->bindParam(":telf", $duenio["telf"], PDO::PARAM_STR);
            $stm->bindParam(":direccion", $duenio["direccion"], PDO::PARAM_STR);
            $stm->bindParam(":animales_id", $duenio["animales_id"], PDO::PARAM_INT);
            $stm->bindParam(":permiso_visita", $duenio["permiso_visita"], PDO::PARAM_INT);
            $stm->bindParam(":fecha_ultima_visita", $duenio["fecha_ultima_visita"], PDO::PARAM_STR);
            $stm->bindParam(":observaciones", $duenio["observaciones"], PDO::PARAM_STR);

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

$duenio = new Duenio();
var_dump($duenio->get_all("duenioS"));
var_dump($duenio->insert([
    "nombre"=>"Prueba",
    "apellidos"=>"Apellido",
    "fecha_nacimiento"=>"1999-04-30",
    "NIF"=>"12345678B",
    "correo"=>"correo@ejemplo.com",
    "telf"=>"123456789",
    "direccion"=>"1",
    "animales_id"=>"0",
    "animales_id"=>"1",
    "permiso_visita"=>"1",
    "fecha_ultima_visita"=>"1999-01-21",
    "observaciones"=> "2"
]));