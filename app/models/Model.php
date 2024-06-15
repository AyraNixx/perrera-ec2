<?php

// Damos un apodo al directorio
namespace model;

require_once "../utils/Utils.php";

use \utils\Utils;
use \PDO;
use \PDOException;
use \Exception;


// Creamos una clase Model que contendrá los métodos delete y pagination que heredarán 
// el resto de clases
class Model
{


    // --
    // -- MÉTODOS --------------------
    // --




    protected $conBD;

    // Constructor
    function __construct()
    {
        try {
            // Iniciamos la conexión con la bd
            $this->conBD = Utils::connectBD();
            // En caso de excepción, lo guardamos en el log
        } catch (PDOException $e) {
            // Guardamos el error en el log
            Utils::save_log_error("PDOException caught: " . $e->getMessage());
        } catch (Exception $e) {
            // Guardamos el error en el log
            Utils::save_log_error("Unexpected error caught: " . $e->getMessage());
        }
    }


    /**
     * Devuelve todos los registros de una tabla
     * 
     * @param String table
     */
    public function get_all(String $table)
    {
        // Rodeamos el código en un try catch para controlar las excepciones
        try {
            // Query
            $query = "SELECT * FROM $table";
            // Preparamos la consulta para su ejecución
            $stm = $this->conBD->prepare($query);
            // Ejecutamos la consulta
            $stm->execute();
            // Devolvemos resultado obtenido
            return $stm->fetchAll();
        } catch (PDOException $e) {
            // Guardamos el error en el log
            Utils::save_log_error("PDOException caught: " . $e->getMessage());
        } catch (Exception $e) {
            // Guardamos el error en el log
            Utils::save_log_error("Unexpected error caught: " . $e->getMessage());
        }
    }

    /**
     * Devuelve todos los registros visibles de una tabla
     * 
     * @param String table
     */
    public function get_all_visibles(String $table)
    {
        // Rodeamos el código en un try catch para controlar las excepciones
        try {
            // Query
            $query = "SELECT * FROM $table WHERE disponible = 1";
            // Preparamos la consulta para su ejecución
            $stm = $this->conBD->prepare($query);
            // Ejecutamos la consulta
            $stm->execute();
            // Devolvemos resultado obtenido
            return $stm->fetchAll();
        } catch (PDOException $e) {
            // Guardamos el error en el log
            Utils::save_log_error("PDOException caught: " . $e->getMessage());
        } catch (Exception $e) {
            // Guardamos el error en el log
            Utils::save_log_error("Unexpected error caught: " . $e->getMessage());
        }
    }

    /**
     * Devuelve un registro de la tabla indicada
     * 
     * @param String table
     * @param int $id;
     */
    public function get_one(String $table, String $id)
    {
        // Rodeamos el código en un try catch para controlar las excepciones
        try {
            // Query
            $query = "SELECT * FROM $table WHERE id = :id";
            // Preparamos la consulta para su ejecución
            $stm = $this->conBD->prepare($query);
            // Vinculamos los parámetros al nombre de la variable especificada
            $stm->bindParam(":id", $id, PDO::PARAM_STR);
            // Ejecutamos la consulta
            $stm->execute();
            // Devolvemos resultado obtenido
            return $stm->fetch();
        } catch (PDOException $e) {
            // Guardamos el error en el log
            Utils::save_log_error("PDOException caught: " . $e->getMessage());
        } catch (Exception $e) {
            // Guardamos el error en el log
            Utils::save_log_error("Unexpected error caught: " . $e->getMessage());
        }
    }

    public function filter_data(String $table, String $field, mixed $value_field)
    {
        // Rodeamos el código en un try catch para controlar las excepciones
        try {
            // Query
            $query = "SELECT * FROM $table WHERE disponible = 1 AND $field = :field";
            // Preparamos la consulta para su ejecución
            $stm = $this->conBD->prepare($query);
            // Vinculamos los parámetros al nombre de la variable especificada
            $stm->bindParam(":field", $value_field, PDO::PARAM_STMT);
            // Ejecutamos la consulta
            $stm->execute();
            // Devolvemos resultado obtenido
            return $stm->fetchAll();
        } catch (PDOException $e) {
            // Guardamos el error en el log
            Utils::save_log_error("PDOException caught: " . $e->getMessage());
        } catch (Exception $e) {
            // Guardamos el error en el log
            Utils::save_log_error("Unexpected error caught: " . $e->getMessage());
        }
    }

    /**
     * Elimina un elemento de la tabla indicada como argumento mediante su id
     * 
     * @param String table
     * @param int $id;
     */
    public function delete(String $table, int $id)
    {
        // Rodeamos el código en un try catch para controlar las excepciones
        try {
            // Query
            $query = "DELETE FROM $table WHERE id = :id";
            // Preparamos la consulta para su ejecución
            $stm = $this->conBD->prepare($query);
            // Vinculamos los parámetros al nombre de la variable especificada
            $stm->bindParam(":id", $id, PDO::PARAM_INT);
            // Ejecutamos la consulta y devolvemos resultado obtenido
            return $stm->execute();
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
     * Elimina un elemento de la tabla indicada como argumento mediante su id
     * 
     * @param String table
     * @param int $id;
     */
    public function soft_delete(String $table, String $id)
    {
        // Rodeamos el código en un try catch para controlar las excepciones
        try {
            if (is_int($id)) {
                $id = "00" . $id;
            }
            // Query
            $query = "UPDATE $table SET disponible = '0' WHERE id = :id";
            // Preparamos la consulta para su ejecución
            $stm = $this->conBD->prepare($query);
            // Vinculamos los parámetros al nombre de la variable especificada
            $stm->bindParam(":id", $id, PDO::PARAM_STR);
            // Ejecutamos la consulta y devolvemos resultado obtenido
            return $stm->execute();
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
     * Devuelve todas las filas de 
     * la base de datos 'tienda_animales' paginada.
     * 
     * @return array Devuelve en forma de array toda la información contenida en la tabla usuarios de la base de datos tienda_animales, de forma paginada
     */
    public function pagination_all(String $table, string $ord, string $field, int $page, int $amount)
    {
        // Rodeamos el código en un try catch para controlar las excepciones
        try {
            // Calculamos desde que línea se empieza
            $offset = ($page - 1) * $amount;

            // Consulta
            $query = "SELECT * FROM $table ORDER BY $field $ord LIMIT :amount OFFSET :offset";
            // Preparamos la consulta para su ejecución
            $statement = $this->conBD->prepare($query);
            // Vinculamos los parámetros al nombre de la variable especificada
            $statement->bindParam(":amount", $amount, PDO::PARAM_INT);
            $statement->bindParam(":offset", $offset, PDO::PARAM_INT);
            // Ejecutamos la consulta
            $statement->execute();
            //Devolvemos las filas resultantes
            return $statement->fetchAll();
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
     * Devuelve todas las filas visibles de 
     * la base de datos 'tienda_animales' paginada.
     * 
     * @return array Devuelve en forma de array toda la información contenida en la tabla usuarios de la base de datos tienda_animales, de forma paginada
     */
    public function pagination_visible(String $table, string $ord, string $field, int $page, int $amount)
    {
        // Rodeamos el código en un try catch para controlar las excepciones
        try {
            // Calculamos desde que línea se empieza
            $offset = ($page - 1) * $amount;

            // Consulta
            $query = "SELECT * FROM $table WHERE disponible = 1 ORDER BY $field $ord LIMIT :amount OFFSET :offset";
            // Preparamos la consulta para su ejecución
            $statement = $this->conBD->prepare($query);
            // Vinculamos los parámetros al nombre de la variable especificada
            $statement->bindParam(":amount", $amount, PDO::PARAM_INT);
            $statement->bindParam(":offset", $offset, PDO::PARAM_INT);
            // Ejecutamos la consulta
            $statement->execute();
            //Devolvemos las filas resultantes
            return $statement->fetchAll();
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
     * Devuelve el total de páginas que hay en una tabla según la cantidad de elementos
     * que se quiera enseñar en cada una
     */
    public function total_pages(String $table, int $amount)
    {
        // Contamos todos los elementos que hay en la tabla de usuarios y lo
        // dividimos por la cantidad de elementos que mostramos por página.
        // Luego redondeamos para arriba con ceil.
        return ceil(count(self::get_all($table)) / $amount);
    }

    /**
     * Devuelve el total de páginas que hay en una tabla según la cantidad de elementos visibles
     * que se quiera enseñar en cada una
     */
    public function total_pages_visibles(String $table, int $amount)
    {
        // Contamos todos los elementos que hay en la tabla de usuarios y lo
        // dividimos por la cantidad de elementos que mostramos por página.
        // Luego redondeamos para arriba con ceil.
        return ceil(count(self::get_all_visibles($table)) / $amount);
    }


    public function query(String $query)
    {
        // Rodeamos el código en un try catch para controlar las excepciones
        try {
            $statement = $this->conBD->prepare($query);
            // Ejecutamos la consulta
            $statement->execute();
            //Devolvemos las filas resultantes
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Guardamos el error en el log
            Utils::save_log_error("PDOException caught: " . $e->getMessage());
        } catch (Exception $e) {
            // Guardamos el error en el log
            Utils::save_log_error("Unexpected error caught: " . $e->getMessage());
        }
        return null;
    }

    public function queryParam(String $query, array $params = [])
    {
        // Rodeamos el código en un try catch para controlar las excepciones
        try {
            $stmt = $this->conBD->prepare($query);

            foreach ($params as $key => $value) {
                $stmt->bindValue(':' . $key, $value);
            }
            // Ejecutamos la consulta
            $success = $stmt->execute();
            if ($success) {
                if (!str_contains($query, 'SELECT')) {
                    return true;
                }
                //Devolvemos las filas resultantes
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            // Guardamos el error en el log
            Utils::save_log_error("PDOException caught: " . $e->getMessage());
        } catch (Exception $e) {
            // Guardamos el error en el log
            Utils::save_log_error("Unexpected error caught: " . $e->getMessage());
        }
        return false;
    }

    public function queryParamSearch(String $query, String $value, String $sort, String $field, int $page, int $amount)
    {

        try {
            $query = $query . $field . ' ' . $sort . " LIMIT :amount OFFSET :offset";
            $stmt = $this->conBD->prepare($query);

            // Calculamos desde que línea se empieza
            $offset = ($page - 1) * $amount;

            // Vinculamos los parámetros al nombre de la variable especificada
            $stmt->bindParam(":search_value", $value);
            $stmt->bindParam(":amount", $amount, PDO::PARAM_INT);
            $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);

            // Ejecutar la consulta con los parámetros
            $stmt->execute();

            // Devolver las filas resultantes
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Guardar el error en el registro
            Utils::save_log_error("PDOException caught: " . $e->getMessage());
        } catch (Exception $e) {
            // Guardar el error en el registro
            Utils::save_log_error("Unexpected error caught: " . $e->getMessage());
        }

        return false;
    }

    public function save_multiple_imgs(String $animal_id, array $files, String $query)
    {
        $values = [];
        $params = [];
        $uploaded_files = [];
        $result = false;

        try {
            if (!is_array($files['name'])) {
                $file = [
                    'name' => $files['name'],
                    'type' => $files['type'],
                    'tmp_name' => $files['tmp_name'],
                    'error' => $files['error'],
                    'size' => $files['size']
                ];
                $file_path = Utils::save_img($file);

                if ($file_path !== false) {
                    // Creamos un array con los valores para cada registro
                    $values[] = '(?, ?, ?, ?, ?)';
                    // Guardamos en el array de parámetros los valores de cada registro
                    $params[] = $animal_id;
                    $params[] = $file['name'];
                    $params[] = $file['type'];
                    $params[] = $file['size'];
                    $params[] = $file_path;
                    $uploaded_files[] = $file_path;
                }
            } else {
                // Recorremos el array de files 
                foreach ($files['name'] as $key => $filename) {
                    $file = [
                        'name' => $files['name'][$key],
                        'type' => $files['type'][$key],
                        'tmp_name' => $files['tmp_name'][$key],
                        'error' => $files['error'][$key],
                        'size' => $files['size'][$key]
                    ];

                    // Llamamos a la función save_img para subir el archivo a la carpeta y guardamos la ruta que nos devuelve
                    $file_path = Utils::save_img($file);

                    // Si la subida ha ido bien, agregamos los valores y los parámetros para la consulta
                    if ($file_path !== false) {
                        // Creamos un array con los valores para cada registro
                        $values[] = '(?, ?, ?, ?, ?)';
                        // Guardamos en el array de parámetros los valores de cada registro
                        $params[] = $animal_id;
                        $params[] = $file['name'];
                        $params[] = $file['type'];
                        $params[] = $file['size'];
                        $params[] = $file_path;
                        // Añadimos la ruta a la lista de archivos subidos
                        $uploaded_files[] = $file_path;
                    }
                }
            }

            if (!empty($values)) {
                $query_values = implode(', ', $values);
                $query = $query . $query_values;

                $stmt = $this->conBD->prepare($query);

                for ($i = 0; $i < count($params); $i++) {
                    $stmt->bindParam($i + 1, $params[$i]);
                }

                $result = $stmt->execute();
            }
        } catch (Exception $e) {
            // Manejo de errores
            Utils::save_log_error("Unexpected error caught: " . $e->getMessage());
        }

        return ($result) ? true : false;
    }

    public function generatePaginationHTML($page, $amount, $total_pages)
    {

        $html = '<span class="register-amount w-auto text-uppercase p-0" style="letter-spacing: .1em; ">';
        $html .= 'Filas por página:';
        $html .= '<select name="amount" id="amount" class="amount px-1 border-0 cursos-pointer" style="outline: none;" data-page="' . $amount . '">';
        $options = [10, 25, 50];
        foreach ($options as $option) {
            $html .= '<option value="' . $option . '" ' . ($amount == $option ? 'selected' : '') . '>' . $option . '</option>';
        }
        $html .= '</select>';
        $html .= '</span>';
        $html .= '<div class="select-page h-100 w-auto d-flex align-items-center p-0" style="gap:5px;">';

        if ($page != 1) {
            $html .= '<button class="previous bg-transparent border-0" value="' . ($page - 1) . '" style="outline: none; box-shadow:none;" id="previous">';
            $html .= '<i class="fa-solid fa-chevron-left" style="font-size: .7em;"></i>';
            $html .= '</button>';
        } else {
            $html .= '<button class="previous bg-transparent border-0" value="' . $page . '" style="outline: none; box-shadow:none;" id="previous" disabled>';
            $html .= '<i class="fa-solid fa-chevron-left" style="font-size: .7em;"></i>';
            $html .= '</button>';
        }

        $html .= '<select name="page" id="page" class="amount px-1 border-0 cursos-pointer" style="outline: none;">';
        for ($i = 1; $i <= $total_pages; $i++) {
            $html .= '<option value="' . $i . '" ' . ($i == $page ? 'selected' : '') . '>' . $i . '</option>';
        }
        $html .= '</select>';
        $html .= 'de <span class="me-1" id="total_pages">' . $total_pages . '</span>';

        if ($page != $total_pages) {
            $html .= '<button class="next bg-transparent border-0" value="' . ($page + 1) . '" style="outline: none; box-shadow:none;" id="next">';
            $html .= '<i class="fa-solid fa-chevron-right" style="font-size: .7em;"></i>';
            $html .= '</button>';
        } else {
            $html .= '<button class="next bg-transparent border-0" value="' . $page . '" style="outline: none; box-shadow:none;" id="next" disabled>';
            $html .= '<i class="fa-solid fa-chevron-right" style="font-size: .7em;"></i>';
            $html .= '</button>';
        }

        $html .= '</div>';
        return $html;
    }

    // Obtiene el valor de post y si no existe, te devuelve el original
    public function get_value(String $val, String $originalVal)
    {
        if (isset($_POST[$val])) {
            $this->$val = $_POST[$val];
            return $_POST[$val];
        } else {
            return $originalVal;
        }
    }
}
