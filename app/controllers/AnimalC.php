<?php

use utils\Utils;
use \model\Animal;
use \model\Especie;
use \model\Jaula;
use \model\Img;
use utils\Constants;

// use \Exception;

require_once "../utils/Utils.php";
require_once "../utils/Constants.php";
require_once "../models/Animal.php";
require_once "../models/Img.php";
require_once "../models/Especie.php";
require_once "../models/Jaula.php";

class AnimalC
{


    // 
    // -- CONSTANTES
    // 
    const ERROR_INSERT = "No se ha podido introducir el nuevo registro a la base de datos. Revisa los datos introducidos";
    const ERROR_UPDATE = "No se ha podido modificar el registro.";
    const VIEW_ANIMAL = "V_Animales.php";
    const VIEW_UPDATE_EDIT = "../views/update_or_add_animal.php";


    // 
    // -- ATRIBUTOS
    // 
    private $animal;
    private $especie;
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
        $this->animal = new Animal();
        $this->especie = new Especie();
        $this->imgM = new Img('animales');
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


    /**
     * Dependiendo de la acción pasada, se realizará llamará a una función u otra
     * 
     * @param String $action Acción que se va a realizar 
     */
    public function run(String $action = "index")
    {
        switch ($action) {
                // Si es index
            case "index":
                // Llama a la función index
                $this->index();
                break;
            case 'show_register':
                // Llama a la función show_register
                $this->show_register();
                break;
            case "add":
                // Llama a la función add
                $this->add();
                break;
            case "record_imgs":
                $this->animal_imgs();
                break;
                // Si es update
            case "update":
                // Llama a la función update
                $this->update();
                break;
                // Si es sdelete
            case "sdelete":
                // Llama a la función soft_delete()
                $this->sdelete();
                break;
            case "undelete":
                $this->undelete();
                break;
                // Si es delete
            case "delete":
                // Llama a la funcion delete
                $this->delete();
                break;
            case "show_delete_rows":
                $this->show_delete_rows();
                break;
                // Por defecto, llamará a la función index
            case "show_cages":
                $this->show_cages_available();
                break;
            case 'search_animal_modal':
                $this->search_animal_modal();
                break;
            case 'getList_animal':
                $this->getList_animal();
                break;
            case "get_rows_availables":
                $this->get_rows_availables();
                break;
            case "pagination":
                $this->pagination();
                break;
            default:
                $this->index();
                break;
        }
    }

    public function index($view = "V_Animales.php")
    {
        $data = $this->animal->pagination_visible_with_more_info($this->ord, $this->field, $this->page, $this->amount);
        $total_pages = $this->animal->total_pages_visibles("animales", $this->amount);
        $data_especies = $this->especie->get_all("especies");
        $page = $this->getPage();
        $new_msg = $this->getMsg();

        require_once "../views/" . $view;
    }

    public function show_register($id = '')
    {
        if (isset($_REQUEST['id']) && !empty($_REQUEST['id']) || !empty($id)) {
            $id = isset($_REQUEST['id']) ? htmlspecialchars(trim($_REQUEST['id']), ENT_QUOTES, 'UTF-8') : htmlspecialchars(trim($id), ENT_QUOTES, 'UTF-8');
            $data = $this->animal->queryParam(Constants::GET_ANIMAL, ['id' => $id]);
            if ($data == null) {
                $data = $this->animal->queryParam(Constants::GET_ANIMAL2, ['id' => $id]);
            }
            $data = $data[0];
            // Obtenemos todas las especies     
            $data_especies = $this->especie->get_all("especies");

            require_once Constants::VIEW_ANIMAL;
        }
    }

    public function add()
    {
        // Comprobamos que los campos no estén vacíos
        if (
            isset($_POST["nombre"]) && isset($_POST["especies_id"]) && isset($_POST["raza"])
            && isset($_POST["genero"]) && isset($_POST["tamanio"]) && isset($_POST["peso"]) && isset($_POST["colores"])
            && isset($_POST["personalidad"]) && isset($_POST["fech_nac"]) && isset($_POST["estado_adopcion"])
            && isset($_POST["estado_salud"]) && isset($_POST["necesidades_especiales"]) && isset($_POST["otras_observaciones"])
            && isset($_POST["jaulas_id"])
        ) {
            // Creamos un nuevo array
            $new_animal = [];
            // Guardamos los valores del Post
            $new_animal["nombre"] = $_POST["nombre"];
            $new_animal["especies_id"] = $_POST["especies_id"];
            $new_animal["raza"] = $_POST["raza"];
            $new_animal["genero"] = $_POST["genero"];
            $new_animal["tamanio"] = $_POST["tamanio"];
            $new_animal["peso"] = $_POST["peso"];
            $new_animal["colores"] = implode(',', $_POST["colores"]);
            $new_animal["personalidad"] = implode(',', $_POST["personalidad"]);
            $new_animal["fech_nac"] = $_POST["fech_nac"];
            $new_animal["estado_adopcion"] = $_POST["estado_adopcion"];
            $new_animal["estado_salud"] = $_POST["estado_salud"];
            $new_animal["necesidades_especiales"] = $_POST["necesidades_especiales"];
            $new_animal["otras_observaciones"] = $_POST["otras_observaciones"];
            $new_animal["jaulas_id"] = $_POST["jaulas_id"];

            // Le pasamos el array como valor para el atributo privado del modelo Animal
            $this->animal->setAnimal($new_animal);

            // Insertamos el nuevo registro y guardamos el resultado
            $result = $this->animal->add();

            // Comprobamos si se desean insertar imágenes
            if (isset($_FILES['imgs'])) {
                // $this->animal->save_multiple_imgs($result, $_FILES['imgs'], Constants::INSERT_ANIMALES_PHOTOS);
                $data_imgs = $this->imgM->addImgs($result, $_FILES['imgs']);

                if (!$data_imgs) {
                    $this->setMsg(Constants::ADD_IMG_ERROR);
                    $this->index();
                }
            }

            // Si algo ha ido mal, guardamos mensaje y mostramos la página de Animales
            if ($result == false) {
                $this->setMsg(self::ERROR_INSERT);
            }
            header('Location: ./AnimalC.php?action=show_register&id=' . $result);
        }
    }

    public function animal_imgs()
    {
        if (isset($_REQUEST['action_img']) && isset($_REQUEST['id'])) {
            $action_img = $_REQUEST['action_img'];
            $id_animal = $_REQUEST['id'];
            switch ($action_img) {
                case "get":
                    echo json_encode($this->imgM->getImgs($id_animal));
                    break;
                case "get_one":
                    echo json_encode($this->imgM->getImg($id_animal)); // aunque ponga id_animal es el id de la foto
                    break;
                case 'add':
                    if (isset($_FILES['imgs'])) {
                        echo json_encode(['res' => $this->imgM->addImgs($id_animal, $_FILES['imgs'])]);
                    }
                    break;
                case "delete-img":
                    echo json_encode(['res' => $this->imgM->deleteImg($id_animal)]); // aunque la variable se llame id_animal, en realidad es el id de la foto
                    break;
                case "delete-imgs":
                    return $this->imgM->deleteImgs($id_animal);
                    break;
            }
        }
    }

    public function update()
    {
        // Comprobamos que los campos no estén vacíos
        if (
            isset($_REQUEST["nombre"]) && isset($_REQUEST["especies_id"]) && isset($_REQUEST["raza"])
            && isset($_REQUEST["genero"]) && isset($_REQUEST["tamanio"]) && isset($_REQUEST["peso"]) && isset($_REQUEST["colores"])
            && isset($_REQUEST["personalidad"]) && isset($_REQUEST["fech_nac"]) && isset($_REQUEST["estado_adopcion"])
            && isset($_REQUEST["estado_salud"]) && isset($_REQUEST["necesidades_especiales"]) && isset($_REQUEST["otras_observaciones"])
            && isset($_REQUEST["jaulas_id"])
        ) {
            // Creamos un nuevo array
            $new_animal = [];
            // Guardamos los valores del Post
            $new_animal["id"] = htmlspecialchars(trim($_REQUEST["id"]), ENT_QUOTES, 'UTF-8');
            $new_animal["nombre"] = htmlspecialchars(trim($_REQUEST["nombre"]), ENT_QUOTES, 'UTF-8');
            $new_animal["especies_id"] = htmlspecialchars(trim($_REQUEST["especies_id"]), ENT_QUOTES, 'UTF-8');
            $new_animal["raza"] = htmlspecialchars(trim($_REQUEST["raza"]), ENT_QUOTES, 'UTF-8');
            $new_animal["genero"] = htmlspecialchars(trim($_REQUEST["genero"]), ENT_QUOTES, 'UTF-8');
            $new_animal["tamanio"] = htmlspecialchars(trim($_REQUEST["tamanio"]), ENT_QUOTES, 'UTF-8');
            $new_animal["peso"] = htmlspecialchars(trim($_REQUEST["peso"]), ENT_QUOTES, 'UTF-8');
            $new_animal["colores"] = htmlspecialchars(trim(implode(',', $_REQUEST["colores"])), ENT_QUOTES, 'UTF-8');
            $new_animal["personalidad"] = htmlspecialchars(trim(implode(',', $_REQUEST["personalidad"])), ENT_QUOTES, 'UTF-8');
            $new_animal["fech_nac"] = htmlspecialchars(trim($_REQUEST["fech_nac"]), ENT_QUOTES, 'UTF-8');
            $new_animal["estado_adopcion"] = htmlspecialchars(trim($_REQUEST["estado_adopcion"]), ENT_QUOTES, 'UTF-8');
            $new_animal["estado_salud"] = htmlspecialchars(trim($_REQUEST["estado_salud"]), ENT_QUOTES, 'UTF-8');
            $new_animal["necesidades_especiales"] = htmlspecialchars(trim($_REQUEST["necesidades_especiales"]), ENT_QUOTES, 'UTF-8');
            $new_animal["otras_observaciones"] = htmlspecialchars(trim($_REQUEST["otras_observaciones"]), ENT_QUOTES, 'UTF-8');
            $new_animal["jaulas_id"] = htmlspecialchars(trim($_REQUEST["jaulas_id"]), ENT_QUOTES, 'UTF-8');

            // Le pasamos el array como valor para el atributo privado del modelo Animal
            $this->animal->setAnimal($new_animal);

            // Insertamos el nuevo registro y guardamos el resultado
            $result = $this->animal->update();

            // Si algo ha ido mal, guardamos mensaje y mostramos la página de Animales
            if ($result == null) {
                $this->setMsg(Constants::ERROR_UPDATE);
            }
            // $this->index();
            $this->show_register();
        }
    }

    public function sdelete()
    {
        // Comprobamos que el campo id no esté vacío
        if (
            isset($_REQUEST["id"])
        ) {

            // Guardamos el id pasado por POST
            $id = $_REQUEST["id"];

            // Hacemos soft delte llamando a la función soft_delete
            $resultado = $this->animal->soft_delete("animales", $id);

            // Si algo ha ido mal, guardamos mensaje y mostramos la página de Animales
            if ($resultado == null) {
                $this->setMsg(Constants::ERROR_DELETE);
            }
            $this->setMsg("Registro borrado con éxito.");
            $this->index();
        }
    }

    public function delete()
    {
        // Comprobamos que el campo id no esté vacío
        if (
            isset($_POST["id"])
        ) {
            // Guardamos el id pasado por POST
            $id = $_POST["id"];
            // Hacemos soft delte llamando a la función soft_delete
            $result = $this->animal->delete("animales", $id);

            // Si algo ha ido mal, guardamos mensaje y mostramos la página de Animales
            if ($result == null) {
                $this->msg = self::ERROR_INSERT;
            }
            $this->index();
        }
    }

    public function undelete()
    {
        // Comprobamos que el campo id no esté vacío
        if (
            isset($_REQUEST["id"])
        ) {

            // Guardamos el id pasado por REQUEST
            $params = ['id' => $_REQUEST["id"]];

            // Hacemos undelete llamando a la función queryParam, pasando la query que queremos
            $resultado = $this->animal->queryParam(Constants::UPDT_UNDELETE_ANIMALES, $params);

            // Si algo ha ido mal, guardamos mensaje y mostramos la página de Animales
            if ($resultado == null) {
                $this->setMsg(Constants::ERROR_UNDELETE);
            }
            $this->setMsg("Registro recuperado con éxito.");
            $this->index();
        }
    }

    public function show_cages_available()
    {
        // Comprobamos que el campo id no esté vacío
        if (
            isset($_POST["especies_id"])
        ) {
            // Si no lo está, guardamos el valor
            $especie = $_POST["especies_id"];

            // Llamamos a la función get_cages_available para obtener las jaulas disponibles
            // para la especie indicada
            $jaulas = $this->animal->get_cages_available($especie);
            // Devolvemos el null o las jaulas dependiendo del resultado obtenido de la función
            // anterior
            echo (($jaulas == null) ? null : json_encode($jaulas));
        }
    }

    public function search_animal_modal()
    {
        if (isset($_REQUEST['controller'])) {
            $controller = htmlspecialchars(trim($_REQUEST["controller"]), ENT_QUOTES, 'UTF-8');
            switch ($controller) {
                case 'DuenioC.php':
                    echo json_encode($this->animal->query(Constants::GET_ANIMAL_MODAL_DUENIO));
                    break;
                case 'AdoptanteC.php':
                    echo json_encode($this->animal->query(Constants::GET_ANIMAL_MODAL_ADOPTANTE));
                    break;
            }
        }
    }

    public function getList_animal()
    {
        if (isset($_REQUEST['controller'])) {
            $controller = htmlspecialchars(trim($_REQUEST["controller"]), ENT_QUOTES, 'UTF-8');
            switch ($controller) {
                case 'DuenioC.php':
                    if (isset($_REQUEST['register_id']) && isset($_REQUEST['id'])) {
                        $id = htmlspecialchars(trim($_REQUEST["id"]), ENT_QUOTES, 'UTF-8');
                        $duenio_id = htmlspecialchars(trim($_REQUEST["register_id"]), ENT_QUOTES, 'UTF-8');
                        $res = $this->animal->update_owner(['id' => $id, 'duenios_id' => $duenio_id]);
                        if ($res) {
                            echo json_encode($this->animal->queryParam(Constants::GET_ANIMAL_LIST_DUENIO, ['id' => $duenio_id]));
                        }
                    } else if (isset($_REQUEST['register_id'])) {
                        $duenio_id = htmlspecialchars(trim($_REQUEST["register_id"]), ENT_QUOTES, 'UTF-8');
                        echo json_encode($this->animal->queryParam(Constants::GET_ANIMAL_LIST_DUENIO, ['id' => $duenio_id]));
                    }
                    break;
                case 'AdoptanteC.php':
                    if (isset($_REQUEST['register_id']) && isset($_REQUEST['id'])) {
                        $id = htmlspecialchars(trim($_REQUEST["id"]), ENT_QUOTES, 'UTF-8');
                        $adoptante_id = htmlspecialchars(trim($_REQUEST["register_id"]), ENT_QUOTES, 'UTF-8');
                        $res = $this->animal->update_adopter(['id' => $id, 'adoptante_id' => $adoptante_id]);
                        if ($res) {
                            echo json_encode($this->animal->queryParam(Constants::GET_ANIMAL_LIST_ADOPTANTE, ['adoptante_id' => $adoptante_id]));
                        }
                    } else if (isset($_REQUEST['register_id'])) {
                        $adoptante_id = htmlspecialchars(trim($_REQUEST["register_id"]), ENT_QUOTES, 'UTF-8');
                        echo json_encode($this->animal->queryParam(Constants::GET_ANIMAL_LIST_ADOPTANTE, ['adoptante_id' => $adoptante_id]));
                    }
                    break;
                case 'JaulaC.php':
                    if (isset($_REQUEST['register_id'])) {
                        $jaulas_id = htmlspecialchars(trim($_REQUEST["register_id"]), ENT_QUOTES, 'UTF-8');
                        echo json_encode($this->animal->queryParam(Constants::GET_ANIMAL_LIST_JAULA, ['jaulas_id' => $jaulas_id]));
                    }
                    break;
            }
        }
    }

    public function filter_data()
    {
        if (isset($_POST["field"]) && isset($_POST["value_field"])) {
            // Guardamos los valores
            $field = $_POST["field"];
            $value_field = $_POST["value_field"];

            // Llamamos a la función y guardamos el resultado obtenido
            $data_visible = $this->animal->filter_table($field, $value_field);

            if ($data_visible == null) {
                $this->msg = self::ERROR_INSERT;
            }
            include "../views/components/animalList.php";
            // Devolver los registros en formato JSON
            // header('Content-Type: application/json');
            // echo json_encode($result);
        } else {
            $this->index("/components/animalList.php");
        }
    }


    private function get_rows_availables()
    {
        echo json_encode($this->animal->query(Constants::GET_ANIMAL_SELECT));
    }

    public function pagination()
    {
        // Obtenemos los valores nuevos (si es que hay)
        $this->ord = $this->get_value("ord", $this->ord);
        $this->field = $this->get_value("field", $this->field);
        $this->amount = $this->get_value("amount", $this->amount);
        $this->page = $this->get_value("page", $this->page);
        $this->search_val = (isset($_POST['search_value']) && !empty($_POST['search_value']) && $_POST['search_value'] != '' && $_POST['search_value'] != null) ? ('%' . $this->get_value("search_value", $_POST['search_value']) . '%') : false;

        $data = ($this->search_val) ? ($this->animal->queryParamSearch(Constants::SEARCH_ANIMALES_TABLE, $this->search_val, $this->ord, $this->field, $this->page, $this->amount)) : ($this->animal->pagination_visible_with_more_info($this->ord, $this->field, $this->page, $this->amount));
        $total_pages = ($this->search_val) ? ceil(count($this->animal->queryParam(Constants::SEARCH_ANIMALES_TABLE_TOTAL_PAGES, ['search_value' => $this->search_val])) / $this->amount) : $this->animal->total_pages_visibles("animales", $this->amount);
        $total_pages = ($total_pages == 0) ? 1 : $total_pages;
        // Obtenemos todas las especies     
        $data_especies = $this->especie->get_all("especies");

        // La página actual
        $page = $this->getPage();

        $html_var = '';

        // Recorremos el array data y concatenamos el HTML generado dinámicamente
        foreach ($data as $show_data) {
            $url = "AnimalC.php"; //URL destino

            // Concatenamos el HTML generado dinámicamente
            $html_var .= "<tr>";
            $html_var .= "<td class='sticky-column' id='showRegister' value='" . $show_data["id"] . "'> <a href='?id=" . $show_data["id"] . "&action=show_register'>" . $show_data["nombre"] . "</a> </td>";
            $html_var .= "<td>" . $show_data["nombre_especie"] . "</td>";
            $html_var .= "<td>" . $show_data["raza"] . "</td>";
            $html_var .= "<td>" . $show_data["fech_nac"] . "</td>";
            $html_var .= "<td>" . $show_data["estado_adopcion"] . "</td>";
            $html_var .= "<td>" . $show_data["ubicacion"] . "</td>";
            $html_var .= "<td class='ps-4 pe-2'>";
            $html_var .= '<a href="../controllers/AnimalC.php?action=show_register&id=' . $show_data['id'] . '" class="btn btn-primary text-white btn-sm me-1">Ver</a>';
            $html_var .= '<a href="../controllers/AnimalC.php?action=sdelete&id=' . $show_data['id'] . '" class="btn btn-danger text-white btn-sm me-1">Borrar</a>';
            $html_var .= "</td>";
            $html_var .= "</tr>";
        }
        echo json_encode(array("total_pages" => $total_pages, "rows" => $html_var, 'pagination' => $this->animal->generatePaginationHTML($page, $this->amount, $total_pages)));
    }

    // Obtiene el valor de post y si no existe, te devuelve el original
    public function get_value(String $val, String $originalVal)
    {
        if (isset($_POST[$val])) {
            $this->$val = $_POST[$val];
            return $_POST[$val];
        } else {
            return $originalVal;
        }
    }


    private function show_delete_rows()
    {
        echo json_encode($this->animal->query(Constants::GET_ANIMALES_INACTIVE));
    }

    // Te lleva a la vista
    public function view(array $datos_visibles, array $datos, String $view)
    {

        $data_visible = $datos_visibles;
        $data = $datos["animales"];
        $data_especies = $datos["especies"];
        $total_pages = $datos["total_pages"];
        $page = $this->page;

        $new_msg = $this->getMsg();

        require_once "../views/" . $view;
    }
}

//Comprobamos que la sesion esta iniciada
session_start();
//Si no tenemos guardado login 
if (!Utils::is_logged_in()) {
    header("Location:../../public/Login.php");
    die;
}
$animal = new AnimalC();

$action = !empty($_REQUEST["action"]) ? $_REQUEST["action"] : "index";
if (!empty($_POST["field"])) {
    $animal->setField($_POST["field"]);
}
if (!empty($_POST["ord"])) {
    $animal->setOrd($_POST["ord"]);
}
if (!empty($_POST["page"])) {
    $animal->setPage($_POST["page"]);
}
if (!empty($_POST["amount"])) {
    $animal->setAmount($_POST["amount"]);
}
// var_dump($_REQUEST);
$animal->run($action);
