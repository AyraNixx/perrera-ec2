<?php

use utils\Utils;
use \model\Jaula;
use utils\Constants;

// use \Exception;

require_once "../utils/Utils.php";
require_once "../utils/Constants.php";
require_once "../models/Jaula.php";

class JaulaC
{
    // 
    // -- ATRIBUTOS
    // 
    private $jaula;
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
        $this->jaula = new Jaula();
        $this->msg = null;

        $this->field = "ubicacion";
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
            case "generate_cages_sel":
                $this->generate_cages_sel();
                break;
            case "get_last_cage_number":
                $this->get_last_cage_number();
                break;
            case "get_rows_availables":
                $this->get_rows_availables();
                break;
            case "show_delete_rows":
                $this->show_delete_rows();
                break;
            default:
                $this->index();
                break;
        }
    }


    private function index($view = 'V_Jaulas.php')
    {
        if (!isset($_REQUEST['id'])) {
            $data = $this->jaula->pagination_more_info($this->ord, $this->field, $this->page, $this->amount);
            $total_pages = $this->jaula->total_pages_visibles('jaulas', $this->amount);
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
            $data = $this->jaula->queryParam(Constants::GET_JAULA, ['id' => $id])[0];
            $new_msg = $this->getMsg();
            require_once Constants::VIEW_JAULA;
        }
    }

    private function add()
    {
        if (
            !isset($_REQUEST['ubicacion']) || !isset($_REQUEST['descripcion']) || !isset($_REQUEST['tamanio'])
            || !isset($_REQUEST['otros_comentarios']) || !isset($_REQUEST['especies_id']) || !isset($_REQUEST['estado_comida'])
            || !isset($_REQUEST['estado_limpieza'])
        ) {
            header('Location: JaulaC.php?msg=' . Constants::ERROR_INSERT);
            exit();
        }
        $ubicacion = htmlspecialchars(trim($_REQUEST['ubicacion']), ENT_QUOTES, 'UTF-8');
        $desc = htmlspecialchars(trim($_REQUEST['descripcion']), ENT_QUOTES, 'UTF-8');
        $tamanio = htmlspecialchars(trim($_REQUEST['tamanio']), ENT_QUOTES, 'UTF-8');
        $otros_comentarios = htmlspecialchars(trim($_REQUEST['otros_comentarios']), ENT_QUOTES, 'UTF-8');
        $especies_id = htmlspecialchars(trim($_REQUEST['especies_id']), ENT_QUOTES, 'UTF-8');
        $estado_limpieza = htmlspecialchars(trim($_REQUEST['estado_limpieza']), ENT_QUOTES, 'UTF-8');
        $estado_comida = htmlspecialchars(trim($_REQUEST['estado_comida']), ENT_QUOTES, 'UTF-8');


        $result = $this->jaula->insert(['ubicacion' => $ubicacion, 'tamanio' => $tamanio, 'ocupada' => 0, 'estado_comida' => $estado_comida, 'estado_limpieza' => $estado_limpieza, 'descripcion' => $desc, 'otros_comentarios' => $otros_comentarios, 'especies_id' => $especies_id]);

        if ($result == false) {
            $this->setMsg(Constants::ERROR_INSERT);
            header('Location: JaulaC.php?msg=' . Constants::ERROR_INSERT);
            exit();
        }

        header('Location: JaulaC.php?id=' . $result);
        exit();
    }

    private function update()
    {
        if (
            !isset($_REQUEST['ubicacion']) || !isset($_REQUEST['descripcion']) || !isset($_REQUEST['tamanio'])
            || !isset($_REQUEST['otros_comentarios']) || !isset($_REQUEST['especies_id']) || !isset($_REQUEST['estado_comida'])
            || !isset($_REQUEST['estado_limpieza']) || !isset($_REQUEST['id'])
        ) {
            header('Location: JaulaC.php?msg=' . Constants::ERROR_UPDATE);
            exit();
        }
        $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8');
        $ubicacion = htmlspecialchars(trim($_REQUEST['ubicacion']), ENT_QUOTES, 'UTF-8');
        $desc = htmlspecialchars(trim($_REQUEST['descripcion']), ENT_QUOTES, 'UTF-8');
        $tamanio = htmlspecialchars(trim($_REQUEST['tamanio']), ENT_QUOTES, 'UTF-8');
        $ocupada = htmlspecialchars(trim($_REQUEST['ocupada']), ENT_QUOTES, 'UTF-8');
        $estado_comida = htmlspecialchars(trim($_REQUEST['estado_comida']), ENT_QUOTES, 'UTF-8');
        $estado_limpieza = htmlspecialchars(trim($_REQUEST['estado_limpieza']), ENT_QUOTES, 'UTF-8');
        $otros_comentarios = htmlspecialchars(trim($_REQUEST['otros_comentarios']), ENT_QUOTES, 'UTF-8');
        $especies_id = htmlspecialchars(trim($_REQUEST['especies_id']), ENT_QUOTES, 'UTF-8');

        $result = $this->jaula->queryParam(Constants::UPDT_JAULA, [
            'id' => $id, 'ubicacion' => $ubicacion, 'tamanio' => $tamanio, 'ocupada' => $ocupada,
            'estado_comida' => $estado_comida, 'estado_limpieza' => $estado_limpieza, 'descripcion' => $desc, 'otros_comentarios' => $otros_comentarios,
            'especies_id' => $especies_id
        ]);

        if ($result == false) {
            $this->setMsg(Constants::ERROR_UPDATE);
            header('Location: JaulaC.php?msg=' . Constants::ERROR_UPDATE . '&id=' . $id);
            exit();
        }

        header('Location: JaulaC.php?id=' . $id);
        exit();
    }

    private function sdelete()
    {
        if (!isset($_REQUEST['id'])) {
            $this->setMsg(base64_encode(Constants::ERROR_DELETE));
            header('Location: JaulaC.php?msg=' . $this->getMsg());
            exit();
        }
        $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8');
        $data_bd = $this->jaula->queryParam(Constants::GET_JAULA, ['id' => $id]);

        if ($data_bd == null || $data_bd == false) {
            $this->setMsg(base64_encode(Constants::ERROR_ROW_NOT_FOUND));
            header('Location: JaulaC.php?msg=' . $this->getMsg());
            exit();
        }
        $result = $this->jaula->queryParam(Constants::DELETE_JAULA, ['id' => $id]);

        if ($result == false) {
            $this->setMsg(base64_encode(Constants::ERROR_DELETE));
            header('Location: JaulaC.php?msg=' . $this->getMsg()); // TO DO!!!
            exit();
        }

        $this->setMsg(base64_encode(Constants::DELETE_ROW));
        header('Location: JaulaC.php?msg=' . $this->getMsg()); // TO DO!!!
        exit();
    }

    private function undelete()
    {
        if (!isset($_REQUEST['id'])) {
            $this->setMsg(base64_encode(Constants::ERROR_UNDELETE));
            header('Location: JaulaC.php?msg=' . $this->getMsg());
            exit();
        }
        $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8');
        $data_bd = $this->jaula->queryParam(Constants::GET_JAULA, ['id' => $id]);

        if ($data_bd == null || $data_bd == false) {
            $this->setMsg(base64_encode(Constants::ERROR_ROW_NOT_FOUND));
            header('Location: JaulaC.php?msg=' . $this->getMsg());
            exit();
        }
        $result = $this->jaula->queryParam(Constants::UPDT_UNDELETE_JAULAS, ['id' => $id]);

        if ($result == false) {
            $this->setMsg(base64_encode(Constants::ERROR_UNDELETE));
            header('Location: JaulaC.php?msg=' . $this->getMsg()); // TO DO!!!
            exit();
        }

        $this->setMsg(base64_encode(Constants::UNDELETE_ROW));
        header('Location: JaulaC.php?msg=' . $this->getMsg()); // TO DO!!!
        exit();
    }

    private function pagination()
    {
        // Obtenemos los valores nuevos (si es que hay)
        $this->ord = $this->jaula->get_value("ord", $this->ord);
        $this->field = $this->jaula->get_value("field", $this->field);
        $this->amount = $this->jaula->get_value("amount", $this->amount);
        $this->page = $this->jaula->get_value("page", $this->page);
        $this->search_val = (isset($_POST['search_value']) && !empty($_POST['search_value']) && $_POST['search_value'] != '' && $_POST['search_value'] != null) ? ('%' . $this->jaula->get_value("search_value", $_POST['search_value']) . '%') : false;

        $data = ($this->search_val) ? ($this->jaula->queryParamSearch(Constants::SEARCH_JAULAS_TABLE, $this->search_val, $this->ord, $this->field, $this->page, $this->amount)) : ($this->jaula->pagination_more_info($this->ord, $this->field, $this->page, $this->amount));
        $total_pages = ($this->search_val) ? ceil(count($this->jaula->queryParam(Constants::SEARCH_JAULAS_TABLE_TOTAL_PAGES, ['search_value' => $this->search_val])) / $this->amount) : $this->jaula->total_pages_visibles("jaulas", $this->amount);
        $total_pages = ($total_pages == 0) ? 1 : $total_pages;

        // La página actual
        $page = $this->getPage();
        $html_var = '';
        // Recorremos el array data y concatenamos el HTML generado dinámicamente
        foreach ($data as $show_data) {
            $url = "JaulaC.php"; //URL destino

            // Concatenamos el HTML generado dinámicamente
            $html_var .= "<tr>";
            $html_var .= "<td class='sticky-column' id='showRegister' value='" . $show_data["id"] . "'> <a href='?id=" . $show_data["id"] . "&action=show_register'>" . $show_data["ubicacion"] . "</a> </td>";
            $html_var .= "<td>" . $show_data["nombre_especie"] . "</td>";
            $html_var .= "<td>" . $show_data["tamanio"] . "</td>";
            $html_var .= "<td>" . (($show_data["ocupada"] == '1') ? 'SI' : 'NO') . "</td>";
            $html_var .= "<td class='ps-4 pe-2 text-center'>";
            $html_var .= "<div class='btn-group dropdown d-block' style='position:relative'>";
            $html_var .= "<button type='button' onclick='show_btn_options(event)' id='add' class='button-dropdown rounded' style='padding: .8em;width: 1.3em;height: 1.3em;'>";
            $html_var .= "<i class='fa-solid fa-caret-down text-primary'></i>";
            $html_var .= "</button>";
            $html_var .= "<div class='btn-dropdown-options w-auto position-absolute' style='left: 46.7%;'>";
            $html_var .= "<ul class='list-unstyled m-0'>";
            $html_var .= "<li>";
            $html_var .= "<a href='../controllers/JaulaC.php?action=show_register&id=" . $show_data["id"] . "'>Ver</a>";
            $html_var .= "</li>";
            $html_var .= "<li>";
            $html_var .= "<a href='../controllers/JaulaC.php?action=sdelete&id=" . $show_data["id"] . "'>Borrar</a>";
            $html_var .= "</li>";
            $html_var .= "</ul>";
            $html_var .= "</div>";
            $html_var .= "</div>";
            $html_var .= "</td>";
            $html_var .= "</tr>";
        }

        echo json_encode(array("total_pages" => $total_pages, "rows" => $html_var, 'pagination' => $this->jaula->generatePaginationHTML($page, $this->amount, $total_pages)));
    }

    private function generate_cages_sel()
    {
        var_dump($_REQUEST);
        if ((isset($_REQUEST['id']) && !empty($_REQUEST['id'])) || !empty($id)) {
            $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8');

            if (isset($_REQUEST['jaula_id']) && !empty($_REQUEST['jaula_id'])) {
                $jaula_id = htmlspecialchars(trim($_REQUEST['jaula_id']), ENT_QUOTES, 'UTF-8');
                echo json_encode($this->jaula->queryParam(Constants::GET_JAULAS_BY_ESPECIE_AVAILABLE, ['id' => $id, 'jaula_id' => $jaula_id]));
            }
        }
    }

    private function get_last_cage_number()
    {
        if (isset($_REQUEST['letter_cage'])) {
            $letter_cage = htmlspecialchars(trim($_REQUEST['letter_cage']), ENT_QUOTES, 'UTF-8');
            echo json_encode($this->jaula->queryParam(Constants::GET_LAST_JAULA_NUMBER, ['letter_cage' => $letter_cage]));
        }
    }

    private function get_rows_availables()
    {
        echo json_encode($this->jaula->query(Constants::GET_JAULA_SELECT));
    }

    private function show_delete_rows()
    {
        echo json_encode($this->jaula->query(Constants::GET_JAULAS_INACTIVE));
    }
}

//Comprobamos que la sesion esta iniciada
session_start();
//Si no tenemos guardado login 
if (!Utils::is_logged_in()) {
    header("Location:../../public/Login.php");
    die;
}
$especie = new JaulaC();

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
