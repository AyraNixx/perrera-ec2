<?php

use utils\Utils;
use \model\Duenio;
use utils\Constants;

// use \Exception;

require_once "../utils/Utils.php";
require_once "../utils/Constants.php";
require_once "../models/Duenio.php";

class DuenioC
{
    // 
    // -- ATRIBUTOS
    // 
    private $duenio;
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
        $this->duenio = new Duenio();
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
            case "get_rows_availables":
                $this->get_rows_availables();
                break;
            case "delete_animal_from_list":
                $this->delete_animal_from_list();
                break;
            default:
                $this->index();
                break;
        }
    }

    private function index($view = 'V_Duenios.php')
    {
        if (strtoupper($_SESSION["rol"]) == USER_ROL_ADMIN) {
            $data = $this->duenio->pagination_all('duenios', $this->ord, $this->field, $this->page, $this->amount);
            $total_pages = $this->duenio->total_pages('duenios', $this->amount);
        } else {
            $data = $this->duenio->pagination_visible('duenios', $this->ord, $this->field, $this->page, $this->amount); // TO DO --> Necesito modificarlo un poco para que no se visualicen las que tienen disponible = 0
            $total_pages = $this->duenio->total_pages_visibles('duenios', $this->amount);
        }
        $page = $this->getPage();
        $new_msg = $this->getMsg();
        require_once "../views/" . $view;
    }

    public function show_register($id = '')
    {
        if ((isset($_REQUEST['id']) && !empty($_REQUEST['id'])) || !empty($id)) {
            $id = isset($_REQUEST['id']) ? htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8') : htmlspecialchars(trim($id), ENT_QUOTES, 'UTF-8');
            $data = $this->duenio->queryParam(Constants::GET_DUENIO, ['id' => $id])[0];
            require_once Constants::VIEW_DUENIO;
        }
    }

    private function add()
    {
        if (
            isset($_REQUEST['nombre']) && isset($_REQUEST['apellidos']) && isset($_REQUEST['fech_nac'])
            && isset($_REQUEST['NIF']) && isset($_REQUEST['correo']) && isset($_REQUEST['telf'])
            && isset($_REQUEST['ocupacion']) && isset($_REQUEST['direccion']) && isset($_REQUEST['ciudad'])
            && isset($_REQUEST['codigo_postal']) && isset($_REQUEST['pais']) && isset($_REQUEST['permiso_visita'])
            && isset($_REQUEST['fecha_ultima_visita']) && isset($_REQUEST['observaciones']) && isset($_REQUEST['animales_id'])
        ) {
            $nombre = htmlspecialchars(trim($_REQUEST['nombre']), ENT_QUOTES, 'UTF-8');
            $apellidos = htmlspecialchars(trim($_REQUEST['apellidos']), ENT_QUOTES, 'UTF-8');
            $fech_nac = htmlspecialchars(trim($_REQUEST['fech_nac']), ENT_QUOTES, 'UTF-8');
            $NIF = htmlspecialchars(trim($_REQUEST['NIF']), ENT_QUOTES, 'UTF-8');
            $correo = htmlspecialchars(trim($_REQUEST['correo']), ENT_QUOTES, 'UTF-8');
            $telf = htmlspecialchars(trim($_REQUEST['telf']), ENT_QUOTES, 'UTF-8');
            $ocupacion = htmlspecialchars(trim($_REQUEST['ocupacion']), ENT_QUOTES, 'UTF-8');
            $direccion = htmlspecialchars(trim($_REQUEST['direccion']), ENT_QUOTES, 'UTF-8');
            $ciudad = htmlspecialchars(trim($_REQUEST['ciudad']), ENT_QUOTES, 'UTF-8');
            $codigo_postal = htmlspecialchars(trim($_REQUEST['codigo_postal']), ENT_QUOTES, 'UTF-8');
            $pais = htmlspecialchars(trim($_REQUEST['pais']), ENT_QUOTES, 'UTF-8');
            $permiso_visita = htmlspecialchars(trim($_REQUEST['permiso_visita']), ENT_QUOTES, 'UTF-8');
            $fecha_ultima_visita = htmlspecialchars(trim($_REQUEST['fecha_ultima_visita']), ENT_QUOTES, 'UTF-8');
            $observaciones = htmlspecialchars(trim($_REQUEST['observaciones']), ENT_QUOTES, 'UTF-8');
            $animales_id = htmlspecialchars(trim($_REQUEST['animales_id']), ENT_QUOTES, 'UTF-8');

            $result = $this->duenio->insert([
                'nombre' => $nombre, 'apellidos' => $apellidos, 'fech_nac' => $fech_nac, 'NIF' => $NIF,
                'correo' => $correo, 'telf' => $telf, 'ocupacion' => $ocupacion, 'direccion' => $direccion,
                'ciudad' => $ciudad, 'codigo_postal' => $codigo_postal, 'pais' => $pais,
                'permiso_visita' => $permiso_visita, 'fecha_ultima_visita' => $fecha_ultima_visita,
                'observaciones' => $observaciones, 'animales_id' => $animales_id
            ]);

            if ($result == false) {
                $this->setMsg(Constants::ERROR_INSERT);
            }
            $this->show_register($result);
        } else {
            $this->setMsg(Constants::ERROR_INSERT);
        }
    }

    private function update()
    {
        if (
            isset($_REQUEST['id']) && isset($_REQUEST['nombre']) && isset($_REQUEST['apellidos']) && isset($_REQUEST['fech_nac'])
            && isset($_REQUEST['NIF']) && isset($_REQUEST['correo']) && isset($_REQUEST['telf'])
            && isset($_REQUEST['ocupacion']) && isset($_REQUEST['direccion']) && isset($_REQUEST['ciudad'])
            && isset($_REQUEST['codigo_postal']) && isset($_REQUEST['pais']) && isset($_REQUEST['permiso_visita'])
            && isset($_REQUEST['fecha_ultima_visita']) && isset($_REQUEST['observaciones'])
        ) {
            $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8');
            $nombre = htmlspecialchars(trim($_REQUEST['nombre']), ENT_QUOTES, 'UTF-8');
            $apellidos = htmlspecialchars(trim($_REQUEST['apellidos']), ENT_QUOTES, 'UTF-8');
            $fech_nac = htmlspecialchars(trim($_REQUEST['fech_nac']), ENT_QUOTES, 'UTF-8');
            $NIF = htmlspecialchars(trim($_REQUEST['NIF']), ENT_QUOTES, 'UTF-8');
            $correo = htmlspecialchars(trim($_REQUEST['correo']), ENT_QUOTES, 'UTF-8');
            $telf = htmlspecialchars(trim($_REQUEST['telf']), ENT_QUOTES, 'UTF-8');
            $ocupacion = htmlspecialchars(trim($_REQUEST['ocupacion']), ENT_QUOTES, 'UTF-8');
            $direccion = htmlspecialchars(trim($_REQUEST['direccion']), ENT_QUOTES, 'UTF-8');
            $ciudad = htmlspecialchars(trim($_REQUEST['ciudad']), ENT_QUOTES, 'UTF-8');
            $codigo_postal = htmlspecialchars(trim($_REQUEST['codigo_postal']), ENT_QUOTES, 'UTF-8');
            $pais = htmlspecialchars(trim($_REQUEST['pais']), ENT_QUOTES, 'UTF-8');
            $permiso_visita = htmlspecialchars(trim($_REQUEST['permiso_visita']), ENT_QUOTES, 'UTF-8');
            $fecha_ultima_visita = htmlspecialchars(trim($_REQUEST['fecha_ultima_visita']), ENT_QUOTES, 'UTF-8');
            $observaciones = htmlspecialchars(trim($_REQUEST['observaciones']), ENT_QUOTES, 'UTF-8');

            $result = $this->duenio->queryParam(Constants::UPDT_DUENIO, [
                'id' => $id, 'nombre' => $nombre, 'apellidos' => $apellidos, 'fech_nac' => $fech_nac, 'NIF' => $NIF,
                'correo' => $correo, 'telf' => $telf, 'ocupacion' => $ocupacion, 'direccion' => $direccion,
                'ciudad' => $ciudad, 'codigo_postal' => $codigo_postal, 'pais' => $pais,
                'permiso_visita' => $permiso_visita, 'fecha_ultima_visita' => $fecha_ultima_visita,
                'observaciones' => $observaciones
            ]);

            if ($result == false) {
                $this->setMsg(Constants::ERROR_UPDATE);
            }
            //$this->index();  // TO DO!!!!!
            $this->show_register($result);
        } else {
            $this->setMsg(Constants::ERROR_UPDATE);
            $this->index();  // TO DO!!!!!
        }
    }

    private function sdelete()
    {
        if (isset($_REQUEST['id'])) {
            $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8');
            $result = $this->duenio->queryParam(Constants::DELETE_DUENIO, ['id' => $id]);
            $this->setMsg("Registro borrado con éxito.");
            if ($result == false) {
                $this->setMsg(Constants::ERROR_DELETE);
            }
            $this->index();  // TO DO!!!!!
        } else {
            $this->setMsg(Constants::ERROR_DELETE);
        }
    }

    private function undelete()
    {
        if (isset($_REQUEST['id'])) {
            $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8');
            $result = $this->duenio->queryParam(Constants::UPDT_UNDELETE_DUENIOS, ['id' => $id]);
            $this->setMsg("Registro recuperado con éxito.");
            if ($result == false) {
                $this->setMsg(Constants::ERROR_UNDELETE);
            }
            $this->index();  // TO DO!!!!!
        } else {
            $this->setMsg(Constants::ERROR_DELETE);
        }
    }

    private function pagination()
    {
        // Obtenemos los valores nuevos (si es que hay)
        $this->ord = $this->duenio->get_value("ord", $this->ord);
        $this->field = $this->duenio->get_value("field", $this->field);
        $this->amount = $this->duenio->get_value("amount", $this->amount);
        $this->page = $this->duenio->get_value("page", $this->page);
        $this->search_val = (isset($_POST['search_value']) && !empty($_POST['search_value']) && $_POST['search_value'] != '' && $_POST['search_value'] != null) ? ('%' . $this->duenio->get_value("search_value", $_POST['search_value']) . '%') : false;

        $data = ($this->search_val) ? ($this->duenio->queryParamSearch(Constants::SEARCH_DUENIOS_TABLE, $this->search_val, $this->ord, $this->field, $this->page, $this->amount)) : ($this->duenio->pagination_all('duenios', $this->ord, $this->field, $this->page, $this->amount));
        $total_pages = ($this->search_val) ? ceil(count($this->duenio->queryParam(Constants::SEARCH_DUENIOS_TABLE_TOTAL_PAGES, ['search_value' => $this->search_val])) / $this->amount) : ((strtoupper($_SESSION["rol"]) == USER_ROL_ADMIN)  ? $this->duenio->total_pages("duenio", $this->amount) : $this->duenio->total_pages_visibles("duenio", $this->amount));
        $total_pages = ($total_pages == 0) ? 1 : $total_pages;

        // La página actual
        $page = $this->getPage();
        $html_var = '';

        // Recorremos el array data y concatenamos el HTML generado dinámicamente
        foreach ($data as $show_data) {
            $url = "DuenioC.php"; //URL destino

            // Concatenamos el HTML generado dinámicamente
            $html_var .= "<tr>";
            $html_var .= "<td class='sticky-column' id='showRegister' value='" . $show_data["id"] . "'> <a href='?id=" . $show_data["id"] . "&action=show_register'>" . $show_data["nombre"] . "</a> </td>";
            $html_var .= "<td>" . $show_data["apellidos"] . "</td>";
            $html_var .= "<td>" . $show_data["NIF"] . "</td>";
            $html_var .= "<td>" . $show_data["correo"] . "</td>";
            $html_var .= "<td>" . $show_data["estado_solicitud"] . "</td>";
            $html_var .= "<td>" . (($show_data["disponible"] == '0') ? 'SI' : 'NO') . "</td>";
            $html_var .= "<td class='ps-4 pe-2'>";
            $html_var .= "<div class='btn-group dropdown d-block' style='position:relative'>";
            $html_var .= "<button type='button' onclick='show_btn_options(event)' id='add' class='button-dropdown rounded' style='padding: .8em;width: 1.3em;height: 1.3em;'>";
            $html_var .= "<i class='fa-solid fa-caret-down text-primary'></i>";
            $html_var .= "</button>";
            $html_var .= "<div class='btn-dropdown-options w-auto position-absolute start-0'>";
            $html_var .= "<ul class='list-unstyled m-0'>";
            $html_var .= "<li>";
            $html_var .= "<a href='../controllers/DuenioC.php?action=add_or_update&id=" . $show_data["id"] . "'>Editar</a>";
            $html_var .= "</li>";
            $html_var .= "<li>";
            $html_var .= "<a href='../controllers/DuenioC.php?action=sdelete&id=" . $show_data["id"] . "'>Borrar</a>";
            $html_var .= "</li>";
            if ($_SESSION["rol"] == Constants::ROL_ADMIN && $show_data["disponible"] == '0') {
                $html_var .= "<li>";
                $html_var .= "<a href='../controllers/DuenioC.php?action=undelete&id=" . $show_data["id"] . "'>Recuperar registro</a>";
                $html_var .= "</li>";
            }
            $html_var .= "</ul>";
            $html_var .= "</div>";
            $html_var .= "</div>";
            $html_var .= "</td>";
            $html_var .= "</tr>";
        }

        echo json_encode(array("total_pages" => $total_pages, "rows" => $html_var, 'pagination' => $this->duenio->generatePaginationHTML($page, $this->amount, $total_pages)));
    }

    private function get_rows_availables()
    {
        echo json_encode($this->duenio->query(Constants::GET_DUENIO_SELECT));        
    }

    public function delete_animal_from_list()
    {
        if (isset($_REQUEST['id']) &&  isset($_REQUEST['animal_id'])) {
            $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8');
            $animal_id = htmlspecialchars(trim($_REQUEST['animal_id']), ENT_QUOTES, 'UTF-8');
            echo json_encode($this->duenio->queryParam(Constants::DELETE_ANIMAL_DUENIO, ['id' => $id, 'animal_id' => $animal_id]));
        }
    }
}

//Comprobamos que la sesion esta iniciada
session_start();
//Si no tenemos guardado login 
if (!Utils::is_logged_in()) {
    header("Location:../../public/Login.php");
    die;
}
$especie = new DuenioC();
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
