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
    const VIEW_ANIMAL = "../views/V_Animales.php";
    const VIEW_UPDATE_EDIT = "../views/update_or_add_animal.php";


    // 
    // -- ATRIBUTOS
    // 
    private $animal;
    private $msg;



    // 
    // -- CONSTRUCTOR
    // 
    function __construct()
    {
        $this->animal = new Animal();
        $this->msg = null;
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
                // Si es insert
            case "add_or_update":
                $this->add_or_update();
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
            default:
                $this->index();
                break;
        }
    }

    public function index($view = "V_Animales.php", String $ord = "ASC", String $field = "nombre", int $page = 1, int $amount = 10)
    {
        // Obtenemos todos los animales visibles
        $animales_visibles = $this->animal->pagination_visible_with_more_info($ord, $field, $page, $amount);
        // Obtenemos todos los animales
        $animales = $this->animal->pagination_all_with_more_info($ord, $field, $page, $amount);

        // echo "<pre>";
        // var_dump($animales_visibles);
        // echo "</pre>";
        // Mostramos la vista
        $this->view($animales_visibles, $animales, $view);
    }


    public function add_or_update()
    {
        // Intanciamos un objeto de la clase Especie
        $especies = new Especie();
        // Intanciamos un objeto de la clase Jaula
        // $jaulas = new Jaula();

        $data_especies = $especies->get_all("especies");
        // Creamos una nueva variable, por defecto es uno que significa insert
        $action = 1;

        // Comprobamos que los campos no estén vacíos
        if (
            isset($_POST["id"]) && isset($_POST["nombre"]) && isset($_POST["especie"]) && isset($_POST["raza"])
            && isset($_POST["genero"]) && isset($_POST["tamanio"]) && isset($_POST["peso"]) && isset($_POST["colores"])
            && isset($_POST["personalidad"]) && isset($_POST["fech_nac"]) && isset($_POST["estado_adopcion"])
            && isset($_POST["estado_salud"]) && isset($_POST["necesidades_especiales"]) && isset($_POST["otras_observaciones"])
            && isset($_POST["jaula"])
        ) {
            // Creamos un nuevo array
            $update = [];
            // Guardamos los valores del Post
            $update["id"] = $_POST["id"];
            $update["nombre"] = $_POST["nombre"];
            $update["especie"] = $_POST["especie"];
            $update["raza"] = $_POST["raza"];
            $update["genero"] = $_POST["genero"];
            $update["tamanio"] = $_POST["tamanio"];
            $update["peso"] = $_POST["peso"];
            $update["colores"] = $_POST["colores"];
            $update["personalidad"] = $_POST["personalidad"];
            $update["fech_nac"] = $_POST["fech_nac"];
            $update["estado_adopcion"] = $_POST["estado_adopcion"];
            $update["estado_salud"] = $_POST["estado_salud"];
            $update["necesidades_especiales"] = $_POST["necesidades_especiales"];
            $update["otras_observaciones"] = $_POST["otras_observaciones"];
            $update["jaula"] = $_POST["jaula"];

            // Si entra en este condicional, significa que Post no está vacío y que se trata de una actualizacion
            $action = 2;
        }

        // Incluimos la vista de crear y modificar
        require_once SELF::VIEW_UPDATE_EDIT;
    }

    public function add()
    {
        // Comprobamos que los campos no estén vacíos
        if (
            isset($_POST["nombre"]) && isset($_POST["especie"]) && isset($_POST["raza"])
            && isset($_POST["genero"]) && isset($_POST["tamanio"]) && isset($_POST["peso"]) && isset($_POST["colores"])
            && isset($_POST["personalidad"]) && isset($_POST["fech_nac"]) && isset($_POST["estado_adopcion"])
            && isset($_POST["estado_salud"]) && isset($_POST["necesidades_especiales"]) && isset($_POST["otras_observaciones"])
            && isset($_POST["jaula"])
        ) {
            // Creamos un nuevo array
            $new_animal = [];
            // Guardamos los valores del Post
            $new_animal["nombre"] = $_POST["nombre"];
            $new_animal["especie"] = $_POST["especie"];
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
            $new_animal["jaula"] = $_POST["jaula"];

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
            isset($_POST["nombre"]) && isset($_POST["especie"]) && isset($_POST["raza"])
            && isset($_POST["genero"]) && isset($_POST["tamanio"]) && isset($_POST["peso"]) && isset($_POST["colores"])
            && isset($_POST["personalidad"]) && isset($_POST["fech_nac"]) && isset($_POST["estado_adopcion"])
            && isset($_POST["estado_salud"]) && isset($_POST["necesidades_especiales"]) && isset($_POST["otras_observaciones"])
            && isset($_POST["jaula"])
        ) {
            // Creamos un nuevo array
            $new_animal = [];
            // Guardamos los valores del Post
            $new_animal["id"] = $_POST["id"];
            $new_animal["nombre"] = $_POST["nombre"];
            $new_animal["especie"] = $_POST["especie"];
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
            $new_animal["jaula"] = $_POST["jaula"];

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

    // public function details()
    // {
    // }
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
            // var_dump($jaulas);
            echo (($jaulas == null) ? null : json_encode($jaulas));
        }
    }

    public function view(array $datos_visibles, array $datos, String $view)
    {
        $data_visible = $datos_visibles;
        $data = $datos;

        $new_msg = $this->getMsg();

        require_once "../views/" . $view;
    }
}


$animal = new AnimalC();

if (!empty($_POST["action"])) {
    $action = $_POST["action"];
} else {
    $action = "index";
}
$animal->run($action);
