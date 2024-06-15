<?php

use \model\Model;
use \utils\Utils;

require_once "Model.php";

class Proveedor extends Model
{


    // --
    // -- MÉTODOS --------------------
    // --




    /**
     * Inserta un nuevo proveedor a la base de datos.
     * 
     * @param array Registro que queremos insertar.
     * 
     * @return mixed Devuelve true si se ha insertado correctamente y null si no se ha podido
     */
    public function insert(array $proveedor)
    {
        try {
            // Consulta
            $query = "INSERT INTO proveedores (CIF, nombre, direccion, correo, telf, 
            estado_proveedor, descripcion) VALUE(:CIF, :nombre, :direccion, :correo, :telf, 
            :estado_proveedor, :descripcion)";

            //Preparamos la query
            $stm = $this->conBD->prepare($query);

            $stm->bindParam(":CIF", $proveedor["CIF"], PDO::PARAM_STR);
            $stm->bindParam(":nombre", $proveedor["nombre"], PDO::PARAM_STR);
            $stm->bindParam(":direccion", $proveedor["direccion"], PDO::PARAM_STR);
            $stm->bindParam(":correo", $proveedor["correo"], PDO::PARAM_STR);
            $stm->bindParam(":telf", $proveedor["telf"], PDO::PARAM_STR);
            $stm->bindParam(":estado_proveedor", $proveedor["estado_proveedor"], PDO::PARAM_INT);
            $stm->bindParam(":descripcion", $proveedor["descripcion"], PDO::PARAM_STR);

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

// $proveedor = new Proveedor();
// var_dump($proveedor->get_all("proveedores"));
// var_dump($proveedor->insert(["CIF"=>"Prueba", "nombre"=>"Apellido", "direccion"=>"1999-04-30", "correo" =>"correo@ejemplo.com","telf"=>"123456789", "estado_proveedor"=>"1", "descripcion"=>"0"]));