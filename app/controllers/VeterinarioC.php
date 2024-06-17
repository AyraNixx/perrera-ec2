<?php

use utils\Utils;
use \model\Veterinario;
use utils\Constants;

// use \Exception;

require_once "../utils/Utils.php";
require_once "../utils/Constants.php";
require_once "../models/Veterinario.php";

class VeterinarioC
{
    // 
    // -- ATRIBUTOS
    // 
    private $veterinario;
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
        $this->veterinario = new Veterinario();
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
            case "get_rows_availables":
                $this->get_rows_availables();
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
        }
    }

    private function index($view = 'V_Veterinarios.php')
    {
        if (!isset($_REQUEST['id'])) {
            $data = $this->veterinario->pagination_visible('veterinarios', $this->ord, $this->field, $this->page, $this->amount);
            $total_pages = $this->veterinario->total_pages_visibles('veterinarios', $this->amount);
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
            $data = $this->veterinario->queryParam(Constants::GET_VETERINARIO, ['id' => $id])[0];
            $new_msg = $this->getMsg();
            require_once Constants::VIEW_VETERINARIO;
        }
    }

    private function add()
    {
        if (
            !isset($_REQUEST['nombre']) || !isset($_REQUEST['apellidos'])
            || !isset($_REQUEST['correo']) || !isset($_REQUEST['telf'])
            || !isset($_REQUEST['especialidad'])
            || !isset($_REQUEST['nombre_clinica']) || !isset($_REQUEST['direccion_clinica'])
            || !isset($_REQUEST['telf_clinica']) || !isset($_REQUEST['correo_clinica'])
            || !isset($_REQUEST['hora_apertura']) || !isset($_REQUEST['hora_cierre'])
            || !isset($_REQUEST['otra_informacion'])
        ) {
            header('Location: VeterinarioC.php?msg=' . Constants::ERROR_INSERT);
            exit();
        }

        $correo = htmlspecialchars(trim($_REQUEST['correo']), ENT_QUOTES, 'UTF-8');
        $data = $this->veterinario->queryParam(Constants::FIND_EMAIL_VETERINARIO, ['correo' => $correo]);

        if ($data != false && $data != null) {
            header('Location: VeterinarioC.php?msg=' . Constants::ERROR_EMAIL_EXIST);
            exit();
        }
        $nombre = htmlspecialchars(trim($_REQUEST['nombre']), ENT_QUOTES, 'UTF-8');
        $apellidos = htmlspecialchars(trim($_REQUEST['apellidos']), ENT_QUOTES, 'UTF-8');
        $telf = htmlspecialchars(trim($_REQUEST['telf']), ENT_QUOTES, 'UTF-8');
        $especialidad = htmlspecialchars(trim($_REQUEST['especialidad']), ENT_QUOTES, 'UTF-8');
        $nombre_clinica = htmlspecialchars(trim($_REQUEST['nombre_clinica']), ENT_QUOTES, 'UTF-8');
        $direccion_clinica = htmlspecialchars(trim($_REQUEST['direccion_clinica']), ENT_QUOTES, 'UTF-8');
        $telf_clinica = htmlspecialchars(trim($_REQUEST['telf_clinica']), ENT_QUOTES, 'UTF-8');
        $correo_clinica = htmlspecialchars(trim($_REQUEST['correo_clinica']), ENT_QUOTES, 'UTF-8');
        $hora_apertura = htmlspecialchars(trim($_REQUEST['hora_apertura']), ENT_QUOTES, 'UTF-8');
        $hora_cierre = htmlspecialchars(trim($_REQUEST['hora_cierre']), ENT_QUOTES, 'UTF-8');
        $otra_informacion = htmlspecialchars(trim($_REQUEST['otra_informacion']), ENT_QUOTES, 'UTF-8');

        $result = $this->veterinario->insert([
            'nombre' => $nombre, 'apellidos' => $apellidos, 'correo' => $correo, 'telf' => $telf, 'especialidad' => $especialidad,
            'nombre_clinica' => $nombre_clinica, 'direccion_clinica' => $direccion_clinica, 'telf_clinica' => $telf_clinica, 'correo_clinica' => $correo_clinica,
            'hora_apertura' => $hora_apertura, 'hora_cierre' => $hora_cierre, 'otra_informacion' => $otra_informacion
        ]);


        if ($result == false) {
            $this->setMsg(Constants::ERROR_INSERT);
            header('Location: VeterinarioC.php?msg=' . Constants::ERROR_INSERT);
            exit();
        }

        header('Location: VeterinarioC.php?id=' . $result);
        exit();
    }

    private function update()
    {
        if (
            !isset($_REQUEST['id']) || !isset($_REQUEST['nombre']) || !isset($_REQUEST['apellidos'])
            || !isset($_REQUEST['correo']) || !isset($_REQUEST['telf'])
            || !isset($_REQUEST['especialidad']) || !isset($_REQUEST['nombre_clinica'])
            || !isset($_REQUEST['direccion_clinica']) || !isset($_REQUEST['telf_clinica'])
            || !isset($_REQUEST['correo_clinica']) || !isset($_REQUEST['hora_apertura'])
            || !isset($_REQUEST['hora_cierre']) || !isset($_REQUEST['otra_informacion'])
        ) {
            header('Location: VeterinarioC.php?msg=' . Constants::ERROR_UPDATE);
            exit();
        }

        $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8');
        $correo = htmlspecialchars(trim($_REQUEST['correo']), ENT_QUOTES, 'UTF-8');

        $existe_email = $this->veterinario->queryParam(Constants::FIND_EMAIL_VETERINARIO_UPD, ['correo' => $correo, 'id' => $id]);

        if ($existe_email) {
            header('Location: VeterinarioC.php?msg=' . Constants::ERROR_EMAIL_EXIST);
            exit();
        }
        $nombre = htmlspecialchars(trim($_REQUEST['nombre']), ENT_QUOTES, 'UTF-8');
        $apellidos = htmlspecialchars(trim($_REQUEST['apellidos']), ENT_QUOTES, 'UTF-8');
        $telf = htmlspecialchars(trim($_REQUEST['telf']), ENT_QUOTES, 'UTF-8');
        $especialidad = htmlspecialchars(trim($_REQUEST['especialidad']), ENT_QUOTES, 'UTF-8');
        $nombre_clinica = htmlspecialchars(trim($_REQUEST['nombre_clinica']), ENT_QUOTES, 'UTF-8');
        $direccion_clinica = htmlspecialchars(trim($_REQUEST['direccion_clinica']), ENT_QUOTES, 'UTF-8');
        $telf_clinica = htmlspecialchars(trim($_REQUEST['telf_clinica']), ENT_QUOTES, 'UTF-8');
        $correo_clinica = htmlspecialchars(trim($_REQUEST['correo_clinica']), ENT_QUOTES, 'UTF-8');
        $hora_apertura = htmlspecialchars(trim($_REQUEST['hora_apertura']), ENT_QUOTES, 'UTF-8');
        $hora_cierre = htmlspecialchars(trim($_REQUEST['hora_cierre']), ENT_QUOTES, 'UTF-8');
        $otra_informacion = htmlspecialchars(trim($_REQUEST['otra_informacion']), ENT_QUOTES, 'UTF-8');

        $result = $this->veterinario->queryParam(Constants::UPDT_VETERINARIO, [
            'id' => $id, 'nombre' => $nombre, 'apellidos' => $apellidos, 'correo' => $correo,
            'telf' => $telf, 'especialidad' => $especialidad,
            'nombre_clinica' => $nombre_clinica, 'direccion_clinica' => $direccion_clinica,
            'telf_clinica' => $telf_clinica, 'correo_clinica' => $correo_clinica,
            'hora_apertura' => $hora_apertura, 'hora_cierre' => $hora_cierre,
            'otra_informacion' => $otra_informacion
        ]);

        if ($result == false) {
            $this->setMsg(Constants::ERROR_UPDATE);
            header('Location: VeterinarioC.php?msg=' . Constants::ERROR_UPDATE . '&id=' . $id);
            exit();
        }
        header('Location: VeterinarioC.php?id=' . $id);
        exit();
    }

    private function sdelete()
    {
        if (!isset($_REQUEST['id'])) {
            $this->setMsg(base64_encode(Constants::ERROR_DELETE));
            header('Location: VeterinarioC.php?msg=' . $this->getMsg());
            exit();
        }
        $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8');
        $data_bd = $this->veterinario->queryParam(Constants::GET_VETERINARIO, ['id' => $id]);

        if ($data_bd == null || $data_bd == false) {
            $this->setMsg(base64_encode(Constants::ERROR_ROW_NOT_FOUND));
            header('Location: VeterinarioC.php?msg=' . $this->getMsg());
            exit();
        }
        // Soft delete a todos los registros relacionados
        $result = $this->veterinario->soft_delete_veterinario($id);

        if ($result == false) {
            $this->setMsg(base64_encode(Constants::ERROR_DELETE));
            header('Location: VeterinarioC.php?msg=' . $this->getMsg());
            exit();
        }

        $this->setMsg(base64_encode(Constants::DELETE_ROW));
        header('Location: VeterinarioC.php?msg=' . $this->getMsg());
        exit();
    }

    private function undelete()
    {
        if (!isset($_REQUEST['id'])) {
            $this->setMsg(base64_encode(Constants::ERROR_UNDELETE));
            header('Location: VeterinarioC.php?msg=' . $this->getMsg());
            exit();
        }
        $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8');
        $data_bd = $this->veterinario->queryParam(Constants::GET_VETERINARIO, ['id' => $id]);

        if ($data_bd == null || $data_bd == false) {
            $this->setMsg(base64_encode(Constants::ERROR_ROW_NOT_FOUND));
            header('Location: VeterinarioC.php?msg=' . $this->getMsg());
            exit();
        }
        $result = $this->veterinario->undelete_veterinario($id);

        if ($result == false) {
            $this->setMsg(base64_encode(Constants::ERROR_UNDELETE));
            header('Location: VeterinarioC.php?msg=' . $this->getMsg());
            exit();
        }

        $this->setMsg(base64_encode(Constants::UNDELETE_ROW));
        header('Location: VeterinarioC.php?msg=' . $this->getMsg());
        exit();
    }

    private function get_rows_availables()
    {
        echo json_encode($this->veterinario->query(Constants::GET_VETERINARIO_SELECT));
    }

    private function pagination()
    {
        // Obtenemos los valores nuevos (si es que hay)
        $this->ord = $this->veterinario->get_value("ord", $this->ord);
        $this->field = $this->veterinario->get_value("field", $this->field);
        $this->amount = $this->veterinario->get_value("amount", $this->amount);
        $this->page = $this->veterinario->get_value("page", $this->page);
        $this->search_val = (isset($_POST['search_value']) && !empty($_POST['search_value']) && $_POST['search_value'] != '' && $_POST['search_value'] != null) ? ('%' . $this->veterinario->get_value("search_value", $_POST['search_value']) . '%') : false;

        $data = ($this->search_val) ? ($this->veterinario->queryParamSearch(Constants::SEARCH_VETERINARIOS_TABLE, $this->search_val, $this->ord, $this->field, $this->page, $this->amount)) : ($this->veterinario->pagination_visible('veterinarios', $this->ord, $this->field, $this->page, $this->amount));
        $total_pages = ($this->search_val) ? ceil(count($this->veterinario->queryParam(Constants::SEARCH_VETERINARIOS_TABLE_TOTAL_PAGES, ['search_value' => $this->search_val])) / $this->amount) : $this->veterinario->total_pages_visibles("veterinarios", $this->amount);
        $total_pages = ($total_pages == 0) ? 1 : $total_pages;

        // La página actual
        $page = $this->getPage();
        $html_var = '';

        // Recorremos el array data y concatenamos el HTML generado dinámicamente
        foreach ($data as $show_data) {
            $url = "VeterinarioC.php"; //URL destino

            // Concatenamos el HTML generado dinámicamente
            $html_var .= "<tr>";
            $html_var .= "<td class='sticky-column' id='showRegister' value='" . $show_data["id"] . "'> <a href='?id=" . $show_data["id"] . "&action=show_register'>" . $show_data["nombre"] . "</a> </td>";
            $html_var .= "<td>" . $show_data["apellidos"] . "</td>";
            $html_var .= "<td>" . $show_data["correo"] . "</td>";
            $html_var .= "<td>" . $show_data["nombre_clinica"] . "</td>";
            $html_var .= "<td>" . $show_data["hora_apertura"] . " - " . $show_data["hora_cierre"] . "</td>";
            $html_var .= "<td class='ps-4 pe-2'>";
            $html_var .= "<div class='btn-group dropdown d-block' style='position:relative'>";
            $html_var .= "<button type='button' onclick='show_btn_options(event)' id='add' class='button-dropdown rounded' style='padding: .8em;width: 1.3em;height: 1.3em;'>";
            $html_var .= "<i class='fa-solid fa-caret-down text-primary'></i>";
            $html_var .= "</button>";
            $html_var .= "<div class='btn-dropdown-options w-auto position-absolute start-0'>";
            $html_var .= "<ul class='list-unstyled m-0'>";
            $html_var .= "<li>";
            $html_var .= "<a href='../controllers/VeterinarioC.php?action=add_or_update&id=" . $show_data["id"] . "'>Editar</a>";
            $html_var .= "</li>";
            $html_var .= "<li>";
            $html_var .= "<a href='../controllers/VeterinarioC.php?action=sdelete&id=" . $show_data["id"] . "'>Borrar</a>";
            $html_var .= "</li>";
            $html_var .= "</ul>";
            $html_var .= "</div>";
            $html_var .= "</div>";
            $html_var .= "</td>";
            $html_var .= "</tr>";
        }

        echo json_encode(array("total_pages" => $total_pages, "rows" => $html_var, 'pagination' => $this->veterinario->generatePaginationHTML($page, $this->amount, $total_pages)));
    }

    private function show_delete_rows()
    {
        echo json_encode($this->veterinario->query(Constants::GET_VETERINARIOS_INACTIVE));
    }
}

//Comprobamos que la sesion esta iniciada
session_start();
//Si no tenemos guardado login 
if (!Utils::is_logged_in()) {
    header("Location:../../public/Login.php");
    die;
}
$especie = new VeterinarioC();

$action = !empty($_REQUEST["action"]) ? $_REQUEST["action"] : "index";

if (!empty($_REQUEST["msg"])) {
    $especie->setMsg($_REQUEST["msg"]);
}
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
