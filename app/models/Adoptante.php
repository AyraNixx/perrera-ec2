<?php

namespace model;

use \model\Model;
use \utils\Utils;
use \PDO;
use \PDOException;
use \Exception;

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
        $query = "INSERT INTO adoptante ( nombre, apellidos, fech_nac, NIF, correo, telf, direccion, ciudad, codigo_postal,
            pais, ocupacion, tipo_vivienda, tiene_jardin, preferencia_adopcion, otra_mascota, tipo_otra_mascota, estado_solicitud, fecha_solicitud,
            tiempo_espera, estado_adopcion, fecha_adopcion, comentarios, animales_id)
            VALUES ( :nombre, :apellidos, :fech_nac, :NIF, :correo, :telf, :direccion, :ciudad, :codigo_postal,
            :pais, :ocupacion, :tipo_vivienda, :tiene_jardin, :preferencia_adopcion, :otra_mascota, :tipo_otra_mascota, :estado_solicitud, :fecha_solicitud,
            :tiempo_espera, :estado_adopcion, :fecha_adopcion, :comentarios, :animales_id)";

            //Preparamos la query
            $stm = $this->conBD->prepare($query);

            $stm->bindParam(":nombre", $adoptante["nombre"], PDO::PARAM_STR);
            $stm->bindParam(":apellidos", $adoptante["apellidos"], PDO::PARAM_STR);
            $stm->bindParam(":fech_nac", $adoptante["fech_nac"], PDO::PARAM_STR);
            $stm->bindParam(":NIF", $adoptante["NIF"], PDO::PARAM_STR);
            $stm->bindParam(":correo", $adoptante["correo"], PDO::PARAM_STR);
            $stm->bindParam(":telf", $adoptante["telf"], PDO::PARAM_STR);
            $stm->bindParam(":direccion", $adoptante["direccion"], PDO::PARAM_STR);
            $stm->bindParam(":ciudad", $adoptante["ciudad"], PDO::PARAM_STR);
            $stm->bindParam(":codigo_postal", $adoptante["codigo_postal"], PDO::PARAM_STR);
            $stm->bindParam(":pais", $adoptante["pais"], PDO::PARAM_STR);
            $stm->bindParam(":ocupacion", $adoptante["ocupacion"], PDO::PARAM_STR);
            $stm->bindParam(":tipo_vivienda", $adoptante["tipo_vivienda"], PDO::PARAM_STR);
            $stm->bindParam(":tiene_jardin", $adoptante["tiene_jardin"], PDO::PARAM_BOOL);
            $stm->bindParam(":preferencia_adopcion", $adoptante["preferencia_adopcion"], PDO::PARAM_STR);
            $stm->bindParam(":otra_mascota", $adoptante["otra_mascota"], PDO::PARAM_BOOL);
            $stm->bindParam(":tipo_otra_mascota", $adoptante["tipo_otra_mascota"], PDO::PARAM_STR);
            $stm->bindParam(":estado_solicitud", $adoptante["estado_solicitud"], PDO::PARAM_STR);
            $stm->bindParam(":fecha_solicitud", $adoptante["fecha_solicitud"], PDO::PARAM_STR);
            $stm->bindParam(":tiempo_espera", $adoptante["tiempo_espera"], PDO::PARAM_INT);
            $stm->bindParam(":estado_adopcion", $adoptante["estado_adopcion"], PDO::PARAM_STR);
            $stm->bindParam(":fecha_adopcion", $adoptante["fecha_adopcion"], PDO::PARAM_STR);
            $stm->bindParam(":comentarios", $adoptante["comentarios"], PDO::PARAM_STR);
            $stm->bindParam(":animales_id", $adoptante["animales_id"], PDO::PARAM_STR);
    
            // Ejecutamos la query           
            // Devolvemos resultados 
            if($stm->execute()){
                $query = "SELECT id FROM perrera.adoptante ORDER BY id DESC LIMIT 1";
                $stm = $this->conBD->prepare($query);
                $stm->execute();
                return $stm->fetch()['id'];
            }else{
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
}

// $adoptante = new Adoptante();
// var_dump($adoptante->get_all("adoptante"));
// var_dump($adoptante->insert(["nombre"=>"Prueba", "apellidos"=>"Apellido", "fecha_nacimiento"=>"1999-04-30", 
// "NIF"=>"12345678B", "correo" =>"correo@ejemplo.com","telf"=>"123456789", "direccion"=>"1", 
// "preferencia_adopcion"=>"0", "animales_id"=>"1", "estado_solicitud" => "1", "fecha_solicitud" => "1999-01-21", "tiempo_espera" => "2"]));