<?php

use utils\Utils;
use \model\Animal;
use \model\Especie;
use \model\Jaula;
// use \Exception;

require_once "../utils/Utils.php";
require_once "../utils/Constants.php";
require_once "../models/Animal.php";
require_once "../models/Especie.php";
require_once "../models/Jaula.php";

class AnimalC
{
    // 
    // -- ATRIBUTOS
    // 
    private $animal;
    private $especie;
    private $msg;

    //
    // -- ATRIBUTOS PARA LA PAGINACIÓN
    //
    private $col;
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

        $this->col = "nombre";
        $this->ord = "ASC";
        $this->amount = "10";
        $this->page = "1";
    }


    public function getMsg()
    {
        return $this->msg;
    }
    public function setMsg($msg)
    {
        $this->msg = $msg;

        return $this;
    }
    public function getCol()
    {
        return $this->col;
    }
    public function setCol($col)
    {
        $this->col = $col;

        return $this;
    }
    public function getOrd()
    {
        return $this->ord;
    }
    public function setOrd($ord)
    {
        $this->ord = $ord;

        return $this;
    }
    public function getAmount()
    {
        return $this->amount;
    }
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }
    public function getPage()
    {
        return $this->page;
    }

   
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
            case "pagination":
                $this->pagination();
                break;
            case "prueba":
                $this->prueba();
                break;
            default:
                $this->index();
                break;
        }
    }

    public function index($view = "PruebaV.php")
    {
        // Obtenemos todos los animales visibles
        $animales_visibles = $this->animal->pagination_visible_with_more_info($this->ord, $this->col, $this->page, $this->amount);
        // Obtenemos todos los animales
        $animales = $this->animal->pagination_all_with_more_info($this->ord, $this->col, $this->page, $this->amount);
        $data_especies = $this->especie->get_all("especies");
        $total_pages = $this->animal->total_pages_visibles("animales", $this->amount);
        // echo "<pre>";
        // var_dump($animales_visibles);
        // echo "</pre>";
        // Mostramos la vista
        $this->view($animales_visibles, ["animales" => $animales, "especies" => $data_especies, "total_pages" => $total_pages], $view);
    }


    // Te lleva a la vista
    public function view(array $datos_visibles, array $datos, String $view)
    {

        $data_visible = $datos_visibles;
        $data = $datos["animales"];
        $data_especies = $datos["especies"];
        $total_pages = $datos["total_pages"];
        $page = $this->page;

        $new_msg = $this->getMsg();

        require_once "../views/" . $view;
    }

    public function prueba()
    {
        echo "hola";
    }
}


$animal = new AnimalC();

$action = !empty($_REQUEST["action"]) ? $_REQUEST["action"] : "index";

if(!empty($_POST["col"])){ $animal->setCol($_POST["col"]);}
if(!empty($_POST["ord"])){ $animal->setOrd($_POST["ord"]);}
if(!empty($_POST["page"])){ $animal->setPage($_POST["page"]);}
if(!empty($_POST["amount"])){ $animal->setAmount($_POST["amount"]);}


$animal->run($action);
