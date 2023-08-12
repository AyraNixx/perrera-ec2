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
        if (strtoupper($_SESSION["rol"]) == USER_ROL_ADMIN) {
            // Obtenemos todos los registros, tantos los visibles como los no visibles
            $data = $this->animal->pagination_all_with_more_info($this->ord, $this->col, $this->page, $this->amount);
            // Obtenemos el total de páginas de todos los registros, tanto los visibles como los que no
            $total_pages = $this->animal->total_pages("animales", $this->amount);
        } else {
            // Obtenemos todos los registros los visibles
            $data = $this->animal->pagination_visible_with_more_info($this->ord, $this->col, $this->page, $this->amount);
            // Obtenemos el total de páginas de todos los registros, solo los visibles
            $total_pages = $this->animal->total_pages_visibles("animales", $this->amount);
        }
        // Obtenemos todas las especies     
        $data_especies = $this->especie->get_all("especies");
        // La página actual
        $page = $this->getPage();
        // Mensaje
        $new_msg = $this->getMsg();    

        // echo "<pre>";
        // var_dump($page);
        // echo "<h1>-------------------------</h1>";
        // var_dump($data);
        // echo "<h1>-------------------------</h1>";
        // var_dump($data_especies);
        // echo "<h1>-------------------------</h1>";
        // var_dump($total_pages);
        // echo "</pre>";


        require_once "../views/" . $view;

    }

    public function prueba()
    {
        if (strtoupper($_SESSION["rol"]) == USER_ROL_ADMIN) {
            // Obtenemos todos los registros, tantos los visibles como los no visibles
            $data = $this->animal->pagination_all_with_more_info($this->ord, $this->col, $this->page, $this->amount);
            // Obtenemos el total de páginas de todos los registros, tanto los visibles como los que no
            $total_pages = $this->animal->total_pages("animales", $this->amount);
        } else {
            // Obtenemos todos los registros los visibles
            $data = $this->animal->pagination_visible_with_more_info($this->ord, $this->col, $this->page, $this->amount);
            // Obtenemos el total de páginas de todos los registros, solo los visibles
            $total_pages = $this->animal->total_pages_visibles("animales", $this->amount);
        }
        // Obtenemos todas las especies     
        $data_especies = $this->especie->get_all("especies");
        // La página actual
        $page = $this->getPage();
        // Mensaje
        $new_msg = $this->getMsg();   

        // var_dump($this->getOrd());
        // var_dump($this->getCol());

        // require_once "../views/components/PruebaCom.php";
        // require_once "../views/components/pagination.php";
        var_dump($data);
        var_dump($this->getOrd());
        var_dump($this->getCol());
        var_dump($_POST);
    }
}


//Comprobamos que la sesion esta iniciada
session_start();

//Si no tenemos guardado login 
if (!isset($_SESSION["login"])) 
{
    header("Location:../../public/Login.php");
}

$animal = new AnimalC();

$action = !empty($_REQUEST["action"]) ? $_REQUEST["action"] : "index";

if (!empty($_POST["col"])) {
    $animal->setCol($_POST["col"]);
}
if (!empty($_POST["ord"])) {
    $animal->setOrd($_POST["ord"]);
}
if (!empty($_POST["page"])) {
    $animal->setPage($_POST["page"]);
}
if (!empty($_POST["amount"])) {
    $animal->setAmount($_POST["amount"]);
}


$animal->run($action);
