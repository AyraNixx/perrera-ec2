<?php

use utils\Utils;
use \model\Especie;
use utils\Constants;

// use \Exception;

require_once "../utils/Utils.php";
require_once "../utils/Constants.php";
require_once "../models/Especie.php";

class EspecieC
{
    // 
    // -- ATRIBUTOS
    // 
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
    // -- ATRIBUTOS PARA LA BÚSQUEDA
    //
    private $search_val;


    // 
    // -- CONSTRUCTOR
    // 
    function __construct()
    {
        $this->especie = new Especie();
        $this->msg = null;

        $this->field = "nombre";
        $this->ord = "ASC";
        $this->amount = "10";
        $this->page = "1";
    }

    // 
    // -- GETTERS AND SETTERS
    // 
    public function getMsg() { return $this->msg; }
    public function setMsg($msg) { return $this->msg = $msg; }
    public function getField() { return $this->field; }
    public function setField($field) { return $this->field = $field; }
    public function getOrd(){ return $this->ord; }
    public function setOrd($ord) { return $this->ord = $ord; } 
    public function getAmount() { return $this->amount; } 
    public function setAmount($amount) { return $this->amount = $amount; } 
    public function getPage() { return $this->page; } 
    public function setPage($page) { return $this->page = $page; } 
    public function getSearch_val() { return $this->search_val; } 
    public function setSearch_val($search_val) { return $this->search_val = $search_val; }


    // 
    // -- MÉTODOS
    // 


    public function run(String $action = "index")
    {
        switch ($action) {
            case "index":
                $this->index();
                break;
            case "show_register":
                $this->show_register();
                break;
            case 'add':
                $this->add();
                break;
            case "update":
                $this->update();
                break;
            case "sdelete":
                $this->sdelete();
                break;
            case "pagination":
                $this->pagination();
                break;
            case "generate_species_sel":
                $this->generate_species_sel();
                break;
        }
    }


    private function index($view = 'V_Especies.php')
    {
        if (strtoupper($_SESSION["rol"]) == USER_ROL_ADMIN) {
            $data = $this->especie->pagination_all('especies', $this->ord, $this->field, $this->page, $this->amount);
            $total_pages = $this->especie->total_pages('especies', $this->amount);
        } else {
            $data = $this->especie->pagination_visible('especies', $this->ord, $this->field, $this->page, $this->amount);
            $total_pages = $this->especie->total_pages_visibles('especie', $this->amount);
        }
        $page = $this->getPage();
        $new_msg = $this->getMsg();
        require_once "../views/" . $view;
    }

    public function show_register($id = '')
    {
        if ((isset($_REQUEST['id']) && !empty($_REQUEST['id'])) || !empty($id)) {
            $id = isset($_REQUEST['id']) ? htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8') : htmlspecialchars(trim($id), ENT_QUOTES, 'UTF-8');
            $data = $this->especie->queryParam(Constants::GET_ESPECIE, ['id' => $id])[0];
            require_once Constants::VIEW_ESPECIE;
        }
    }

    private function add()
    {
        if (isset($_REQUEST['nombre']) && isset($_REQUEST['descripcion'])) {
            $nombre = htmlspecialchars(trim($_REQUEST['nombre']), ENT_QUOTES, 'UTF-8');
            $desc = htmlspecialchars(trim($_REQUEST['descripcion']), ENT_QUOTES, 'UTF-8');
            $result = $this->especie->insert(['nombre' => $nombre, 'descripcion' => $desc]);

            if ($result == false) {
                $this->setMsg(Constants::ERROR_INSERT);
            }
            // $this->index();
            $this->show_register($result);
        } else {
            $this->setMsg(Constants::ERROR_INSERT);
        }
    }

    private function update()
    {
        if (isset($_REQUEST['nombre']) && isset($_REQUEST['descripcion']) && isset($_REQUEST['id'])) {
            $nombre = htmlspecialchars(trim($_REQUEST['nombre']), ENT_QUOTES, 'UTF-8');
            $desc = htmlspecialchars(trim($_REQUEST['descripcion']), ENT_QUOTES, 'UTF-8');
            $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8');
            $result = $this->especie->queryParam(Constants::UPDT_ESPECIE, ['id' => $id, 'nombre' => $nombre, 'descripcion' => $desc]);
            if ($result == false) {
                $this->setMsg(Constants::ERROR_UPDATE);
            }
            // $this->index();  // TO DO!!!!!
            $this->show_register($result);
        } else {
            $this->setMsg(Constants::ERROR_UPDATE);
        }
    }

    private function sdelete()
    {
        if (isset($_REQUEST['id'])) {
            $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8');
            $result = $this->especie->queryParam(Constants::DELETE_ESPECIE, ['id' => $id]);
            $this->setMsg("Registro borrado con éxito.");
            if ($result == false) {
                $this->setMsg(Constants::ERROR_DELETE);
            }
            $this->index();  // TO DO!!!!!
        } else {
            $this->setMsg(Constants::ERROR_DELETE);
        }
    }

    private function pagination()
    {
        // Obtenemos los valores nuevos (si es que hay)
        $this->ord = $this->especie->get_value("ord", $this->ord);
        $this->field = $this->especie->get_value("field", $this->field);
        $this->amount = $this->especie->get_value("amount", $this->amount);
        $this->page = $this->especie->get_value("page", $this->page);
        $this->search_val = (isset($_POST['search_value']) && !empty($_POST['search_value']) && $_POST['search_value'] != '' && $_POST['search_value'] != null) ? ('%' . $this->especie->get_value("search_value", $_POST['search_value']) . '%') : false;

        $data = ($this->search_val) ? ($this->especie->queryParamSearch(Constants::SEARCH_ESPECIES_TABLE, $this->search_val, $this->ord, $this->field, $this->page, $this->amount)) : ($this->especie->pagination_all('especies', $this->ord, $this->field, $this->page, $this->amount));
        $total_pages = ($this->search_val) ? ceil(count($this->especie->queryParam(Constants::SEARCH_ESPECIES_TABLE_TOTAL_PAGES, ['search_value' => $this->search_val])) / $this->amount) : ((strtoupper($_SESSION["rol"]) == USER_ROL_ADMIN)  ? $this->especie->total_pages("especies", $this->amount) : $this->especie->total_pages_visibles("especies", $this->amount));
        $total_pages = ($total_pages == 0) ? 1 : $total_pages;

        // La página actual
        $page = $this->getPage();
        $html_var = '';

        // Recorremos el array data y concatenamos el HTML generado dinámicamente
        foreach ($data as $show_data) {
            $url = "EspecieC.php"; //URL destino

            // Concatenamos el HTML generado dinámicamente
            $html_var .= "<tr>";
            $html_var .= "<td class='sticky-column' id='showRegister' value='" . $show_data["id"] . "'> <a href='?id=" . $show_data["id"] . "&action=show_register'>" . $show_data["nombre"] . "</a> </td>";
            $html_var .= "<td style='white-space: pre-line;'>" . $show_data["descripcion"] . "</td>";
            $html_var .= "<td>" . (($show_data["disponible"] == '0') ? 'SI' : 'NO') . "</td>";
            $html_var .= "<td class='ps-4 pe-2'>";
            $html_var .= "<div class='btn-group dropdown d-block' style='position:relative'>";
            $html_var .= "<button type='button' onclick='show_btn_options(event)' id='add' class='button-dropdown rounded' style='padding: .8em;width: 1.3em;height: 1.3em;'>";
            $html_var .= "<i class='fa-solid fa-caret-down text-primary'></i>";
            $html_var .= "</button>";
            $html_var .= "<div class='btn-dropdown-options w-auto position-absolute start-0'>";
            $html_var .= "<ul class='list-unstyled m-0'>";
            $html_var .= "<li>";
            $html_var .= "<a href='../controllers/EspecieC.php?action=add_or_update&id=" . $show_data["id"] . "'>Editar</a>";
            $html_var .= "</li>";
            $html_var .= "<li>";
            $html_var .= "<a href='../controllers/EspecieC.php?action=sdelete&id=" . $show_data["id"] . "'>Borrar</a>";
            $html_var .= "</li>";
            if ($_SESSION["rol"] == Constants::ROL_ADMIN && $show_data["disponible"] == '0') {
                $html_var .= "<li>";
                $html_var .= "<a href='../controllers/EspecieC.php?action=undelete&id=" . $show_data["id"] . "'>Recuperar registro</a>";
                $html_var .= "</li>";
            }
            $html_var .= "</ul>";
            $html_var .= "</div>";
            $html_var .= "</div>";
            $html_var .= "</td>";
            $html_var .= "</tr>";
        }

        echo json_encode(array("total_pages" => $total_pages, "rows" => $html_var, 'pagination' => $this->especie->generatePaginationHTML($page, $this->amount, $total_pages)));
    }

    private function generate_species_sel()
    {
        echo json_encode($this->especie->query(Constants::GET_ESPECIE));
    }
}

//Comprobamos que la sesion esta iniciada
session_start();
//Si no tenemos guardado login 
if (!Utils::is_logged_in()) {
    header("Location:../../public/Login.php");
    die;
}
$especie = new EspecieC();

$action = !empty($_REQUEST["action"]) ? $_REQUEST["action"] : "index";
if (!empty($_POST["field"])) {
    $especie->setField($_POST["field"]);
}
if (!empty($_POST["ord"])) {
    $especie->setOrd($_POST["ord"]);
}
if (!empty($_POST["page"])) {
    $especie->setPage($_POST["page"]);
}
if (!empty($_POST["amount"])) {
    $especie->setAmount($_POST["amount"]);
}
$especie->run($action);
