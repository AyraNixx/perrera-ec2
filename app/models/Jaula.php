<?php

namespace model;

use \model\Model;
use \utils\Utils;
use \PDO;
use \PDOException;
use \Exception;

require_once "Model.php";
/*


    Yo me voy apuntando cualquier idea que se me vaya ocurriendo xd.

    Cuando se le otorgue una jaula a un animal, su estado tiene que pasar directamente a
    ocupada o podría decir que cada jaula tiene X espacio y que cada vez que se añada un
    animal, el espacio disponible vaya bajando.

    Bueno, ya veré




*/

class Jaula extends Model
{


    // --
    // -- MÉTODOS --------------------
    // --




    /**
     * Inserta una nueva jaula a la base de datos.
     * 
     * @param array Registro que queremos insertar.
     * 
     * @return mixed Devuelve true si se ha insertado correctamente y null si no se ha podido
     */
    public function insert(array $jaula)
    {
        try {
            // Consulta
            $query = "INSERT INTO jaulas (ubicacion, tamanio, ocupada, estado_comida, estado_limpieza, descripcion, otros_comentarios) 
            VALUE(:ubicacion, :tamanio, :ocupada, :estado_comida, :estado_limpieza, :descripcion, :otros_comentarios)";

            //Preparamos la query
            $stm = $this->conBD->prepare($query);

            //Vinculamos los parametros al nombre de variable especificado
            $stm->bindParam(":ubicacion", $jaula["ubicacion"], PDO::PARAM_STR);
            $stm->bindParam(":tamanio", $jaula["tamanio"], PDO::PARAM_INT);
            $stm->bindParam(":ocupada", $jaula["ocupada"], PDO::PARAM_INT);
            $stm->bindParam(":estado_comida", $jaula["estado_comida"], PDO::PARAM_INT);
            $stm->bindParam(":estado_limpieza", $jaula["estado_limpieza"], PDO::PARAM_INT);
            $stm->bindParam(":descripcion", $jaula["descripcion"], PDO::PARAM_STR);
            $stm->bindParam(":otros_comentarios", $jaula["otros_comentarios"], PDO::PARAM_STR);

            // Ejecutamos la query           
            // Devolvemos resultados
            return $stm->execute();
            // En caso de excepción, lo guardamos en el log
        } catch (PDOException $e) {
            // Guardamos el error en el log
            Utils::save_log_error("PDOException caught: " . $e->getMessage());
        } catch (Exception $e) {
            // Guardamos el error en el log
            Utils::save_log_error("Unexpected error caught: " . $e->getMessage());
        }

        return null;
    }




    /**
     * Función que devuelve todas las jaulas que empiecen por la letra pasada como argumento y 
     * que aún tengan espacio disponible.
     * 
     * @param String $letra
     * 
     * @return Array Todos los registros coincidentes
    */
    public function check_disponibility_in_block(String $especie_id)
    {
        try {
            // Consulta
            $query = "SELECT j.id, j.ubicacion, j.ocupada, j.descripcion
            FROM jaulas j 
            JOIN especies e ON j.especies_id = e.id
            WHERE j.especies_id = :especie_id AND j.disponible = 1;";

            //Preparamos la query
            $stm = $this->conBD->prepare($query);

            $stm->bindParam(":especie_id", $especie_id, PDO::PARAM_STR);

            // Ejecutamos la query      
            $stm->execute();     
            // Devolvemos resultados
            return $stm->fetchAll();

            // En caso de excepción, lo guardamos en el log
        } catch (PDOException $e) {
            // Guardamos el error en el log
            Utils::save_log_error("PDOException caught: " . $e->getMessage());
        } catch (Exception $e) {
            // Guardamos el error en el log
            Utils::save_log_error("Unexpected error caught: " . $e->getMessage());
        }
    }
}

// $jaula = new Jaula();

// $jaulas_disponibles = $jaula->check_disponibility_in_block('00B100292511104237965');


// foreach($jaulas_disponibles as $jaula)
// {
//     if(str_contains($jaula["descripcion"], "grande"))
//     {
//         echo "<pre>";
//         var_dump($jaula);
//         echo "</pre>";
//     }
// }


