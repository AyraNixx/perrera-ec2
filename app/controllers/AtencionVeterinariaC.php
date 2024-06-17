<?php

use utils\Utils;
use utils\Constants;
use \model\AtencionVeterinaria;

// use \Exception;

require_once "../utils/Utils.php";
require_once "../utils/Constants.php";
require_once "../models/AtencionVeterinaria.php";

class AtencionVeterinariaC
{
    // 
    // -- ATRIBUTOS
    // 
    private $atencion;
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
        $this->atencion = new AtencionVeterinaria();
        $this->msg = null;

        $this->field = "fecha_atencion";
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
            case 'update':
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
        }
    }

    private function index($view = 'V_AtencionVeterinaria.php')
    {
        if (!isset($_REQUEST['id'])) {
            $data = $this->atencion->pagination_atencion_veterinaria($this->ord, $this->field, $this->page, $this->amount);
            $total_pages = $this->atencion->total_pages_visibles('animales_atendidos_veterinarios', $this->amount);
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
            $data = $this->atencion->queryParam(Constants::GET_ATENCION_VETERINARIA, ['id' => $id])[0];
            require_once Constants::VIEW_ATENCION_VETERINARIA;
        }
    }

    private function add()
    {
        if (
            !isset($_REQUEST['animales_id']) || !isset($_REQUEST['veterinarios_id']) ||
            !isset($_REQUEST['motivo']) || !isset($_REQUEST['fecha_atencion']) ||
            !isset($_REQUEST['diagnostico']) || !isset($_REQUEST['procedimientos']) ||
            !isset($_REQUEST['medicamentos']) || !isset($_REQUEST['comentarios']) ||
            !isset($_REQUEST['coste'])
        ) {
            header('Location: AtencionVeterinariaC.php?msg=' . base64_encode(Constants::ERROR_INSERT));
            exit();
        }

        $animales_id = htmlspecialchars(trim($_REQUEST['animales_id']), ENT_QUOTES, 'UTF-8');
        $veterinarios_id = htmlspecialchars(trim($_REQUEST['veterinarios_id']), ENT_QUOTES, 'UTF-8');
        $motivo = htmlspecialchars(trim($_REQUEST['motivo']), ENT_QUOTES, 'UTF-8');
        $fecha_atencion = htmlspecialchars(trim($_REQUEST['fecha_atencion']), ENT_QUOTES, 'UTF-8');
        $diagnostico = htmlspecialchars(trim($_REQUEST['diagnostico']), ENT_QUOTES, 'UTF-8');
        $procedimientos = htmlspecialchars(trim($_REQUEST['procedimientos']), ENT_QUOTES, 'UTF-8');
        $medicamentos = htmlspecialchars(trim($_REQUEST['medicamentos']), ENT_QUOTES, 'UTF-8');
        $comentarios = htmlspecialchars(trim($_REQUEST['comentarios']), ENT_QUOTES, 'UTF-8');
        $coste = htmlspecialchars(trim($_REQUEST['coste']), ENT_QUOTES, 'UTF-8');

        // Insertamos el registro en la base de datos
        $result = $this->atencion->insert([ 'animales_id' => $animales_id, 'veterinarios_id' => $veterinarios_id, 'motivo' => $motivo, 'fecha_atencion' => $fecha_atencion, 'diagnostico' => $diagnostico, 
        'procedimientos' => $procedimientos, 'medicamentos' => $medicamentos, 'comentarios' => $comentarios, 'coste' => $coste
        ]);
        if ($result === false) {
            header('Location: AtencionVeterinariaC.php?msg=' . base64_encode(Constants::ERROR_INSERT));
            exit();
        }

        // Redirigimos a la página del registro creado
        header('Location: AtencionVeterinariaC.php?id=' . $result);
        exit();
    }

    private function update()
    {
        if (
            !isset($_REQUEST['id']) || empty($_REQUEST['id']) ||
            !isset($_REQUEST['motivo']) || !isset($_REQUEST['fecha_atencion']) ||
            !isset($_REQUEST['diagnostico']) || !isset($_REQUEST['procedimientos']) ||
            !isset($_REQUEST['medicamentos']) || !isset($_REQUEST['comentarios']) ||
            !isset($_REQUEST['coste'])
        ) {
            header('Location: AtencionVeterinariaC.php?msg=' . base64_encode(Constants::ERROR_UPDATE));
            exit();
        }

        $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8');       
        $motivo = htmlspecialchars(trim($_REQUEST['motivo']), ENT_QUOTES, 'UTF-8');
        $fecha_atencion = htmlspecialchars(trim($_REQUEST['fecha_atencion']), ENT_QUOTES, 'UTF-8');
        $diagnostico = htmlspecialchars(trim($_REQUEST['diagnostico']), ENT_QUOTES, 'UTF-8');
        $procedimientos = htmlspecialchars(trim($_REQUEST['procedimientos']), ENT_QUOTES, 'UTF-8');
        $medicamentos = htmlspecialchars(trim($_REQUEST['medicamentos']), ENT_QUOTES, 'UTF-8');
        $comentarios = htmlspecialchars(trim($_REQUEST['comentarios']), ENT_QUOTES, 'UTF-8');
        $coste = htmlspecialchars(trim($_REQUEST['coste']), ENT_QUOTES, 'UTF-8');

        $r = $this->atencion->queryparam(Constants::GET_TAREA, ['id' => $id]);
        if (!$r) {
            header('Location: AtencionVeterinariaC.php?msg=' . base64_encode(Constants::ERROR_UPDATE));
            exit();
        }
        
        $result = $this->atencion->queryParam(Constants::UPDATE_ATENCION_VETERINARIA, [
            'id' => $id, 'motivo' => $motivo, 'fecha_atencion' => $fecha_atencion, 'diagnostico' => $diagnostico, 'procedimientos' => $procedimientos,
            'medicamentos' => $medicamentos, 'comentarios' => $comentarios, 'coste' => $coste
        ]);

        if ($result === false) {
            header('Location: AtencionVeterinariaC.php?msg=' . base64_encode(Constants::ERROR_UPDATE) . '&id=' . $id);
            exit();
        }
        header('Location: AtencionVeterinariaC.php?id=' . $id);
        exit();
    }

    private function sdelete()
    {
        if (!isset($_REQUEST['id'])) {  // Si no trae la clave id en el array de $_REQUEST
            $this->setMsg(base64_encode(Constants::ERROR_DELETE));
            header('Location: AtencionVeterinariaC.php?msg=' . $this->getMsg());
            exit();
        }
        $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8'); // Limpiamos la cadena
        $data_bd = $this->atencion->queryParam(Constants::GET_ATENCION_VETERINARIA, ['id' => $id]);    // Comprobamos que existe un usuario en la bd con ese id
        
        if ($data_bd == null || $data_bd == false) {  // Si no se ha encontrado la tarea asignada, se informa
            $this->setMsg(base64_encode(Constants::ERROR_ROW_NOT_FOUND));
            header('Location: AtencionVeterinariaC.php?msg=' . $this->getMsg());
            exit();
        }

        $result = $this->atencion->queryParam(Constants::DELETE_ATENCION_VETERINARIA, ['id' => $id]);  // Procedemos con el soft delete        

        if ($result == false) { // Si no se ha podido realizar, lo informamos
            $this->setMsg(base64_encode(Constants::ERROR_DELETE));
            header('Location: AtencionVeterinariaC.php?msg=' . $this->getMsg()); // TO DO!!!
            exit();
        }
        $this->setMsg(base64_encode(Constants::DELETE_ROW));
        header('Location: AtencionVeterinariaC.php?msg=' . $this->getMsg()); // TO DO!!!
        exit();
    }

    private function undelete()
    {
        if (!isset($_REQUEST['id'])) {  // Si no trae la clave id en el array de $_REQUEST
            $this->setMsg(base64_encode(Constants::ERROR_UNDELETE));
            header('Location: AtencionVeterinariaC.php?msg=' . $this->getMsg());
            exit();
        }

        $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8'); // Limpiamos la cadena
        $data_bd = $this->atencion->queryParam(Constants::GET_ATENCION_VETERINARIA, ['id' => $id]);    // Comprobamos que existe una asignacion en la bd con ese id

        if ($data_bd == null || $data_bd == false) {  // Si no se ha encontrado, se informa
            $this->setMsg(base64_encode(Constants::ERROR_ROW_NOT_FOUND));
            header('Location: AtencionVeterinariaC.php?msg=' . $this->getMsg());
            exit();
        }
        if ($data_bd[0]['disponible'] == 1) { // Se comprueba que el registro esté inactivo
            $this->setMsg(base64_encode(Constants::ERROR_ROW_NOT_INACTIVE));
            header('Location: AtencionVeterinariaC.php?msg=' . $this->getMsg());
            exit();
        }

        $result = $this->atencion->queryParam(Constants::UPDT_UNDELETE_ATENCION_VETERINARIA, ['id' => $id]);

        if ($result == false) {
            $this->setMsg(base64_encode(Constants::ERROR_UNDELETE));
            header('Location: AtencionVeterinariaC.php?msg=' . $this->getMsg());
            exit();
        }

        $this->setMsg(base64_encode(Constants::UNDELETE_ROW));

        header('Location: AtencionVeterinariaC.php?msg=' . $this->getMsg());
        exit();
    }

    private function show_delete_rows()
    {
        echo json_encode($this->atencion->query(Constants::GET_ATENCION_VETERINARIA_INACTIVE));
    }

    private function pagination()
    {
        // Obtenemos los valores nuevos (si es que hay)
        $this->ord = $this->atencion->get_value("ord", $this->ord);
        $this->field = $this->atencion->get_value("field", $this->field);
        $this->amount = $this->atencion->get_value("amount", $this->amount);
        $this->page = $this->atencion->get_value("page", $this->page);
        $this->search_val = (isset($_POST['search_value']) && !empty($_POST['search_value']) && $_POST['search_value'] != '' && $_POST['search_value'] != null) ? ('%' . $this->atencion->get_value("search_value", $_POST['search_value']) . '%') : false;

        $data = ($this->search_val) ? ($this->atencion->queryParamSearch(Constants::SEARCH_ATENCIONES_VETERINARIAS_TABLE, $this->search_val, $this->ord, $this->field, $this->page, $this->amount)) : ($this->atencion->pagination_atencion_veterinaria($this->ord, $this->field, $this->page, $this->amount));
        $total_pages = ($this->search_val) ? ceil(count($this->atencion->queryParam(Constants::SEARCH_ATENCIONES_VETERINARIAS_TABLE_TOTAL_PAGES, ['search_value' => $this->search_val])) / $this->amount) : ($this->atencion->total_pages_visibles("animales_atendidos_veterinario", $this->amount));
        $total_pages = ($total_pages == 0) ? 1 : $total_pages;

        // La página actual
        $page = $this->getPage();
        $html_var = '';

        // Recorremos el array data y concatenamos el HTML generado dinámicamente
        foreach ($data as $show_data) {
            $url = "AtencionVeterinariaC.php"; //URL destino

            // Concatenamos el HTML generado dinámicamente
            $html_var .= "<tr>";
            $html_var .= "<td class='sticky-column' id='showRegister' value='" . $show_data["id"] . "'> <a href='?id=" . $show_data["id"] . "&action=show_register'>" . $show_data["nombre_veterinario"] . ' ' . $show_data["apellidos_veterinario"] . "</a> </td>";
            $html_var .= "<td>" . $show_data["telf_veterinario"] . "</td>";
            $html_var .= "<td>" . $show_data["nombre_clinica"] . "</td>";
            $html_var .= "<td>" . $show_data["nombre_animal"] . "</td>";
            $html_var .= "<td><a href='../controllers/EmpleadoC.php?id=" . $show_data["animales_id"] . "&action=show_register'>" . $show_data["nombre_animal"] . "</a></td>";
            $html_var .= "<td class='ps-4 pe-2'>";
            $html_var .= "<div class='btn-group dropdown d-block' style='position:relative'>";
            $html_var .= "<button type='button' onclick='show_btn_options(event)' id='add' class='button-dropdown rounded' style='padding: .8em;width: 1.3em;height: 1.3em;'>";
            $html_var .= "<i class='fa-solid fa-caret-down text-primary'></i>";
            $html_var .= "</button>";
            $html_var .= "<div class='btn-dropdown-options w-auto position-absolute start-0'>";
            $html_var .= "<ul class='list-unstyled m-0'>";
            $html_var .= "<li>";
            $html_var .= "<a href='../controllers/AtencionVeterinariaC.php?action=show_register&id=" . $show_data["id"] . "'>Ver</a>";
            $html_var .= "</li>";
            $html_var .= "<li>";
            $html_var .= "<a href='../controllers/AtencionVeterinariaC.php?action=sdelete&id=" . $show_data["id"] . "'>Borrar</a>";
            $html_var .= "</li>";
            $html_var .= "</ul>";
            $html_var .= "</div>";
            $html_var .= "</div>";
            $html_var .= "</td>";
            $html_var .= "</tr>";
        }

        echo json_encode(array("total_pages" => $total_pages, "rows" => $html_var, 'pagination' => $this->atencion->generatePaginationHTML($page, $this->amount, $total_pages)));
    }
}

//Comprobamos que la sesion esta iniciada
session_start();
//Si no tenemos guardado login 
if (!Utils::is_logged_in()) {
    header("Location:../../public/Login.php");
    die;
}
$atencion = new AtencionVeterinariaC();
$action = !empty($_REQUEST["action"]) ? $_REQUEST["action"] : "index";
if (!empty($_POST["field"])) {
    $atencion->setField($_POST["field"]);
}
if (!empty($_POST["ord"])) {
    $atencion->setOrd($_POST["ord"]);
}
if (!empty($_POST["page"])) {
    $atencion->setPage($_POST["page"]);
}
if (!empty($_POST["amount"])) {
    $atencion->setAmount($_POST["amount"]);
}
$atencion->run($action);
