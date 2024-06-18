<?php

use utils\Utils;
use utils\Constants;
use \model\AsignarTarea;

// use \Exception;

require_once "../utils/Utils.php";
require_once "../utils/Constants.php";
require_once "../models/AsignarTarea.php";

class AsignarTareasC
{
    // 
    // -- ATRIBUTOS
    // 
    private $asignar;
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
        $this->asignar = new AsignarTarea();
        $this->msg = null;

        $this->field = "asunto";
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
            case "index_home":
                $this->index_home();
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
            case "get_tasks_home":
                $this->get_tasks_home();
                break;
            case "change_assigned_to":
                $this->change_assigned_to();
                break;
            case "pagination":
                $this->pagination();
                break;
            default:
                $this->index();
                break;
        }
    }

    private function index_home($view = 'V_Home-Page.php'){
        if(!isset($_SESSION['correo'])){
            header('Location: LoginC.php?action=logout');
            exit();
        }
        $correo = htmlspecialchars(trim($_SESSION['correo']), ENT_QUOTES, 'UTF-8');
        $data = $this->asignar->queryParam(Constants::GET_TAREAS_EMPLEADO_LOGIN, ['correo' => $correo]);
        if($data == false){
            header('Location: LoginC.php?action=logout&msg=' . 'Ha ocurrido un problema al iniciar sesión. Si persiste, contactar con un administrador.');
            exit();
        }
        require_once "../views/" . $view;
    }

    private function index($view = 'V_TareasAsignadas.php')
    {
        if (!isset($_REQUEST['id'])) {
            $data = $this->asignar->pagination_tareas_asignadas($this->ord, $this->field, $this->page, $this->amount);
            $total_pages = $this->asignar->total_pages_visibles('tareas_asignadas', $this->amount);
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
            $data = $this->asignar->queryParam(Constants::GET_TAREA_ASIGNADA, ['id' => $id])[0];
            $new_msg = $this->getMsg();
            require_once Constants::VIEW_TAREA_ASIGNADA;
        }
    }


    private function add()
    {
        if (
            !isset($_REQUEST['asunto']) || !isset($_REQUEST['estado_asignacion']) ||
            !isset($_REQUEST['prioridad']) || !isset($_REQUEST['fecha_asignacion']) ||
            !isset($_REQUEST['fecha_finalizacion']) || !isset($_REQUEST['tareas_id1'])
        ) {
            header('Location: AsignarTareasC.php?msg=' . base64_encode(Constants::ERROR_INSERT));
            exit();
        }
        $asunto = htmlspecialchars(trim($_REQUEST['asunto']), ENT_QUOTES, 'UTF-8');
        $estado_asignacion = htmlspecialchars(trim($_REQUEST['estado_asignacion']), ENT_QUOTES, 'UTF-8');
        $prioridad = htmlspecialchars(trim($_REQUEST['prioridad']), ENT_QUOTES, 'UTF-8');
        $fecha_asignacion = htmlspecialchars(trim($_REQUEST['fecha_asignacion']), ENT_QUOTES, 'UTF-8');
        $fecha_finalizacion = htmlspecialchars(trim($_REQUEST['fecha_finalizacion']), ENT_QUOTES, 'UTF-8');
        $tareas_id1 = htmlspecialchars(trim($_REQUEST['tareas_id1']), ENT_QUOTES, 'UTF-8');

        // Comprobamos si al menos uno de los campos de empleados_id y voluntarios_id está relleno
        if (
            !isset($_REQUEST['empleados_id']) && empty($_REQUEST['empleados_id']) &&
            !isset($_REQUEST['voluntarios_id']) && empty($_REQUEST['voluntarios_id'])
        ) {
            header('Location: AsignarTareasC.php?msg=' . base64_encode(Constants::ERROR_TAREA_EMPLEADO_VOLUNTARIO));
            exit();
        }
        // Guardamos los valores de empleados_id y voluntarios_id en variables que luego se usarán en el array
        $empleados_id = !empty($_REQUEST['empleados_id']) ? htmlspecialchars(trim($_REQUEST['empleados_id']), ENT_QUOTES, 'UTF-8') : NULL;
        $voluntarios_id = !empty($_REQUEST['voluntarios_id']) ? htmlspecialchars(trim($_REQUEST['voluntarios_id']), ENT_QUOTES, 'UTF-8') : NULL;


        // Comprobamos que estos valores existan en la bd
        if ($empleados_id != NULL) {
            $r = $this->asignar->queryparam(Constants::GET_EMPLEADO, ['id' => $empleados_id]);
            if (!$r) {
                header('Location: AsignarTareasC.php?msg=' . base64_encode(Constants::ERROR_DONT_EXIST_EMPLOYEE));
                exit();
            }
        }
        // Comprobamos que estos valores existan en la bd
        if ($voluntarios_id != NULL) {
            $r = $this->asignar->queryparam(Constants::GET_VOLUNTARIO, ['id' => $voluntarios_id]);
            if (!$r) {
                header('Location: AsignarTareasC.php?msg=' . base64_encode(Constants::ERROR_DONT_EXIST_VOLUNTEER));
                exit();
            }
        }

        $jaulas_id = null;
        // Comprobamos si se ha asignado una jaula
        if (
            isset($_REQUEST['jaulas_id']) && !empty($_REQUEST['jaulas_id'])
        ) {
            $jaulas_id = htmlspecialchars(trim($_REQUEST['jaulas_id']), ENT_QUOTES, 'UTF-8');
            // Comprobamos que dicha jaula existe en la bd
            $r = $this->asignar->queryparam(Constants::GET_JAULA, ['id' => $jaulas_id]);
            if (!$r) {
                header('Location: AsignarTareasC.php?msg=' . base64_encode(Constants::ERROR_DONT_EXIST_CAGE));
                exit();
            }
        }

        // Insertamos la asignación en la bd
        $result = $this->asignar->insert([
            'asunto' => $asunto, 'estado_asignacion' => $estado_asignacion, 'prioridad' => $prioridad, 'fecha_asignacion' => $fecha_asignacion,
            'fecha_finalizacion' => $fecha_finalizacion, 'tareas_id1' => $tareas_id1, 'empleados_id' => $empleados_id, 'voluntarios_id' => $voluntarios_id,
            'jaulas_id' => $jaulas_id
        ]);

        if ($result == false) {
            // Si no se ha podido insertar la asignacion
            header('Location: AsignarTareasC.php?msg=' . base64_encode(Constants::ERROR_INSERT));
            exit();
        }

        // Rederigimos a la página del registro
        header('Location: AsignarTareasC.php?id=' . $result); //Si todo ha ido bien, se redirige a la página de la asignacion creada
        exit();
    }

    private function update()
    {        
        if (!isset($_REQUEST['id']) || empty($_REQUEST['id'])) {
            header('Location: AsignarTareasC.php?msg=' . base64_encode(Constants::ERROR_UPDATE));
            exit();
        }
        
        $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8');
        
        $r = $this->asignar->queryparam(Constants::GET_TAREA, ['id' => $id]);
        if (!$r) {
            header('Location: AsignarTareasC.php?msg=' . base64_encode(Constants::ERROR_UPDATE));
            exit();
        }
        
        if (
            !isset($_REQUEST['asunto']) || !isset($_REQUEST['estado_asignacion']) ||
            !isset($_REQUEST['prioridad']) || !isset($_REQUEST['fecha_asignacion']) ||
            !isset($_REQUEST['fecha_finalizacion']) || !isset($_REQUEST['tareas_id1'])
        ) {
            header('Location: AsignarTareasC.php?msg=' . base64_encode(Constants::ERROR_UPDATE));
            exit();
        }
        
        $asunto = htmlspecialchars(trim($_REQUEST['asunto']), ENT_QUOTES, 'UTF-8');
        $estado_asignacion = htmlspecialchars(trim($_REQUEST['estado_asignacion']), ENT_QUOTES, 'UTF-8');
        $prioridad = htmlspecialchars(trim($_REQUEST['prioridad']), ENT_QUOTES, 'UTF-8');
        $fecha_asignacion = htmlspecialchars(trim($_REQUEST['fecha_asignacion']), ENT_QUOTES, 'UTF-8');
        $fecha_finalizacion = htmlspecialchars(trim($_REQUEST['fecha_finalizacion']), ENT_QUOTES, 'UTF-8');
        $tareas_id1 = htmlspecialchars(trim($_REQUEST['tareas_id1']), ENT_QUOTES, 'UTF-8');
        
        if (
            !isset($_REQUEST['empleados_id']) && empty($_REQUEST['empleados_id']) &&
            !isset($_REQUEST['voluntarios_id']) && empty($_REQUEST['voluntarios_id'])
        ) {
            header('Location: AsignarTareasC.php?msg=' . base64_encode(Constants::ERROR_TAREA_EMPLEADO_VOLUNTARIO));
            exit();
        }
        
        $empleados_id = !empty($_REQUEST['empleados_id']) ? htmlspecialchars(trim($_REQUEST['empleados_id']), ENT_QUOTES, 'UTF-8') : NULL;
        $voluntarios_id = !empty($_REQUEST['voluntarios_id']) ? htmlspecialchars(trim($_REQUEST['voluntarios_id']), ENT_QUOTES, 'UTF-8') : NULL;
        
        if ($empleados_id != NULL) {
            $r = $this->asignar->queryparam(Constants::GET_EMPLEADO, ['id' => $empleados_id]);
            if (!$r) {
                header('Location: AsignarTareasC.php?msg=' . base64_encode(Constants::ERROR_DONT_EXIST_EMPLOYEE));
                exit();
            }
        }

        if ($voluntarios_id != NULL) {
            $r = $this->asignar->queryparam(Constants::GET_VOLUNTARIO, ['id' => $voluntarios_id]);
            if (!$r) {
                header('Location: AsignarTareasC.php?msg=' . base64_encode(Constants::ERROR_DONT_EXIST_VOLUNTEER));
                exit();
            }
        }

        $jaulas_id = null;        
        if (isset($_REQUEST['jaulas_id']) && !empty($_REQUEST['jaulas_id'])) {
            $jaulas_id = htmlspecialchars(trim($_REQUEST['jaulas_id']), ENT_QUOTES, 'UTF-8');            
            $r = $this->asignar->queryparam(Constants::GET_JAULA, ['id' => $jaulas_id]);
            if (!$r) {
                header('Location: AsignarTareasC.php?msg=' . base64_encode(Constants::ERROR_DONT_EXIST_CAGE));
                exit();
            }
        }
        
        $result = $this->asignar->queryParam(Constants::UPDATE_TAREA_ASIGNADA, [
            'id' => $id,
            'asunto' => $asunto,
            'estado_asignacion' => $estado_asignacion,
            'prioridad' => $prioridad,
            'fecha_asignacion' => $fecha_asignacion,
            'fecha_finalizacion' => $fecha_finalizacion,
            'tareas_id1' => $tareas_id1,
            'empleados_id' => $empleados_id,
            'voluntarios_id' => $voluntarios_id,
            'jaulas_id' => $jaulas_id
        ]);

        if ($result == false) {
            header('Location: AsignarTareasC.php?msg=' . base64_encode(Constants::ERROR_UPDATE));
            exit();
        }
        
        header('Location: AsignarTareasC.php?id=' . $id);
        exit();
    }


    private function sdelete()
    {
        if (!isset($_REQUEST['id'])) {  // Si no trae la clave id en el array de $_REQUEST
            $this->setMsg(base64_encode(Constants::ERROR_DELETE));
            header('Location: AsignarTareasC.php?msg=' . $this->getMsg());
            exit();
        }
        $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8'); // Limpiamos la cadena
        $data_bd = $this->asignar->queryParam(Constants::GET_TAREA_ASIGNADA, ['id' => $id]);    // Comprobamos que existe un usuario en la bd con ese id

        if ($data_bd == null || $data_bd == false) {  // Si no se ha encontrado la tarea asignada, se informa
            $this->setMsg(base64_encode(Constants::ERROR_ROW_NOT_FOUND));
            header('Location: AsignarTareasC.php?msg=' . $this->getMsg());
            exit();
        }

        $result = $this->asignar->queryParam(Constants::DELETE_TAREA_ASIGNADA, ['id' => $id]);  // Procedemos con el soft delete        

        if ($result == false) { // Si no se ha podido realizar, lo informamos
            $this->setMsg(base64_encode(Constants::ERROR_DELETE));
            header('Location: AsignarTareasC.php?msg=' . $this->getMsg()); // TO DO!!!
            exit();
        }
        $this->setMsg(base64_encode(Constants::DELETE_ROW));
        header('Location: AsignarTareasC.php?msg=' . $this->getMsg()); // TO DO!!!
        exit();
    }


    private function undelete()
    {
        if (!isset($_REQUEST['id'])) {  // Si no trae la clave id en el array de $_REQUEST
            $this->setMsg(base64_encode(Constants::ERROR_UNDELETE));
            header('Location: AsignarTareasC.php?msg=' . $this->getMsg());
            exit();
        }

        $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8'); // Limpiamos la cadena
        $data_bd = $this->asignar->queryParam(Constants::GET_TAREA_ASIGNADA, ['id' => $id]);    // Comprobamos que existe una asignacion en la bd con ese id

        if ($data_bd == null || $data_bd == false) {  // Si no se ha encontrado, se informa
            $this->setMsg(base64_encode(Constants::ERROR_ROW_NOT_FOUND));
            header('Location: AsignarTareasC.php?msg=' . $this->getMsg());
            exit();
        }
        if ($data_bd[0]['disponible'] == 1) { // Se comprueba que el registro esté inactivo
            $this->setMsg(base64_encode(Constants::ERROR_ROW_NOT_INACTIVE));
            header('Location: AsignarTareasC.php?msg=' . $this->getMsg());
            exit();
        }

        $result = $this->asignar->queryParam(Constants::UPDT_UNDELETE_TAREA_ASIGNADA, ['id' => $id]);

        if ($result == false) {
            $this->setMsg(base64_encode(Constants::ERROR_UNDELETE));
            header('Location: AsignarTareasC.php?msg=' . $this->getMsg());
            exit();
        }

        $this->setMsg(base64_encode(Constants::UNDELETE_ROW));

        header('Location: AsignarTareasC.php?msg=' . $this->getMsg());
        exit();
    }

    private function show_delete_rows()
    {
        echo json_encode($this->asignar->query(Constants::GET_TAREAS_ASIGNADAS_INACTIVE));
    }

    private function get_tasks_home()
    {
        if(isset($_REQUEST['estado'])){
            $estado = $_REQUEST['estado'];

            $query = ($estado == 'finished') ? Constants::GET_TAREAS_EMPLEADO_TERMINADAS : Constants::GET_TAREAS_EMPLEADO;
            echo json_encode($this->asignar->queryParam($query, ['id' => $_REQUEST['id']]));
        }
    }

    private function pagination()
    {
        // Obtenemos los valores nuevos (si es que hay)
        $this->ord = $this->asignar->get_value("ord", $this->ord);
        $this->field = $this->asignar->get_value("field", $this->field);
        $this->amount = $this->asignar->get_value("amount", $this->amount);
        $this->page = $this->asignar->get_value("page", $this->page);
        $this->search_val = (isset($_POST['search_value']) && !empty($_POST['search_value']) && $_POST['search_value'] != '' && $_POST['search_value'] != null) ? ('%' . $this->asignar->get_value("search_value", $_POST['search_value']) . '%') : false;

        $data = ($this->search_val) ? ($this->asignar->queryParamSearch(Constants::SEARCH_TAREAS_ASIGNADAS_TABLE, $this->search_val, $this->ord, $this->field, $this->page, $this->amount)) : ($this->asignar->pagination_tareas_asignadas($this->ord, $this->field, $this->page, $this->amount));
        $total_pages = ($this->search_val) ? ceil(count($this->asignar->queryParam(Constants::SEARCH_TAREAS_ASIGNADAS_TABLE_TOTAL_PAGES, ['search_value' => $this->search_val])) / $this->amount) : ($this->asignar->total_pages_visibles("empleados", $this->amount));
        $total_pages = ($total_pages == 0) ? 1 : $total_pages;

        // La página actual
        $page = $this->getPage();
        $html_var = '';

        // Recorremos el array data y concatenamos el HTML generado dinámicamente
        foreach ($data as $show_data) {
            $url = "AsignarTareasC.php"; //URL destino

            // Concatenamos el HTML generado dinámicamente
            $html_var .= "<tr>";
            $html_var .= "<td class='sticky-column' id='showRegister' value='" . $show_data["id"] . "'> <a href='?id=" . $show_data["id"] . "&action=show_register'>" . $show_data["asunto"] . "</a> </td>";
            $html_var .= "<td>" . $show_data["estado_asignacion"] . "</td>";
            $html_var .= "<td>" . $show_data["prioridad"] . "</td>";
            $html_var .= "<td>" . $show_data["fecha_finalizacion"] . "</td>";
            $html_var .= "<td><a href='../controllers/EmpleadoC.php?id=" . $show_data["empleados_id"] . "&action=show_register'>" . $show_data["nombre_empleado"] . "</a></td>";
            $html_var .= "<td><a href='../controllers/VoluntarioC.php?id=" . $show_data["voluntarios_id"] . "&action=show_register'>" . $show_data["nombre_voluntario"] . "</a></td>";
            $html_var .= "<td class='ps-4 pe-2'>";
            $html_var .= '<a href="../controllers/AsignarTareasC.php?action=show_register&id=' . $show_data['id'] . '" class="btn btn-primary text-white btn-sm me-1">Ver</a>';
            $html_var .= '<a href="../controllers/AsignarTareasC.php?action=sdelete&id=' . $show_data['id'] . '" class="btn btn-danger text-white btn-sm me-1">Borrar</a>';            
            $html_var .= "</td>";
            $html_var .= "</tr>";
        }

        echo json_encode(array("total_pages" => $total_pages, "rows" => $html_var, 'pagination' => $this->asignar->generatePaginationHTML($page, $this->amount, $total_pages)));
    }

    private function change_assigned_to()
    {
        // Verificar si se han recibido los parámetros necesarios
        if (!isset($_REQUEST['id']) || (!isset($_REQUEST['empleados_id']) && !isset($_REQUEST['voluntarios_id']))) {
            $res = ['msg' => Constants::ERROR_UPDATE];
            echo json_encode($res);
        }

        $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8');
        $empleados_id = !empty($_REQUEST['empleados_id']) ? htmlspecialchars(trim($_REQUEST['empleados_id']), ENT_QUOTES, 'UTF-8') : null;
        $voluntarios_id = !empty($_REQUEST['voluntarios_id']) ? htmlspecialchars(trim($_REQUEST['voluntarios_id']), ENT_QUOTES, 'UTF-8') : null;

        if (empty($empleados_id) && empty($voluntarios_id)) {
            $res = ['msg' => Constants::ERROR_DONT_EXIST_EMPLOYEE];
            echo json_encode($res);
        }

        $empleado_a = [];
        $voluntario_a = [];
        if (!empty($empleados_id)) {
            $r = $this->asignar->queryparam(Constants::GET_EMPLEADO, ['id' => $empleados_id]);
            if (!$r) {
                $res = ['msg' => Constants::ERROR_DONT_EXIST_EMPLOYEE];
                echo json_encode($res);
            }
            $empleado_a = $r;
        }
        if (!empty($voluntarios_id)) {
            $r = $this->asignar->queryparam(Constants::GET_VOLUNTARIO, ['id' => $voluntarios_id]);
            if (!$r) {
                $res = ['msg' => Constants::ERROR_DONT_EXIST_VOLUNTEER];
                echo json_encode($res);
            }
            $voluntario_a = $r;
        }

        $result = $this->asignar->queryParam(Constants::UPDATE_ASSIGNED_TO_TAREA_ASIGNACION, ['id' => $id, 'empleados_id' => $empleados_id, 'voluntarios_id' => $voluntarios_id]);

        // Comprobamos que se ha modificado bien
        if ($result == false) {
            $res = ['msg' => Constants::ERROR_UPDATE];
            echo json_encode($res);
        }

        // Preparar respuesta de éxito para AJAX
        $response = ['success' => true, 'msg' => 'Se ha reasignado la tarea', 'empleado' => $empleado_a, 'voluntario' => $voluntario_a];
        echo json_encode($response);
    }
}

//Comprobamos que la sesion esta iniciada
session_start();
//Si no tenemos guardado login 
if (!Utils::is_logged_in()) {
    header("Location:../../public/Login.php");
    die;
}
$especie = new AsignarTareasC();
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
