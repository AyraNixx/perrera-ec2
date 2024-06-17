<?php

use utils\Utils;
use \model\Rol;
use utils\Constants;

// use \Exception;

require_once "../utils/Utils.php";
require_once "../utils/Constants.php";
require_once "../models/Rol.php";

class RolC
{
    // 
    // -- ATRIBUTOS
    // 
    private $rol;
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
        $this->rol = new Rol();
        $this->msg = null;

        $this->field = "rol";
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
                case "show_delete_rows":
                    $this->show_delete_rows();
                    break;
            case "pagination":
                $this->pagination();
                break;
            default:
                $this->index();
                break;
                // case "generate_species_sel":
                //     $this->generate_species_sel();
                //     break;
        }
    }


    private function index($view = 'V_Roles.php')
    {
        if (!isset($_REQUEST['id'])) {
            $data = $this->rol->pagination_visible('roles', $this->ord, $this->field, $this->page, $this->amount);
            $total_pages = $this->rol->total_pages_visibles('roles', $this->amount);
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
            $data = $this->rol->queryParam(Constants::GET_ROL, ['id' => $id])[0];
            $new_msg = $this->getMsg();
            require_once Constants::VIEW_ROL;
        }
    }

    private function add()
    {
        if (!isset($_REQUEST['rol']) || !isset($_REQUEST['descripcion'])) {
            header('Location: RolC.php?msg=' . Constants::ERROR_INSERT);
            exit();
        }
        $rol = htmlspecialchars(trim($_REQUEST['rol']), ENT_QUOTES, 'UTF-8');
        $desc = htmlspecialchars(trim($_REQUEST['descripcion']), ENT_QUOTES, 'UTF-8');

        $result = $this->rol->insert(['rol' => $rol, 'descripcion' => $desc]);

        if ($result == false) {
            $this->setMsg(Constants::ERROR_INSERT);
            header('Location: RolC.php?msg=' . Constants::ERROR_INSERT);
            exit();
        }
        header('Location: RolC.php?id=' . $result);
        exit();
    }

    private function update()
    {
        if (!isset($_REQUEST['id']) || !isset($_REQUEST['rol']) || !isset($_REQUEST['descripcion'])) {
            header('Location: RolC.php?msg=' . Constants::ERROR_UPDATE);
            exit();
        }

        $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8');
        $rol = htmlspecialchars(trim($_REQUEST['rol']), ENT_QUOTES, 'UTF-8');
        $desc = htmlspecialchars(trim($_REQUEST['descripcion']), ENT_QUOTES, 'UTF-8');

        $result = $this->rol->queryParam(Constants::UPDT_ROL, ['id' => $id, 'rol' => $rol, 'descripcion' => $desc]);
        var_dump($result);
        if ($result == false) {
            $this->setMsg(Constants::ERROR_UPDATE);
            header('Location: RolC.php?msg=' . Constants::ERROR_UPDATE . '&id=' . $id);
            exit();
        }
        header('Location: RolC.php?id=' . $id);
        exit();
    }

    private function sdelete()
    {
        if (!isset($_REQUEST['id'])) {
            $this->setMsg(base64_encode(Constants::ERROR_DELETE));
            header('Location: RolC.php?msg=' . $this->getMsg());
            exit();
        }
        $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8');
        $data_bd = $this->rol->queryParam(Constants::GET_ROL, ['id' => $id]);

        if ($data_bd == null || $data_bd == false) {
            $this->setMsg(base64_encode(Constants::ERROR_ROW_NOT_FOUND));
            header('Location: RolC.php?msg=' . $this->getMsg());
            exit();
        }
        $result = $this->rol->queryParam(Constants::DELETE_ROL, ['id' => $id]);

        if ($result == false) {
            $this->setMsg(base64_encode(Constants::ERROR_DELETE));
            header('Location: RolC.php?msg=' . $this->getMsg()); // TO DO!!!
            exit();
        }

        $this->setMsg(base64_encode(Constants::DELETE_ROW));
        header('Location: RolC.php?msg=' . $this->getMsg()); // TO DO!!!
        exit();
    }

    private function undelete()
    {
        if (!isset($_REQUEST['id'])) {
            $this->setMsg(base64_encode(Constants::ERROR_UNDELETE));
            header('Location: RolC.php?msg=' . $this->getMsg());
            exit();
        }
        $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8');
        $data_bd = $this->rol->queryParam(Constants::GET_ROL, ['id' => $id]);

        if ($data_bd == null || $data_bd == false) {
            $this->setMsg(base64_encode(Constants::ERROR_ROW_NOT_FOUND));
            header('Location: RolC.php?msg=' . $this->getMsg());
            exit();
        }
        $result = $this->rol->queryParam(Constants::UPDT_UNDELETE_ROLES, ['id' => $id]);

        if ($result == false) {
            $this->setMsg(base64_encode(Constants::ERROR_UNDELETE));
            header('Location: RolC.php?msg=' . $this->getMsg()); // TO DO!!!
            exit();
        }

        $this->setMsg(base64_encode(Constants::UNDELETE_ROW));
        header('Location: RolC.php?msg=' . $this->getMsg()); // TO DO!!!
        exit();
    }

    private function get_rows_availables()
    {
        echo json_encode($this->rol->query(Constants::GET_ROL_SELECT));
    }

    private function show_delete_rows()
    {
        echo json_encode($this->rol->query(Constants::GET_ROLES_INACTIVE));
    }


    private function pagination()
    {
        // Obtenemos los valores nuevos (si es que hay)
        $this->ord = $this->rol->get_value("ord", $this->ord);
        $this->field = $this->rol->get_value("field", $this->field);
        $this->amount = $this->rol->get_value("amount", $this->amount);
        $this->page = $this->rol->get_value("page", $this->page);
        $this->search_val = (isset($_POST['search_value']) && !empty($_POST['search_value']) && $_POST['search_value'] != '' && $_POST['search_value'] != null) ? ('%' . $this->rol->get_value("search_value", $_POST['search_value']) . '%') : false;

        $data = ($this->search_val) ? ($this->rol->queryParamSearch(Constants::SEARCH_ROLES_TABLE, $this->search_val, $this->ord, $this->field, $this->page, $this->amount)) : ($this->rol->pagination_visible('roles', $this->ord, $this->field, $this->page, $this->amount));
        $total_pages = ($this->search_val) ? ceil(count($this->rol->queryParam(Constants::SEARCH_ROLES_TABLE_TOTAL_PAGES, ['search_value' => $this->search_val])) / $this->amount) : $this->rol->total_pages_visibles("roles", $this->amount);
        $total_pages = ($total_pages == 0) ? 1 : $total_pages;

        // La página actual
        $page = $this->getPage();
        $html_var = '';

        // Recorremos el array data y concatenamos el HTML generado dinámicamente
        foreach ($data as $show_data) {
            $url = "RolC.php"; //URL destino

            // Concatenamos el HTML generado dinámicamente
            $html_var .= "<tr>";
            $html_var .= "<td class='sticky-column' id='showRegister' value='" . $show_data["id"] . "'> <a href='?id=" . $show_data["id"] . "&action=show_register'>" . $show_data["rol"] . "</a> </td>";
            $html_var .= "<td style=>" . $show_data["descripcion"] . "</td>";
            $html_var .= "<td class='ps-4 pe-2 text-center'>";
            $html_var .= "<div class='btn-group dropdown d-block' style='position:relative'>";
            $html_var .= "<button type='button' onclick='show_btn_options(event)' id='add' class='button-dropdown rounded' style='padding: .8em;width: 1.3em;height: 1.3em;'>";
            $html_var .= "<i class='fa-solid fa-caret-down text-primary'></i>";
            $html_var .= "</button>";
            $html_var .= "<div class='btn-dropdown-options w-auto position-absolute' style='left:45.7%;'>";
            $html_var .= "<ul class='list-unstyled m-0'>";
            $html_var .= "<li>";
            $html_var .= "<a href='../controllers/RolC.php?action=show_register&id=" . $show_data["id"] . "'>Ver</a>";
            $html_var .= "</li>";
            $html_var .= "<li>";
            $html_var .= "<a href='../controllers/RolC.php?action=sdelete&id=" . $show_data["id"] . "'>Borrar</a>";
            $html_var .= "</li>";
            $html_var .= "</ul>";
            $html_var .= "</div>";
            $html_var .= "</div>";
            $html_var .= "</td>";
            $html_var .= "</tr>";
        }

        echo json_encode(array("total_pages" => $total_pages, "rows" => $html_var, 'pagination' => $this->rol->generatePaginationHTML($page, $this->amount, $total_pages)));
    }

    // private function generate_species_sel()      // TO DO!!!!!
    // {
    //     echo json_encode($this->rol->query(Constants::GET_ROLES));
    // }
}

//Comprobamos que la sesion esta iniciada
session_start();
//Si no tenemos guardado login 
if (!Utils::is_logged_in()) {
    header("Location:../../public/Login.php");
    die;
}
$rol = new RolC();

$action = !empty($_REQUEST["action"]) ? $_REQUEST["action"] : "index";
if (!empty($_POST["field"])) {
    $rol->setField($_POST["field"]);
}
if (!empty($_POST["ord"])) {
    $rol->setOrd($_POST["ord"]);
}
if (!empty($_POST["page"])) {
    $rol->setPage($_POST["page"]);
}
if (!empty($_POST["amount"])) {
    $rol->setAmount($_POST["amount"]);
}
$rol->run($action);
