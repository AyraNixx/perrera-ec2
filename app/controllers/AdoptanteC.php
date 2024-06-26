<?php

use utils\Utils;
use \model\Adoptante;
use \model\Animal;
use utils\Constants;

// use \Exception;

require_once "../utils/Utils.php";
require_once "../utils/Constants.php";
require_once "../models/Adoptante.php";
require_once "../models/Animal.php";

class AdoptanteC
{
    // 
    // -- ATRIBUTOS
    // 
    private $adoptante;
    private $animal;
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
        $this->adoptante = new Adoptante();
        $this->animal = new Animal();
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
            case "delete_animal_from_list":
                $this->delete_animal_from_list();
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

    private function index($view = 'V_Adoptantes.php')
    {
        if (!isset($_REQUEST['id'])) {
            $data = $this->adoptante->pagination_visible('adoptante', $this->ord, $this->field, $this->page, $this->amount);
            $total_pages = $this->adoptante->total_pages_visibles('adoptante', $this->amount);
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
            $data = $this->adoptante->queryParam(Constants::GET_ADOPTANTE, ['id' => $id])[0];
            $new_msg = $this->getMsg();
            require_once Constants::VIEW_ADOPTANTE;
        }
    }

    private function add()
    {
        var_dump($_REQUEST);
        if (
            !isset($_REQUEST['nombre']) && !isset($_REQUEST['apellidos']) && !isset($_REQUEST['fech_nac'])
            && !isset($_REQUEST['NIF']) && !isset($_REQUEST['correo']) && !isset($_REQUEST['telf'])
            && !isset($_REQUEST['direccion']) && !isset($_REQUEST['ciudad']) && !isset($_REQUEST['codigo_postal'])
            && !isset($_REQUEST['pais']) && !isset($_REQUEST['ocupacion']) && !isset($_REQUEST['tipo_vivienda'])
            && !isset($_REQUEST['tiene_jardin']) && !isset($_REQUEST['preferencia_adopcion'])
            && !isset($_REQUEST['otra_mascota']) && !isset($_REQUEST['tipo_otra_mascota'])
            && !isset($_REQUEST['estado_solicitud']) && !isset($_REQUEST['fecha_solicitud'])
            && !isset($_REQUEST['comentarios']) && !isset($_REQUEST['animales_id'])
        ) {
            header('Location: AdoptanteC.php?msg=' . Constants::ERROR_INSERT);
            exit();
        }

        $NIF = htmlspecialchars(trim($_REQUEST['NIF']), ENT_QUOTES, 'UTF-8');
        $data = $this->adoptante->queryParam(Constants::FIND_NIF_ADOPTANTE, ['NIF' => $NIF]);

        if ($data != false && $data != null) {
            header('Location: AdoptanteC.php?msg=' . Constants::ERROR_NIF);
            exit();
        }

        $nombre = htmlspecialchars(trim($_REQUEST['nombre']), ENT_QUOTES, 'UTF-8');
        $apellidos = htmlspecialchars(trim($_REQUEST['apellidos']), ENT_QUOTES, 'UTF-8');
        $fech_nac = htmlspecialchars(trim($_REQUEST['fech_nac']), ENT_QUOTES, 'UTF-8');
        $correo = htmlspecialchars(trim($_REQUEST['correo']), ENT_QUOTES, 'UTF-8');
        $telf = htmlspecialchars(trim($_REQUEST['telf']), ENT_QUOTES, 'UTF-8');
        $direccion = htmlspecialchars(trim($_REQUEST['direccion']), ENT_QUOTES, 'UTF-8');
        $ciudad = htmlspecialchars(trim($_REQUEST['ciudad']), ENT_QUOTES, 'UTF-8');
        $codigo_postal = htmlspecialchars(trim($_REQUEST['codigo_postal']), ENT_QUOTES, 'UTF-8');
        $pais = htmlspecialchars(trim($_REQUEST['pais']), ENT_QUOTES, 'UTF-8');
        $ocupacion = htmlspecialchars(trim($_REQUEST['ocupacion']), ENT_QUOTES, 'UTF-8');
        $tipo_vivienda = htmlspecialchars(trim($_REQUEST['tipo_vivienda']), ENT_QUOTES, 'UTF-8');
        $tiene_jardin = htmlspecialchars(trim($_REQUEST['tiene_jardin']), ENT_QUOTES, 'UTF-8');
        $preferencia_adopcion = htmlspecialchars(trim($_REQUEST['preferencia_adopcion']), ENT_QUOTES, 'UTF-8');
        $otra_mascota = htmlspecialchars(trim($_REQUEST['otra_mascota']), ENT_QUOTES, 'UTF-8');
        $tipo_otra_mascota = htmlspecialchars(trim($_REQUEST['tipo_otra_mascota']), ENT_QUOTES, 'UTF-8');
        $estado_solicitud = htmlspecialchars(trim($_REQUEST['estado_solicitud']), ENT_QUOTES, 'UTF-8');
        $fecha_solicitud = htmlspecialchars(trim($_REQUEST['fecha_solicitud']), ENT_QUOTES, 'UTF-8');
        $comentarios = htmlspecialchars(trim($_REQUEST['comentarios']), ENT_QUOTES, 'UTF-8');
        $animales_id = htmlspecialchars(trim($_REQUEST['animales_id']), ENT_QUOTES, 'UTF-8');


        $result = $this->adoptante->insert([
            'nombre' => $nombre, 'apellidos' => $apellidos, 'fech_nac' => $fech_nac, 'NIF' => $NIF, 'correo' => $correo, 'telf' => $telf, 'direccion' => $direccion, 'ciudad' => $ciudad, 'codigo_postal' => $codigo_postal,
            'pais' => $pais, 'ocupacion' => $ocupacion, 'tipo_vivienda' => $tipo_vivienda, 'tiene_jardin' => $tiene_jardin, 'preferencia_adopcion' => $preferencia_adopcion, 'otra_mascota' => $otra_mascota,
            'tipo_otra_mascota' => $tipo_otra_mascota, 'estado_solicitud' => $estado_solicitud, 'fecha_solicitud' => $fecha_solicitud, 'comentarios' => $comentarios, 'animales_id' => $animales_id
        ]);

        if ($result == false) {
            $this->setMsg(Constants::ERROR_INSERT);
            header('Location: AdoptanteC.php?msg=' . Constants::ERROR_INSERT);
            exit();
        }

        $result_animals = $this->animal->update_adopter(['adoptante_id' => $result, 'id' => $animales_id, 'estado_adopcion' => $this->get_estado_adopcion($estado_solicitud)]);

        if (!$result_animals) {
            $this->setMsg('No se ha podido establecer relación entre el adoptante y los animales.');
            header('Location: AdoptanteC.php?msg=' . 'No se ha podido establecer relación entre el adoptante y los animales.');
            exit();
        }
        header('Location: AdoptanteC.php?id=' . $result);
        exit();
    }

    private function update()
    {
        if (
            !isset($_REQUEST['id']) && !isset($_REQUEST['nombre']) && !isset($_REQUEST['apellidos'])
            && !isset($_REQUEST['fech_nac']) && !isset($_REQUEST['NIF']) && !isset($_REQUEST['correo'])
            && !isset($_REQUEST['telf']) && !isset($_REQUEST['direccion']) && !isset($_REQUEST['ciudad'])
            && !isset($_REQUEST['codigo_postal']) && !isset($_REQUEST['pais']) && !isset($_REQUEST['ocupacion'])
            && !isset($_REQUEST['tipo_vivienda']) && !isset($_REQUEST['tipo_otra_mascota'])
            && !isset($_REQUEST['estado_solicitud']) && !isset($_REQUEST['fecha_solicitud']) && !isset($_REQUEST['comentarios'])
        ) {
            header('Location: AdoptanteC.php?msg=' . Constants::ERROR_UPDATE);
            exit();
        }

        $NIF = htmlspecialchars(trim($_REQUEST['NIF']), ENT_QUOTES, 'UTF-8');
        $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8');

        $exist_nif = $this->adoptante->queryParam(Constants::FIND_NIF_ADOPTANTE_UPD, ['NIF' => $NIF, 'id' => $id])[0]['resultado'];

        if ($exist_nif) {
            header('Location: AdoptanteC.php?msg=' . Constants::ERROR_NIF);
            exit();
        }

        $nombre = htmlspecialchars(trim($_REQUEST['nombre']), ENT_QUOTES, 'UTF-8');
        $apellidos = htmlspecialchars(trim($_REQUEST['apellidos']), ENT_QUOTES, 'UTF-8');
        $fech_nac = htmlspecialchars(trim($_REQUEST['fech_nac']), ENT_QUOTES, 'UTF-8');
        $correo = htmlspecialchars(trim($_REQUEST['correo']), ENT_QUOTES, 'UTF-8');
        $telf = htmlspecialchars(trim($_REQUEST['telf']), ENT_QUOTES, 'UTF-8');
        $direccion = htmlspecialchars(trim($_REQUEST['direccion']), ENT_QUOTES, 'UTF-8');
        $ciudad = htmlspecialchars(trim($_REQUEST['ciudad']), ENT_QUOTES, 'UTF-8');
        $codigo_postal = htmlspecialchars(trim($_REQUEST['codigo_postal']), ENT_QUOTES, 'UTF-8');
        $pais = htmlspecialchars(trim($_REQUEST['pais']), ENT_QUOTES, 'UTF-8');
        $ocupacion = htmlspecialchars(trim($_REQUEST['ocupacion']), ENT_QUOTES, 'UTF-8');
        $tipo_vivienda = htmlspecialchars(trim($_REQUEST['tipo_vivienda']), ENT_QUOTES, 'UTF-8');
        $tiene_jardin = (isset($_REQUEST['tiene_jardin'])) ? htmlspecialchars(trim($_REQUEST['tiene_jardin']), ENT_QUOTES, 'UTF-8') : 0;
        $preferencia_adopcion = (isset($_REQUEST['preferencia_adopcion'])) ? htmlspecialchars(trim($_REQUEST['preferencia_adopcion']), ENT_QUOTES, 'UTF-8') : 0;
        $otra_mascota = (isset($_REQUEST['otra_mascota'])) ? htmlspecialchars(trim($_REQUEST['otra_mascota']), ENT_QUOTES, 'UTF-8') : 0;
        $tipo_otra_mascota = htmlspecialchars(trim($_REQUEST['tipo_otra_mascota']), ENT_QUOTES, 'UTF-8');
        $estado_solicitud = htmlspecialchars(trim($_REQUEST['estado_solicitud']), ENT_QUOTES, 'UTF-8');
        $fecha_solicitud = htmlspecialchars(trim($_REQUEST['fecha_solicitud']), ENT_QUOTES, 'UTF-8');
        $comentarios = htmlspecialchars(trim($_REQUEST['comentarios']), ENT_QUOTES, 'UTF-8');

        $result = $this->adoptante->queryParam(Constants::UPDT_ADOPTANTE, [
            'id' => $id, 'nombre' => $nombre, 'apellidos' => $apellidos, 'fech_nac' => $fech_nac, 'NIF' => $NIF, 'correo' => $correo, 'telf' => $telf, 'direccion' => $direccion, 'ciudad' => $ciudad,
            'codigo_postal' => $codigo_postal, 'pais' => $pais, 'ocupacion' => $ocupacion, 'tipo_vivienda' => $tipo_vivienda, 'tiene_jardin' => $tiene_jardin, 'preferencia_adopcion' => $preferencia_adopcion,
            'otra_mascota' => $otra_mascota, 'tipo_otra_mascota' => $tipo_otra_mascota, 'estado_solicitud' => $estado_solicitud, 'fecha_solicitud' => $fecha_solicitud, 'comentarios' => $comentarios
        ]);

        if ($result == false) {
            $this->setMsg(Constants::ERROR_UPDATE);
            header('Location: AdoptanteC.php?msg=' . Constants::ERROR_UPDATE . '&id=' . $id);
            exit();
        }
        header('Location: AdoptanteC.php?id=' . $id);
        exit();
    }

    private function sdelete()
    {
        if (!isset($_REQUEST['id'])) {
            $this->setMsg(base64_encode(Constants::ERROR_DELETE));
            header('Location: AdoptanteC.php?msg=' . $this->getMsg());
            exit();
        }
        $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8');
        $data_bd = $this->adoptante->queryParam(Constants::GET_ADOPTANTE, ['id' => $id]);

        if ($data_bd == null || $data_bd == false) {
            $this->setMsg(base64_encode(Constants::ERROR_ROW_NOT_FOUND));
            header('Location: AdoptanteC.php?msg=' . $this->getMsg());
            exit();
        }
        // Buscamos en la bd de animales para actualizar todos aquellos registros que tengan este id como adoptantes_id
        $result = $this->adoptante->queryParam(Constants::DELETE_ADOPTANTE_ANIMALS, ['id' => $id]);

        $result = $this->adoptante->queryParam(Constants::DELETE_ADOPTANTE, ['id' => $id]);

        if ($result == false) {
            $this->setMsg(base64_encode(Constants::ERROR_DELETE));
            header('Location: AdoptanteC.php?msg=' . $this->getMsg());
            exit();
        }

        $this->setMsg(base64_encode(Constants::DELETE_ROW));
        header('Location: AdoptanteC.php?msg=' . $this->getMsg());
        exit();
    }

    private function undelete()
    {
        if (!isset($_REQUEST['id'])) {
            $this->setMsg(base64_encode(Constants::ERROR_UNDELETE));
            header('Location: AdoptanteC.php?msg=' . $this->getMsg());
            exit();
        }
        $id = htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8');
        $data_bd = $this->adoptante->queryParam(Constants::GET_ADOPTANTE, ['id' => $id]);

        if ($data_bd == null || $data_bd == false) {
            $this->setMsg(base64_encode(Constants::ERROR_ROW_NOT_FOUND));
            header('Location: AdoptanteC.php?msg=' . $this->getMsg());
            exit();
        }
        $result = $this->adoptante->queryParam(Constants::UPDT_UNDELETE_ADOPTANTES, ['id' => $id]);

        if ($result == false) {
            $this->setMsg(base64_encode(Constants::ERROR_UNDELETE));
            header('Location: AdoptanteC.php?msg=' . $this->getMsg());
            exit();
        }

        $this->setMsg(base64_encode(Constants::UNDELETE_ROW));
        header('Location: AdoptanteC.php?msg=' . $this->getMsg());
        exit();
    }

    private function delete_animal_from_list()
    {
        if (isset($_REQUEST['animal_id'])) {
            $id = htmlspecialchars(trim($_REQUEST['animal_id']), ENT_QUOTES, 'UTF-8');
            echo json_encode($this->adoptante->queryParam(Constants::DELETE_ANIMAL_ADOPTANTE, ['id' => $id, 'estado_adopcion' => 'Disponible para adopcion']));
        }
    }
    private function get_rows_availables()
    {
        echo json_encode($this->adoptante->query(Constants::GET_ADOPTANTE_SELECT));
    }

    private function pagination()
    {
        // Obtenemos los valores nuevos (si es que hay)
        $this->ord = $this->adoptante->get_value("ord", $this->ord);
        $this->field = $this->adoptante->get_value("field", $this->field);
        $this->amount = $this->adoptante->get_value("amount", $this->amount);
        $this->page = $this->adoptante->get_value("page", $this->page);
        $this->search_val = (isset($_POST['search_value']) && !empty($_POST['search_value']) && $_POST['search_value'] != '' && $_POST['search_value'] != null) ? ('%' . $this->adoptante->get_value("search_value", $_POST['search_value']) . '%') : false;

        $data = ($this->search_val) ? ($this->adoptante->queryParamSearch(Constants::SEARCH_ADOPTANTES_TABLE, $this->search_val, $this->ord, $this->field, $this->page, $this->amount)) : ($this->adoptante->pagination_visible('adoptante', $this->ord, $this->field, $this->page, $this->amount));
        $total_pages = ($this->search_val) ? ceil(count($this->adoptante->queryParam(Constants::SEARCH_ADOPTANTES_TABLE_TOTAL_PAGES, ['search_value' => $this->search_val])) / $this->amount) : $this->adoptante->total_pages_visibles("adoptante", $this->amount);
        $total_pages = ($total_pages == 0) ? 1 : $total_pages;

        // La página actual
        $page = $this->getPage();
        $html_var = '';

        // Recorremos el array data y concatenamos el HTML generado dinámicamente
        foreach ($data as $show_data) {
            $url = "AdoptanteC.php"; //URL destino

            $html_var .= "<tr>";
            $html_var .= "<td class='sticky-column' id='showRegister' value='" . $show_data["id"] . "'> <a href='?id=" . $show_data["id"] . "&action=show_register'>" . $show_data["nombre"] . "</a> </td>";
            $html_var .= "<td>" . $show_data["apellidos"] . "</td>";
            $html_var .= "<td>" . $show_data["NIF"] . "</td>";
            $html_var .= "<td>" . $show_data["correo"] . "</td>";
            $html_var .= "<td>" . $show_data["estado_solicitud"] . "</td>";
            $html_var .= "<td class='ps-4 pe-2'>";
            $html_var .= '<a href="../controllers/AdoptanteC.php?action=show_register&id=' . $show_data['id'] . '" class="btn btn-primary text-white btn-sm me-1">Ver</a>';
            $html_var .= '<a href="../controllers/AdoptanteC.php?action=sdelete&id=' . $show_data['id'] . '" class="btn btn-danger text-white btn-sm me-1">Borrar</a>';
            $html_var .= "</td>";
            $html_var .= "</tr>";
        }

        echo json_encode(array("total_pages" => $total_pages, "rows" => $html_var, 'pagination' => $this->adoptante->generatePaginationHTML($page, $this->amount, $total_pages)));
    }

    private function show_delete_rows()
    {
        echo json_encode($this->adoptante->query(Constants::GET_ADOPTANTES_INACTIVE));
    }

    private function get_estado_adopcion(String $estado_solicitud)
    {
        switch ($estado_solicitud) {
            case 'En proceso':
                return 'Iniciado proceso de adopción';
                break;
            case 'En revisión':
                return 'En proceso de adopcion';
                break;
            case 'Aprobado':
                return 'Aprobado para adopcion';
                break;
            case 'Rechazado':
                return 'Cancelado';
                break;
            case 'Finalizado':
                return 'Adoptado';
                break;
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
$especie = new AdoptanteC();
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
