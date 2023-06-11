<?php

use utils\Utils;
use \model\Animal;
use \model\Especie;
use \model\Jaula;
// use \Exception;

require_once "../utils/Utils.php";
require_once "../models/Animal.php";
require_once "../models/Especie.php";
require_once "../models/Jaula.php";

class AnimalC
{


    // 
    // -- CONSTANTES
    // 
    const ERROR_INSERT = "No se ha podido introducir el nuevo registro a la base de datos. Revisa los datos introducidos";
    const ERROR_UPDATE = "No se ha podido modificar el registro.";
    const ERROR_DELETE = "No se ha podido eliminar el elemento.";
    const VIEW_ANIMAL = "V_Animales.php";
    const VIEW_UPDATE_EDIT = "../views/update_or_add_animal.php";


    // 
    // -- ATRIBUTOS
    // 
    private $animal;
    private $especie;
    private $msg;

    //
    // -- ATRIBUTOS PARA LA PAGINACIÓN
    //
    private $field;
    private $ord;
    private $amount;
    private $page;



    // 
    // -- CONSTRUCTOR
    // 
    function __construct()
    {
        $this->animal = new Animal();
        $this->especie = new Especie();
        $this->msg = null;

        $this->field = "nombre";
        $this->ord = "ASC";
        $this->amount = "10";
        $this->page = "1";
    }



    /**
     * Get the value of msg
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * Set the value of msg
     *
     * @return  self
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;

        return $this;
    }

    /**
     * Get the value of field
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Set the value of field
     *
     * @return  self
     */
    public function setField($field)
    {
        $this->field = $field;

        return $this;
    }

    /**
     * Get the value of ord
     */
    public function getOrd()
    {
        return $this->ord;
    }

    /**
     * Set the value of ord
     *
     * @return  self
     */
    public function setOrd($ord)
    {
        $this->ord = $ord;

        return $this;
    }

    /**
     * Get the value of amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set the value of amount
     *
     * @return  self
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get the value of page
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set the value of page
     *
     * @return  self
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    // 
    // -- MÉTODOS
    // 


    /**
     * Dependiendo de la acción pasada, se realizará llamará a una función u otra
     * 
     * @param String $action Acción que se va a realizar 
     */
    public function run(String $action = "index")
    {
        switch ($action) {
                // Si es index
            case "index":
                // Llama a la función index
                $this->index();
                break;
            case "add":
                // Llama a la función add
                $this->add();
                break;
                // Si es update
            case "update":
                // Llama a la función update
                $this->update();
                break;
                // Si es sdelete
            case "sdelete":
                // Llama a la función soft_delete()
                $this->sdelete();
                break;
                // Si es delete
            case "delete":
                // Llama a la funcion delete
                $this->delete();
                break;
                // Por defecto, llamará a la función index
            case "show_cages":
                $this->show_cages_available();
                break;
            // case "filter":
            //     $this->filter_data();
            //     break;
            case "pagination":
                $this->pagination();
                break;
            default:
                $this->index();
                break;
        }
    }

    public function index($view = "V_Animales.php")
    {
        // Obtenemos todos los animales visibles
        $animales_visibles = $this->animal->pagination_visible_with_more_info($this->ord, $this->field, $this->page, $this->amount);
        // Obtenemos todos los animales
        $animales = $this->animal->pagination_all_with_more_info($this->ord, $this->field, $this->page, $this->amount);
        $data_especies = $this->especie->get_all("especies");
        $total_pages = $this->animal->total_pages_visibles("animales", $this->amount);
        // echo "<pre>";
        // var_dump($animales_visibles);
        // echo "</pre>";
        // Mostramos la vista
        $this->view($animales_visibles, ["animales" => $animales, "especies" => $data_especies, "total_pages" => $total_pages], $view);
    }

    public function add()
    {
        // Comprobamos que los campos no estén vacíos
        if (
            isset($_POST["nombre"]) && isset($_POST["especies_id"]) && isset($_POST["raza"])
            && isset($_POST["genero"]) && isset($_POST["tamanio"]) && isset($_POST["peso"]) && isset($_POST["colores"])
            && isset($_POST["personalidad"]) && isset($_POST["fech_nac"]) && isset($_POST["estado_adopcion"])
            && isset($_POST["estado_salud"]) && isset($_POST["necesidades_especiales"]) && isset($_POST["otras_observaciones"])
            && isset($_POST["jaulas_id"])
        ) {
            // Creamos un nuevo array
            $new_animal = [];
            // Guardamos los valores del Post
            $new_animal["nombre"] = $_POST["nombre"];
            $new_animal["especies_id"] = $_POST["especies_id"];
            $new_animal["raza"] = $_POST["raza"];
            $new_animal["genero"] = $_POST["genero"];
            $new_animal["tamanio"] = $_POST["tamanio"];
            $new_animal["peso"] = $_POST["peso"];
            $new_animal["colores"] = implode(',', $_POST["colores"]);
            $new_animal["personalidad"] = implode(',', $_POST["personalidad"]);
            $new_animal["fech_nac"] = $_POST["fech_nac"];
            $new_animal["estado_adopcion"] = $_POST["estado_adopcion"];
            $new_animal["estado_salud"] = $_POST["estado_salud"];
            $new_animal["necesidades_especiales"] = $_POST["necesidades_especiales"];
            $new_animal["otras_observaciones"] = $_POST["otras_observaciones"];
            $new_animal["jaulas_id"] = $_POST["jaulas_id"];

            // Le pasamos el array como valor para el atributo privado del modelo Animal
            $this->animal->setAnimal($new_animal);

            // Insertamos el nuevo registro y guardamos el resultado
            $result = $this->animal->add();

            // Si algo ha ido mal, guardamos mensaje y mostramos la página de Animales
            if ($result == null) {
                $this->setMsg(self::ERROR_INSERT);
            }
            $this->index();
        }
    }

    public function update()
    {
        // Comprobamos que los campos no estén vacíos
        if (
            isset($_POST["nombre"]) && isset($_POST["especies_id"]) && isset($_POST["raza"])
            && isset($_POST["genero"]) && isset($_POST["tamanio"]) && isset($_POST["peso"]) && isset($_POST["colores"])
            && isset($_POST["personalidad"]) && isset($_POST["fech_nac"]) && isset($_POST["estado_adopcion"])
            && isset($_POST["estado_salud"]) && isset($_POST["necesidades_especiales"]) && isset($_POST["otras_observaciones"])
            && isset($_POST["jaulas_id"])
        ) {
            // Creamos un nuevo array
            $new_animal = [];
            // Guardamos los valores del Post
            $new_animal["id"] = $_POST["id"];
            $new_animal["nombre"] = $_POST["nombre"];
            $new_animal["especies_id"] = $_POST["especies_id"];
            $new_animal["raza"] = $_POST["raza"];
            $new_animal["genero"] = $_POST["genero"];
            $new_animal["tamanio"] = $_POST["tamanio"];
            $new_animal["peso"] = $_POST["peso"];
            $new_animal["colores"] = implode(',', $_POST["colores"]);
            $new_animal["personalidad"] = implode(',', $_POST["personalidad"]);
            $new_animal["fech_nac"] = $_POST["fech_nac"];
            $new_animal["estado_adopcion"] = $_POST["estado_adopcion"];
            $new_animal["estado_salud"] = $_POST["estado_salud"];
            $new_animal["necesidades_especiales"] = $_POST["necesidades_especiales"];
            $new_animal["otras_observaciones"] = $_POST["otras_observaciones"];
            $new_animal["jaulas_id"] = $_POST["jaulas_id"];

            // Le pasamos el array como valor para el atributo privado del modelo Animal
            $this->animal->setAnimal($new_animal);

            // Insertamos el nuevo registro y guardamos el resultado
            $result = $this->animal->update();

            // Si algo ha ido mal, guardamos mensaje y mostramos la página de Animales
            if ($result == null) {
                $this->setMsg(self::ERROR_UPDATE);
            }
            $this->index();
        }
    }

    public function sdelete()
    {
        // Comprobamos que el campo id no esté vacío
        if (
            isset($_POST["id"])
        ) {

            // Guardamos el id pasado por POST
            $id = $_POST["id"];

            // Hacemos soft delte llamando a la función soft_delete
            $resultado = $this->animal->soft_delete("animales", $id);

            // Si algo ha ido mal, guardamos mensaje y mostramos la página de Animales
            if ($resultado == null) {
                $this->setMsg(self::ERROR_DELETE);
            }
            $this->setMsg("Registro borrado con éxito.");
            $this->index();
        }
    }

    public function delete()
    {
        // Comprobamos que el campo id no esté vacío
        if (
            isset($_POST["id"])
        ) {
            // Guardamos el id pasado por POST
            $id = $_POST["id"];
            // Hacemos soft delte llamando a la función soft_delete
            $result = $this->animal->delete("animales", $id);

            // Si algo ha ido mal, guardamos mensaje y mostramos la página de Animales
            if ($result == null) {
                $this->msg = self::ERROR_INSERT;
            }
            $this->index();
        }
    }

    public function show_cages_available()
    {
        // Comprobamos que el campo id no esté vacío
        if (
            isset($_POST["especies_id"])
        ) {
            // Si no lo está, guardamos el valor
            $especie = $_POST["especies_id"];

            // Llamamos a la función get_cages_available para obtener las jaulas disponibles
            // para la especie indicada
            $jaulas = $this->animal->get_cages_available($especie);
            // Devolvemos el null o las jaulas dependiendo del resultado obtenido de la función
            // anterior
            echo (($jaulas == null) ? null : json_encode($jaulas));
        }
    }

    public function filter_data()
    {
        if (isset($_POST["field"]) && isset($_POST["value_field"])) {
            // Guardamos los valores
            $field = $_POST["field"];
            $value_field = $_POST["value_field"];

            // Llamamos a la función y guardamos el resultado obtenido
            $data_visible = $this->animal->filter_table($field, $value_field);

            if ($data_visible == null) {
                $this->msg = self::ERROR_INSERT;
            }
            include "../views/components/animalList.php";
            // Devolver los registros en formato JSON
            // header('Content-Type: application/json');
            // echo json_encode($result);
        } else {
            $this->index("/components/animalList.php");
        }
    }

    public function pagination()
    {
        var_dump($_POST);

        // Obtenemos los valores nuevos (si es que hay)
        $this->ord = $this->get_value("ord", $this->ord);
        $this->field = $this->get_value("field", $this->field);
        $this->amount = $this->get_value("amount", $this->amount);
        $this->page = $this->get_value("page", $this->page);

        // Obtenemos todos los animales visibles
        $animales_visibles = $this->animal->pagination_visible_with_more_info($this->ord, $this->field, $this->page, $this->amount);
        // Obtenemos todos los animales
        $animales = $this->animal->pagination_all_with_more_info($this->ord, $this->field, $this->page, $this->amount);
        $data_especies = $this->especie->get_all("especies");
        $total_pages = $this->animal->total_pages_visibles("animales", $this->amount);
    }

    public function get_value(String $val, String $originalVal)
    {
        if (isset($_POST[$val])) {
            return $_POST[$val];
        } else {
            return $originalVal;
        }
    }

    public function view(array $datos_visibles, array $datos, String $view)
    {

        $data_visible = $datos_visibles;
        $data = $datos["animales"];
        $data_especies = $datos["especies"];
        $total_pages = $datos["total_pages"];

        $new_msg = $this->getMsg();

        require_once "../views/" . $view;
    }
}


$animal = new AnimalC();

if (!empty($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
    // echo json_encode($_POST); // Codificar $_POST como JSON y enviarlo como respuesta
} else {
    $action = "index";
}

$animal->run($action);
