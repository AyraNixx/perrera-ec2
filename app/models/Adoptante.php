<?php

use \model\Model;
use \utils\Utils;

require_once "Model.php";
/*




    // Aquí necesitaría hacer algo para ir actualizando el tiempo de espera, 
    // MIRAR SI SE PUEDEN REALIZAR AUTOMATIZACIONES EN MYSQL







*/
class Adoptante extends Model
{


    // --
    // -- MÉTODOS --------------------
    // --




    /**
     * Inserta un nuevo adoptante a la base de datos.
     * 
     * @param array Registro que queremos insertar.
     * 
     * @return mixed Devuelve true si se ha insertado correctamente y null si no se ha podido
     */
    public function insert(array $adoptante)
    {
        try {
            // Consulta
            $query = "INSERT INTO adoptante (
            nombre,
            apellidos,
            fecha_nacimiento,
            NIF,
            correo,
            telf,
            direccion,
            preferencia_adopcion,
            animales_id,
            estado_solicitud,
            fecha_solicitud,
            tiempo_espera,
            estado_adopcion,
            fecha_adopcion)

            VALUE(:nombre,
            :apellidos,
            :fecha_nacimiento,
            :NIF,
            :correo,
            :telf,            
            :direccion,
            :preferencia_adopcion,
            :animales_id,
            :estado_solicitud,
            :fecha_solicitud,
            :tiempo_espera,
            :estado_adopcion,
            :fecha_adopcion)";

            //Preparamos la query
            $stm = $this->conBD->prepare($query);

            $stm->bindParam(":nombre", $adoptante["nombre"], PDO::PARAM_STR);
            $stm->bindParam(":apellidos", $adoptante["apellidos"], PDO::PARAM_STR);
            $stm->bindParam(":fecha_nacimiento", $adoptante["fecha_nacimiento"], PDO::PARAM_STR);
            $stm->bindParam(":NIF", $adoptante["NIF"], PDO::PARAM_STR);
            $stm->bindParam(":correo", $adoptante["correo"], PDO::PARAM_STR);
            $stm->bindParam(":telf", $adoptante["telf"], PDO::PARAM_STR);
            $stm->bindParam(":direccion", $adoptante["direccion"], PDO::PARAM_STR);
            $stm->bindParam(":preferencia_adopcion", $adoptante["preferencia_adopcion"], PDO::PARAM_BOOL);
            $stm->bindParam(":animales_id", $adoptante["animales_id"], PDO::PARAM_INT);
            $stm->bindParam(":estado_solicitud", $adoptante["estado_solicitud"], PDO::PARAM_INT);
            $stm->bindParam(":fecha_solicitud", $adoptante["fecha_solicitud"], PDO::PARAM_STR);
            $stm->bindParam(":tiempo_espera", $adoptante["tiempo_espera"], PDO::PARAM_INT);
            $stm->bindParam(":estado_adopcion", $adoptante["estado_adopcion"], PDO::PARAM_INT);
            $stm->bindParam(":fecha_adopcion", $adoptante["fecha_adopcion"], PDO::PARAM_STR);

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

// $adoptante = new Adoptante();
// var_dump($adoptante->get_all("adoptante"));
// var_dump($adoptante->insert(["nombre"=>"Prueba", "apellidos"=>"Apellido", "fecha_nacimiento"=>"1999-04-30", 
// "NIF"=>"12345678B", "correo" =>"correo@ejemplo.com","telf"=>"123456789", "direccion"=>"1", 
// "preferencia_adopcion"=>"0", "animales_id"=>"1", "estado_solicitud" => "1", "fecha_solicitud" => "1999-01-21", "tiempo_espera" => "2"]));