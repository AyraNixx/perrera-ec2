<?php

namespace model;

use \model\Model;
use \utils\Utils;
use \PDO;
use \PDOException;
use \Exception;

require_once "Model.php";


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
            pais, ocupacion, tipo_vivienda, tiene_jardin, preferencia_adopcion, fecha_solicitud, estado_solicitud, otra_mascota, tipo_otra_mascota, comentarios)
            VALUES (:nombre, :apellidos, :fech_nac, :NIF, :correo, :telf, :direccion, :ciudad, :codigo_postal,
            :pais, :ocupacion, :tipo_vivienda, :tiene_jardin, :preferencia_adopcion, :fecha_solicitud, :estado_solicitud, :otra_mascota, :tipo_otra_mascota, :comentarios)";

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
            $stm->bindParam(":comentarios", $adoptante["comentarios"], PDO::PARAM_STR);

            // Ejecutamos la query           
            // Devolvemos resultados 
            if ($stm->execute()) {
                $query = "SELECT id FROM perrera.adoptante ORDER BY id DESC LIMIT 1";
                $stm = $this->conBD->prepare($query);
                $stm->execute();
                $id_adoptante = $stm->fetch()['id'];

                echo $id_adoptante;
                // if (isset($adoptante['animales_id']) && $id_adoptante != null) {   // Si existen animales seleccionados
                //     $animals = explode(',', $adoptante['animales_id']); // Convertimos la cadena en array
                //     $in = str_repeat('?,', count($animals) - 1) . '?'; // Ponemos un ? por cada valor del array
                //     $query = 'UPDATE perrera.animales SET adoptante_id = ?, estado_adopcion = "En proceso" WHERE id IN (' . $in . ')';
                //     $stm = $this->conBD->prepare($query);
                //     // Concatenamos los valores de los animales al array de id_adoptante
                //     $values = array_merge([$id_adoptante], $animals);
                //     foreach ($values as $k => $value) { // Asignamos los valores
                //         $stm->bindValue($k + 1, $value, PDO::PARAM_STR);
                //     }
                //     $stm->execute();
                // }
                return $id_adoptante;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Guardamos el error en el log
            Utils::save_log_error("PDOException caught: " . $e->getMessage());
        } catch (Exception $e) {
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