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
    public function getMsg()
    {
        return $this->msg;
    }
    public function setMsg($msg)
    {
        return $this->msg = $msg;
    }
    public function getField()
    {
        return $this->field;
    }
    public function setField($field)
    {
        return $this->field = $field;
    }
    public function getOrd()
    {
        return $this->ord;
    }
    public function setOrd($ord)
    {
        return $this->ord = $ord;
    }
    public function getAmount()
    {
        return $this->amount;
    }
    public function setAmount($amount)
    {
        return $this->amount = $amount;
    }
    public function getPage()
    {
        return $this->page;
    }
    public function setPage($page)
    {
        return $this->page = $page;
    }
    public function getSearch_val()
    {
        return $this->search_val;
    }
    public function setSearch_val($search_val)
    {
        return $this->search_val = $search_val;
    }


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
            case "undelete":
                $this->undelete();
                break;
            case "pagination":
                $this->pagination();
                break;
            case "generate_species_sel":
                $this->generate_species_sel();
                break;
            case "show_delete_rows":
                $this->show_delete_rows();
                break;
            default:
                $this->index();
                break;
        }
    }


    private function index($view = 'V_Especies.php')
    {
        if (!isset($_REQUEST['id'])) {
            $data = $this->especie->pagination_visible('especies', $this->ord, $this->field, $this->page, $this->amount);
            $total_pages = $this->especie->total_pages_visibles('especies', $this->amount);
            $page = $this->getPage();
            $new_msg = $this->getMsg();
            require_once "../views/" . $view;
        } else {
            $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8');
            $this->show_register($id);
        }
    }

    public function show_register($id = '')
    {
        if ((isset($_REQUEST['id']) && !empty($_REQUEST['id'])) || !empty($id)) {
            $id = isset($_REQUEST['id']) ? htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8') : htmlspecialchars(trim($id), ENT_QUOTES, 'UTF-8');
            $data = $this->especie->queryParam(Constants::GET_ESPECIE, ['id' => $id])[0];
            $new_msg = $this->getMsg();
            require_once Constants::VIEW_ESPECIE;
        }
    }

    private function add()
    {
        if (!isset($_REQUEST['nombre']) || !isset($_REQUEST['descripcion'])) {
            header('Location: EspecieC.php?msg=' . Constants::ERROR_INSERT);
            exit();
        }

        $nombre = htmlspecialchars(trim($_REQUEST['nombre']), ENT_QUOTES, 'UTF-8');
        $desc = htmlspecialchars(trim($_REQUEST['descripcion']), ENT_QUOTES, 'UTF-8');

        $result = $this->especie->insert(['nombre' => $nombre, 'descripcion' => $desc]);

        if ($result == false) {
            $this->setMsg(Constants::ERROR_INSERT);
            header('Location: EspecieC.php?msg=' . Constants::ERROR_INSERT);
            exit();
        }

        header('Location: EspecieC.php?id=' . $result);
        exit();
    }

    private function update()
    {
        if (!isset($_REQUEST['nombre']) || !isset($_REQUEST['descripcion']) || !isset($_REQUEST['id'])) {
            header('Location: EspecieC.php?msg=' . Constants::ERROR_UPDATE);
            exit();
        }

        $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8');
        $nombre = htmlspecialchars(trim($_REQUEST['nombre']), ENT_QUOTES, 'UTF-8');
        $desc = htmlspecialchars(trim($_REQUEST['descripcion']), ENT_QUOTES, 'UTF-8');

        $result = $this->especie->queryParam(Constants::UPDT_ESPECIE, ['id' => $id, 'nombre' => $nombre, 'descripcion' => $desc]);

        if ($result == false) {
            $this->setMsg(Constants::ERROR_UPDATE);
            header('Location: EspecieC.php?msg=' . Constants::ERROR_UPDATE . '&id=' . $id);
            exit();
        }

        header('Location: EspecieC.php?id=' . $id);
        exit();
        $this->setMsg(Constants::ERROR_UPDATE);
    }

    private function sdelete()
    {
        if (!isset($_REQUEST['id'])) {
            $this->setMsg(base64_encode(Constants::ERROR_DELETE));
            header('Location: EspecieC.php?msg=' . $this->getMsg());
            exit();
        }
        $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8');
        $data_bd = $this->especie->queryParam(Constants::GET_ESPECIE, ['id' => $id]);

        if ($data_bd == null || $data_bd == false) {
            $this->setMsg(base64_encode(Constants::ERROR_ROW_NOT_FOUND));
            header('Location: EspecieC.php?msg=' . $this->getMsg());
            exit();
        }
        // $result = $this->especie->queryParam(Constants::DELETE_ESPECIE, ['id' => $id]);
        $result = $this->especie->soft_delete_especie($id);

        if ($result == false) {
            $this->setMsg(base64_encode(Constants::ERROR_DELETE));
            header('Location: EspecieC.php?msg=' . $this->getMsg()); // TO DO!!!
            exit();
        }

        $this->setMsg(base64_encode(Constants::DELETE_ROW));
        header('Location: EspecieC.php?msg=' . $this->getMsg()); // TO DO!!!
        exit();
    }

    private function undelete()
    {
        if (!isset($_REQUEST['id'])) {
            $this->setMsg(base64_encode(Constants::ERROR_UNDELETE));
            header('Location: EspecieC.php?msg=' . $this->getMsg());
            exit();
        }
        $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8');
        $data_bd = $this->especie->queryParam(Constants::GET_ESPECIE, ['id' => $id]);

        if ($data_bd == null || $data_bd == false) {
            $this->setMsg(base64_encode(Constants::ERROR_ROW_NOT_FOUND));
            header('Location: EspecieC.php?msg=' . $this->getMsg());
            exit();
        }
        $result = $this->especie->queryParam(Constants::UPDT_UNDELETE_ESPECIES, ['id' => $id]);

        if ($result == false) {
            $this->setMsg(base64_encode(Constants::ERROR_UNDELETE));
            header('Location: EspecieC.php?msg=' . $this->getMsg()); // TO DO!!!
            exit();
        }

        $this->setMsg(base64_encode(Constants::UNDELETE_ROW));
        header('Location: EspecieC.php?msg=' . $this->getMsg()); // TO DO!!!
        exit();
    }

    private function pagination()
    {
        // Obtenemos los valores nuevos (si es que hay)
        $this->ord = $this->especie->get_value("ord", $this->ord);
        $this->field = $this->especie->get_value("field", $this->field);
        $this->amount = $this->especie->get_value("amount", $this->amount);
        $this->page = $this->especie->get_value("page", $this->page);
        $this->search_val = (isset($_POST['search_value']) && !empty($_POST['search_value']) && $_POST['search_value'] != '' && $_POST['search_value'] != null) ? ('%' . $this->especie->get_value("search_value", $_POST['search_value']) . '%') : false;

        $data = ($this->search_val) ? ($this->especie->queryParamSearch(Constants::SEARCH_ESPECIES_TABLE, $this->search_val, $this->ord, $this->field, $this->page, $this->amount)) : ($this->especie->pagination_visible('especies', $this->ord, $this->field, $this->page, $this->amount));
        $total_pages = ($this->search_val) ? ceil(count($this->especie->queryParam(Constants::SEARCH_ESPECIES_TABLE_TOTAL_PAGES, ['search_value' => $this->search_val])) / $this->amount) : $this->especie->total_pages_visibles("especies", $this->amount);
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
            $html_var .= "<td style=>" . $show_data["descripcion"] . "</td>";
            $html_var .= "<td class='ps-4 pe-2'>";
            $html_var .= '<a href="../controllers/EspecieC.php?action=show_register&id=' . $show_data['id'] . '" class="btn btn-primary text-white btn-sm me-1">Ver</a>';
            $html_var .= '<a href="../controllers/EspecieC.php?action=sdelete&id=' . $show_data['id'] . '" class="btn btn-danger text-white btn-sm me-1">Borrar</a>';            
            $html_var .= "</td>";
            $html_var .= "</tr>";
        }

        echo json_encode(array("total_pages" => $total_pages, "rows" => $html_var, 'pagination' => $this->especie->generatePaginationHTML($page, $this->amount, $total_pages)));
    }

    private function generate_species_sel()
    {
        echo json_encode($this->especie->query(Constants::GET_ESPECIES));
    }

    private function show_delete_rows()
    {
        echo json_encode($this->especie->query(Constants::GET_ESPECIES_INACTIVE));
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
