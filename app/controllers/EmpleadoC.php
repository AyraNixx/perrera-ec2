<?php

use utils\Utils;
use \model\Empleado;
use \model\Img;
use utils\Constants;

// use \Exception;

require_once "../utils/Utils.php";
require_once "../utils/Constants.php";
require_once "../models/Empleado.php";
require_once "../models/Img.php";

class EmpleadoC
{
    // 
    // -- ATRIBUTOS
    // 
    private $empleado;
    private $imgM;
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
        $this->empleado = new Empleado();
        $this->imgM = new Img('empleados');
        $this->msg = null;

        $this->field = "nombre";
        $this->ord = "ASC";
        $this->amount = "10";
        $this->page = "1";
    }

    // 
    // -- GETTERS AND SETTERS
    // 

    public function getMsg(){return $this->msg;}
    public function setMsg($msg){return $this->msg = $msg;}
    public function getField(){return $this->field;}
    public function setField($field){return $this->field = $field;}
    public function getOrd(){return $this->ord;}
    public function setOrd($ord){return $this->ord = $ord;}
    public function getAmount(){return $this->amount;}
    public function setAmount($amount){return $this->amount = $amount;}
    public function getPage(){return $this->page;}
    public function setPage($page){return $this->page = $page;}
    public function getSearch_val(){return $this->search_val;}
    public function setSearch_val($search_val){return $this->search_val = $search_val;}


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

    private function index($view = 'V_Empleados.php')
    {
        if (!isset($_REQUEST['id'])) {
            $data = $this->empleado->pagination_visible('empleados', $this->ord, $this->field, $this->page, $this->amount);
            $total_pages = $this->empleado->total_pages_visibles('empleados', $this->amount);
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
            $data = $this->empleado->queryParam(Constants::GET_EMPLEADO, ['id' => $id])[0];
            require_once Constants::VIEW_EMPLEADO;
        }
    }


    private function add()
    {
        if (
            !isset($_REQUEST['nombre']) || !isset($_REQUEST['apellidos']) || !isset($_REQUEST['fech_nac'])
            || !isset($_REQUEST['NIF']) || !isset($_REQUEST['correo']) || !isset($_REQUEST['telf'])
            || !isset($_REQUEST['direccion']) || !isset($_REQUEST['ciudad']) || !isset($_REQUEST['codigo_postal'])
            || !isset($_REQUEST['pais']) || !isset($_REQUEST['roles_id'])
        ) {
            // header('Location: EmpleadoC.php?msg=' . base64_encode(Constants::ERROR_INSERT));
            // exit();
        }
        $nombre = htmlspecialchars(trim($_REQUEST['nombre']), ENT_QUOTES, 'UTF-8');
        $apellidos = htmlspecialchars(trim($_REQUEST['apellidos']), ENT_QUOTES, 'UTF-8');
        $fech_nac = htmlspecialchars(trim($_REQUEST['fech_nac']), ENT_QUOTES, 'UTF-8');
        $NIF = htmlspecialchars(trim($_REQUEST['NIF']), ENT_QUOTES, 'UTF-8');
        $correo = htmlspecialchars(trim($_REQUEST['correo']), ENT_QUOTES, 'UTF-8');
        $telf = htmlspecialchars(trim($_REQUEST['telf']), ENT_QUOTES, 'UTF-8');
        $direccion = htmlspecialchars(trim($_REQUEST['direccion']), ENT_QUOTES, 'UTF-8');
        $ciudad = htmlspecialchars(trim($_REQUEST['ciudad']), ENT_QUOTES, 'UTF-8');
        $codigo_postal = htmlspecialchars(trim($_REQUEST['codigo_postal']), ENT_QUOTES, 'UTF-8');
        $pais = htmlspecialchars(trim($_REQUEST['pais']), ENT_QUOTES, 'UTF-8');
        $roles_id = htmlspecialchars(trim($_REQUEST['roles_id']), ENT_QUOTES, 'UTF-8');

        $data_bd = $this->empleado->user_found($correo);
        if ($data_bd !== null && $data_bd !== false) {  // Comprobamos que no exista un usuario con el mismo correo en la bd
            // Comprobamos si se trata de un usuario inactivo
            if ($data_bd['disponible'] == '0') {
                // header('Location: EmpleadoC.php?msg=' . base64_encode(Constants::ERROR_EXIST_EMPLOYEE_INACTIVE));
            } else {
                // header('Location: EmpleadoC.php?msg=' . base64_encode(Constants::ERROR_EXIST_EMPLOYEE));
            }
            // exit();
        }

        $code = htmlspecialchars(trim(Utils::generate_code()), ENT_QUOTES, 'UTF-8');    // Generamos un código inicial
        $code_hash = password_hash($code, PASSWORD_DEFAULT);

        // Insertamos el empleado en la bd
        $result = $this->empleado->insert([
            'nombre' => $nombre, 'apellidos' => $apellidos, 'fech_nac' => $fech_nac, 'NIF' => $NIF, 'correo' => $correo, 'telf' => $telf, 'direccion' => $direccion, 'ciudad' => $ciudad, 'codigo_postal' => $codigo_postal,
            'pais' => $pais, 'roles_id' => $roles_id, 'code' => $code_hash
        ]);

        if ($result == false) { // Si no se ha podido insertar el empleado
            // header('Location: EmpleadoC.php?msg=' . base64_encode(Constants::ERROR_INSERT));
            // exit();
        }

        if ($_FILES['imgs'] && !empty($_FILES['imgs']['name'])) { // Se comprueba si se han añadido imágenes
            $data_imgs = $this->imgM->addImgs($result, $_FILES['imgs']);
            if (!$data_imgs) { // Si no se han podido añadir las imágenes, se informa de que no se han podido recuperar
                // header('Location: EmpleadoC.php?id=' . $result . '&msg=' . base64_encode(Constants::ERROR_ADD_IMG));
                // exit();
            }
        }

        // Generamos un array para almacenar los valores neesarios para el correo de notificación
        $data_email = [
            'subject' => Constants::SEND_WELCOME_EMAIL_SUBJECT,
            'name' => $nombre . ' ' . $apellidos,
            'email' => $correo,
            'code' => $code,
            'link' => Constants::CONTROLLER_EMPLOYEE . '?action=activate_employee'
        ];

        $send_msg = Utils::send_email($data_email); // Enviamos el email

        // Si no se ha podido enviar el correo
        if ($send_msg == null || empty($send_msg)) {
            // header('Location: EmpleadoC.php?id=' . $result . '&msg=' . base64_encode(Constants::ERROR_SEND_MSG_WELCOME));
            // exit();
        }

        // header('Location: EmpleadoC.php?id=' . $result); //Si todo ha ido bien, se redirige a la página del empleado creado
        // exit();
    }


    private function sdelete()
    {
        if (!isset($_REQUEST['id'])) {  // Si no trae la clave id en el array de $_REQUEST
            $this->setMsg(base64_encode(Constants::ERROR_DELETE));
            header('Location: EmpleadoC.php?msg=' . $this->getMsg());
            exit();
        }
        $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8'); // Limpiamos la cadena
        $data_bd = $this->empleado->queryParam(Constants::GET_EMPLEADO, ['id' => $id]);    // Comprobamos que existe un usuario en la bd con ese id

        if ($data_bd == null || $data_bd == false) {  // Si no se ha encontrado el usuario, se informa
            $this->setMsg(base64_encode(Constants::ERROR_ROW_NOT_FOUND));
            header('Location: EmpleadoC.php?msg=' . $this->getMsg());
            exit();
        }

        $result = $this->empleado->queryParam(Constants::DELETE_EMPLEADO, ['id' => $id]);  // Procedemos con el soft delete        

        if ($result == false) { // Si no se ha podido realizar, lo informamos
            $this->setMsg(base64_encode(Constants::ERROR_DELETE));
            header('Location: EmpleadoC.php?msg=' . $this->getMsg() . ((isset($_REQUEST['from']) && $_REQUEST['from'] == 'index') ? '' : 'id=' . $id));
            exit();
        }

        // TO DO !!! -> ELIMINAR LAS TAREAS EN LAS QUE SE ENCUENTRA PARTICIPANDO EL EMPLEADO

        $this->setMsg(base64_encode(Constants::DELETE_ROW));
        header('Location: EmpleadoC.php?msg=' . $this->getMsg() . ((isset($_REQUEST['from']) && $_REQUEST['from'] == 'index') ? '' : 'id=' . $id));
        exit();
    }


    private function undelete()
    {
        if (!isset($_REQUEST['id'])) {  // Si no trae la clave id en el array de $_REQUEST
            $this->setMsg(base64_encode(Constants::ERROR_UNDELETE));
            header('Location: EmpleadoC.php?msg=' . $this->getMsg());
            exit();
        }

        $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8'); // Limpiamos la cadena
        $data_bd = $this->empleado->queryParam(Constants::GET_EMPLEADO, ['id' => $id]);    // Comprobamos que existe un usuario en la bd con ese id

        if ($data_bd == null || $data_bd == false) {  // Si no se ha encontrado el usuario, se informa
            $this->setMsg(base64_encode(Constants::ERROR_ROW_NOT_FOUND));
            header('Location: EmpleadoC.php?msg=' . $this->getMsg());
            exit();
        }
        if ($data_bd[0]['disponible'] == 1) { // Se comprueba que el registro esté inactivo
            $this->setMsg(base64_encode(Constants::ERROR_ROW_NOT_INACTIVE));
            header('Location: EmpleadoC.php?msg=' . $this->getMsg());
            exit();
        }

        $result = $this->empleado->queryParam(Constants::UPDT_UNDELETE_EMPLEADOS, ['id' => $id]);

        if ($result == false) {
            $this->setMsg(base64_encode(Constants::ERROR_UNDELETE));
            header('Location: EmpleadoC.php?msg=' . $this->getMsg());
            exit();
        }

        $this->setMsg(base64_encode(Constants::UNDELETE_ROW));

        header('Location: EmpleadoC.php?msg=' . $this->getMsg());
        exit();
    }

    private function show_delete_rows(){
        echo json_encode($this->empleado->query(Constants::GET_EMPLEADOS_INACTIVE));
    }


    private function pagination()
    {
        // Obtenemos los valores nuevos (si es que hay)
        $this->ord = $this->empleado->get_value("ord", $this->ord);
        $this->field = $this->empleado->get_value("field", $this->field);
        $this->amount = $this->empleado->get_value("amount", $this->amount);
        $this->page = $this->empleado->get_value("page", $this->page);
        $this->search_val = (isset($_POST['search_value']) && !empty($_POST['search_value']) && $_POST['search_value'] != '' && $_POST['search_value'] != null) ? ('%' . $this->empleado->get_value("search_value", $_POST['search_value']) . '%') : false;

        $data = ($this->search_val) ? ($this->empleado->queryParamSearch(Constants::SEARCH_EMPLEADOS_TABLE, $this->search_val, $this->ord, $this->field, $this->page, $this->amount)) : ($this->empleado->pagination_visible('empleados', $this->ord, $this->field, $this->page, $this->amount));
        $total_pages = ($this->search_val) ? ceil(count($this->empleado->queryParam(Constants::SEARCH_EMPLEADOS_TABLE_TOTAL_PAGES, ['search_value' => $this->search_val])) / $this->amount) : ($this->empleado->total_pages_visibles("empleados", $this->amount));
        $total_pages = ($total_pages == 0) ? 1 : $total_pages;

        // La página actual
        $page = $this->getPage();
        $html_var = '';

        // Recorremos el array data y concatenamos el HTML generado dinámicamente
        foreach ($data as $show_data) {
            $url = "EmpleadoC.php"; //URL destino

            // Concatenamos el HTML generado dinámicamente
            $html_var .= "<tr>";
            $html_var .= "<td class='sticky-column' id='showRegister' value='" . $show_data["id"] . "'> <a href='?id=" . $show_data["id"] . "&action=show_register'>" . $show_data["nombre"] . "</a> </td>";
            $html_var .= "<td>" . $show_data["apellidos"] . "</td>";
            $html_var .= "<td>" . $show_data["NIF"] . "</td>";
            $html_var .= "<td>" . $show_data["correo"] . "</td>";
            $html_var .= "<td class='ps-4 pe-2'>";
            $html_var .= "<div class='btn-group dropdown d-block' style='position:relative'>";
            $html_var .= "<button type='button' onclick='show_btn_options(event)' id='add' class='button-dropdown rounded' style='padding: .8em;width: 1.3em;height: 1.3em;'>";
            $html_var .= "<i class='fa-solid fa-caret-down text-primary'></i>";
            $html_var .= "</button>";
            $html_var .= "<div class='btn-dropdown-options w-auto position-absolute start-0'>";
            $html_var .= "<ul class='list-unstyled m-0'>";
            $html_var .= "<li>";
            $html_var .= "<a href='../controllers/EmpleadoC.php?action=add_or_update&id=" . $show_data["id"] . "'>Editar</a>";
            $html_var .= "</li>";
            $html_var .= "<li>";
            $html_var .= "<a href='../controllers/EmpleadoC.php?action=sdelete&id=" . $show_data["id"] . "'>Borrar</a>";
            $html_var .= "</li>";
            $html_var .= "</ul>";
            $html_var .= "</div>";
            $html_var .= "</div>";
            $html_var .= "</td>";
            $html_var .= "</tr>";
        }

        echo json_encode(array("total_pages" => $total_pages, "rows" => $html_var, 'pagination' => $this->empleado->generatePaginationHTML($page, $this->amount, $total_pages)));
    }
}

//Comprobamos que la sesion esta iniciada
session_start();
//Si no tenemos guardado login 
if (!Utils::is_logged_in()) {
    header("Location:../../public/Login.php");
    die;
}
$especie = new EmpleadoC();
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
