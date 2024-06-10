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
    private $duenio;
    function __construct()
    {
        $duenio = new Model();
    }

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
            $query = "INSERT INTO duenios (nombre, apellidos, fech_nac, NIF, correo, telf, 
            direccion, ciudad, codigo_postal, pais, permiso_visita, fecha_ultima_visita, observaciones) 
            VALUES (:nombre, :apellidos, :fech_nac, :NIF, :correo, :telf, :direccion, :ciudad, 
            :codigo_postal, :pais, :permiso_visita, :fecha_ultima_visita, :observaciones)";

            //Preparamos la query
            $stm = $this->conBD->prepare($query);

            $stm->bindParam(":nombre", $duenio["nombre"], PDO::PARAM_STR);
            $stm->bindParam(":apellidos", $duenio["apellidos"], PDO::PARAM_STR);
            $stm->bindParam(":fech_nac", $duenio["fecha_nacimiento"], PDO::PARAM_STR);
            $stm->bindParam(":NIF", $duenio["NIF"], PDO::PARAM_STR);
            $stm->bindParam(":correo", $duenio["correo"], PDO::PARAM_STR);
            $stm->bindParam(":telf", $duenio["telf"], PDO::PARAM_STR);
            $stm->bindParam(":direccion", $duenio["direccion"], PDO::PARAM_STR);
            $stm->bindParam(":ciudad", $duenio["ciudad"], PDO::PARAM_STR);
            $stm->bindParam(":codigo_postal", $duenio["codigo_postal"], PDO::PARAM_STR);
            $stm->bindParam(":pais", $duenio["pais"], PDO::PARAM_STR);
            $stm->bindParam(":permiso_visita", $duenio["permiso_visita"], PDO::PARAM_INT);
            $stm->bindParam(":fecha_ultima_visita", $duenio["fecha_ultima_visita"], PDO::PARAM_STR);
            $stm->bindParam(":observaciones", $duenio["observaciones"], PDO::PARAM_STR);
    
            // Ejecutamos la query   
            if($stm->execute()){
                // Recuperamos id del registro recién insertado
                $query = "SELECT id FROM perrera.duenios ORDER BY id DESC LIMIT 1";
                $stm = $this->conBD->prepare($query);
                $stm->execute();

                $id = $stm->fetch()['id']; // Guardamos id

                // Actualizamos el registro de la tabla animales coincidente con el id de animales que se pasa para poner el dueño
                $query = "UPDATE animales SET duenios_id = :duenio_id WHERE id = :animales_id";
                $stm = $this->conBD->prepare($query);
                $stm->bindParam(":animales_id", $duenio["animales_id"], PDO::PARAM_STR);

                $stm->execute();

                return $id;
            }else{
                return false;
            }
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


    public function update(String $query, array $duenio){
        try {
            $old_animal = $this->duenio->queryParam('SELECT id FROM perrera.animales WHERE duenios_id = :id LIMIT 1', ['id' => $duenio['id']])['id'];
            if($old_animal !== $duenio['animales_id'])
            $this->duenio->queryParam($query, $duenio); // Actualizamos duenio
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
