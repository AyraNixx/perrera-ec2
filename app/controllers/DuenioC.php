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
            case "show_delete_rows":
                $this->show_delete_rows();
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
        if (!isset($_REQUEST['id'])) {
            $data = $this->duenio->pagination_visible('duenios', $this->ord, $this->field, $this->page, $this->amount);
            $total_pages = $this->duenio->total_pages_visibles('duenios', $this->amount);
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
            $data = $this->duenio->queryParam(Constants::GET_DUENIO, ['id' => $id])[0];
            $new_msg = $this->getMsg();
            require_once Constants::VIEW_DUENIO;
        }
    }

    private function add()
    {
        if (
            !isset($_REQUEST['nombre']) || !isset($_REQUEST['apellidos']) || !isset($_REQUEST['fech_nac'])
            || !isset($_REQUEST['NIF']) || !isset($_REQUEST['correo']) || !isset($_REQUEST['telf'])
            || !isset($_REQUEST['ocupacion']) || !isset($_REQUEST['direccion']) || !isset($_REQUEST['ciudad'])
            || !isset($_REQUEST['codigo_postal']) || !isset($_REQUEST['pais']) || !isset($_REQUEST['permiso_visita'])
            || !isset($_REQUEST['fecha_ultima_visita']) || !isset($_REQUEST['observaciones']) || !isset($_REQUEST['animales_id'])
        ) {
            header('Location: DuenioC.php?msg=' . Constants::ERROR_INSERT);
            exit();
        }
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

        $id_d = $this->duenio->insert([
            'nombre' => $nombre, 'apellidos' => $apellidos, 'fech_nac' => $fech_nac, 'NIF' => $NIF,
            'correo' => $correo, 'telf' => $telf, 'ocupacion' => $ocupacion, 'direccion' => $direccion,
            'ciudad' => $ciudad, 'codigo_postal' => $codigo_postal, 'pais' => $pais,
            'permiso_visita' => $permiso_visita, 'fecha_ultima_visita' => $fecha_ultima_visita,
            'observaciones' => $observaciones, 'animales_id' => $animales_id
        ]);

        if ($id_d == false) {
            $this->setMsg(Constants::ERROR_INSERT);
            header('Location: DuenioC.php?msg=' . Constants::ERROR_INSERT);
            exit();
        }

        $result = $this->duenio->insert_into_historial($id_d, $animales_id);

        if ($result == false) {
            $this->setMsg('Se ha insertado el registro, pero ha habido un fallo al hacer el histórico del dueño.');
            header('Location: DuenioC.php?msg=' . 'Se ha insertado el registro, pero ha habido un fallo al hacer el histórico del dueño.');
            exit();
        }
        header('Location: DuenioC.php?id=' . $id_d);
        exit();
    }

    private function update()
    {
        if (
            !isset($_REQUEST['id']) || !isset($_REQUEST['nombre']) || !isset($_REQUEST['apellidos']) || !isset($_REQUEST['fech_nac'])
            || !isset($_REQUEST['NIF']) || !isset($_REQUEST['correo']) || !isset($_REQUEST['telf'])
            || !isset($_REQUEST['ocupacion']) || !isset($_REQUEST['direccion']) || !isset($_REQUEST['ciudad'])
            || !isset($_REQUEST['codigo_postal']) || !isset($_REQUEST['pais']) 
            || !isset($_REQUEST['fecha_ultima_visita']) || !isset($_REQUEST['observaciones'])
        ) {
            header('Location: DuenioC.php?msg=' . Constants::ERROR_UPDATE);
            exit();
        }
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
        $permiso_visita = (isset($_REQUEST['permiso_visita'])) ?  htmlspecialchars(trim($_REQUEST['permiso_visita']), ENT_QUOTES, 'UTF-8') : 0;
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
            header('Location: DuenioC.php?msg=' . Constants::ERROR_UPDATE . '&id=' . $id);
            exit();
        }
        header('Location: DuenioC.php?id=' . $id);
        exit();
    }

    private function sdelete()
    {
        if (!isset($_REQUEST['id'])) {
            $this->setMsg(base64_encode(Constants::ERROR_DELETE));
            header('Location: DuenioC.php?msg=' . $this->getMsg());
            exit();
        }
        $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8');
        $data_bd = $this->duenio->queryParam(Constants::GET_DUENIO, ['id' => $id]);

        if ($data_bd == null || $data_bd == false) {
            $this->setMsg(base64_encode(Constants::ERROR_ROW_NOT_FOUND));
            header('Location: DuenioC.php?msg=' . $this->getMsg());
            exit();
        }
        $result = $this->duenio->queryParam(Constants::DELETE_DUENIO, ['id' => $id]);        

        if ($result == false) {
            $this->setMsg(base64_encode(Constants::ERROR_DELETE));
            header('Location: DuenioC.php?msg=' . $this->getMsg());
            exit();
        }

        $result = $this->duenio->queryParam(Constants::DELETE_DUENIO_HISTORIAL_DUENIO, ['duenios_id' => $id]);

        if ($result == false) {
            $this->setMsg(base64_encode('No se ha eliminado correctamente el registro'));
            header('Location: DuenioC.php?msg=' . $this->getMsg());
            exit();
        }

        $this->setMsg(base64_encode(Constants::DELETE_ROW));
        header('Location: DuenioC.php?msg=' . $this->getMsg());
        exit();
    }

    private function undelete()
    {
        if (!isset($_REQUEST['id'])) {
            $this->setMsg(base64_encode(Constants::ERROR_UNDELETE));
            header('Location: DuenioC.php?msg=' . $this->getMsg());
            exit();
        }
        $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8');
        $data_bd = $this->duenio->queryParam(Constants::GET_DUENIO, ['id' => $id]);

        if ($data_bd == null || $data_bd == false) {
            $this->setMsg(base64_encode(Constants::ERROR_ROW_NOT_FOUND));
            header('Location: DuenioC.php?msg=' . $this->getMsg());
            exit();
        }
        $result = $this->duenio->queryParam(Constants::UPDT_UNDELETE_DUENIOS, ['id' => $id]);

        if ($result == false) {
            $this->setMsg(base64_encode(Constants::ERROR_UNDELETE));
            header('Location: DuenioC.php?msg=' . $this->getMsg()); // TO DO!!!
            exit();
        }

        $this->setMsg(base64_encode(Constants::UNDELETE_ROW));
        header('Location: DuenioC.php?msg=' . $this->getMsg()); // TO DO!!!
        exit();
    }

    private function pagination()
    {
        // Obtenemos los valores nuevos (si es que hay)
        $this->ord = $this->duenio->get_value("ord", $this->ord);
        $this->field = $this->duenio->get_value("field", $this->field);
        $this->amount = $this->duenio->get_value("amount", $this->amount);
        $this->page = $this->duenio->get_value("page", $this->page);
        $this->search_val = (isset($_POST['search_value']) && !empty($_POST['search_value']) && $_POST['search_value'] != '' && $_POST['search_value'] != null) ? ('%' . $this->duenio->get_value("search_value", $_POST['search_value']) . '%') : false;

        $data = ($this->search_val) ? ($this->duenio->queryParamSearch(Constants::SEARCH_DUENIOS_TABLE, $this->search_val, $this->ord, $this->field, $this->page, $this->amount)) : ($this->duenio->pagination_visible('duenios', $this->ord, $this->field, $this->page, $this->amount));
        $total_pages = ($this->search_val) ? ceil(count($this->duenio->queryParam(Constants::SEARCH_DUENIOS_TABLE_TOTAL_PAGES, ['search_value' => $this->search_val])) / $this->amount) : $this->duenio->total_pages_visibles("duenios", $this->amount);
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
            $html_var .= "<td>" . $show_data["fecha_ultima_visita"] . "</td>";
            $html_var .= "<td class='ps-4 pe-2'>";
            $html_var .= '<a href="../controllers/DuenioC.php?action=show_register&id=' . $show_data['id'] . '" class="btn btn-primary text-white btn-sm me-1">Ver</a>';
            $html_var .= '<a href="../controllers/DuenioC.php?action=sdelete&id=' . $show_data['id'] . '" class="btn btn-danger text-white btn-sm me-1">Borrar</a>';            
            $html_var .= "</td>";
            $html_var .= "</tr>";
        }

        echo json_encode(array("total_pages" => $total_pages, "rows" => $html_var, 'pagination' => $this->duenio->generatePaginationHTML($page, $this->amount, $total_pages)));
    }

    private function get_rows_availables()
    {
        echo json_encode($this->duenio->query(Constants::GET_DUENIO_SELECT));
    }

    private function show_delete_rows()
    {
        echo json_encode($this->duenio->query(Constants::GET_DUENIOS_INACTIVE));
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
