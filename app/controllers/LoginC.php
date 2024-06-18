<?php

// Damos un apodo al directorio
namespace controller;

use \utils\Utils;
// use \utils\Route;
use \model\Empleado;
use \Exception;

require_once "../utils/Utils.php";
// require_once "../utils/Routes.php";
require_once "../models/Empleado.php";
/*






COSAS A TENER EN CUENTA PARA CUANDO CREE EL CONTROLADOR DE REGISTRO:

    - FUNCION PASSWORD_HASH($password) --> Genera una salt aleatoria para la contraseña
    - FUNCION password_get_info($hash) --> Nos permite conocer más detalles, entre ellos podemos sacar la salt generada
    - FUNCION password_verify(password, hash_password) --> Verifica si la contraseña coincide con el hash_contraseña, no 
      hace falta pasar el salt porque se guarda la información.







*/
// Creamos una clase Controller general
class LoginC
{
    //"../controllers/C_Home.php"
    // 
    // -- CONSTANTES
    // 
    // const VIEW_LOGIN = '../../../public/Login.php';
    // const VIEW_INDEX = '../views/V_Home-Page.php'; // TEMPORAL! Por alguna razón DIR me da fallos con el header
    // const VIEW_NOT_FOUND = __DIR__ . '/../views/NotFound.php'; // TEMPORAL!
    // const VIEW_NOT_ACTIVATE = __DIR__ . '/../views/Activate.php'; // TEMPORAL!

    const VIEW_LOGIN = '../../public/Login.php';
    const VIEW_INDEX = '../views/V_Home-Page.php'; // TEMPORAL! Por alguna razón DIR me da fallos con el header
    // const VIEW_NOT_FOUND = __DIR__ . '/../views/NotFound.php'; // TEMPORAL!
    // const VIEW_NOT_ACTIVATE = __DIR__ . '/../views/Activate.php'; // TEMPORAL!

    const USER_NOT_FOUND = "El usuario o contraseña es erróneo";
    const USER_NOT_ACTIVATE = "Cuenta no activada, por favor, cambie su contraseña"; // TEMPORAL



    // 
    // -- ATRIBUTOS
    // 
    private $empleado;
    // private $routes;



    // 
    // -- CONSTRUCTOR
    // 
    function __construct()
    {
        $this->empleado = new Empleado();
    }

    // public function index()
    // {
    //     include "/Login";
    // }

    /**
     * Inicia la sesión si el usuario se encuentra en la base de datos.
     * 
     * @param array $data_login Array con los datos introducidos en la vista Login
     * 
     */
    public function login(array $data_login)
    {
        try {
            // Guardamos el resultado obtenido al llamar a la función user_found(),
            // que devuelve un array con los datos del usuario si lo ha encontrado
            // o null si no.
            $data_user = $this->empleado->user_found($data_login["correo"]);
            
            // Si nos ha devuelto null
            if ($data_user === null || $data_user === false) {
                // Guardamos el mensaje a mostrar
                $msg = base64_encode(self::USER_NOT_FOUND);

                // Mostramos la página de login
                header("Location:" . self::VIEW_LOGIN . "?msg=$msg");
                exit();
            }

            // Comprobamos si la contraseña pasada, coincide con la contraseña en nuestra
            // base de datos. Si no coinciden, guardamos el mensaje y mostramos la página de NotFound
            $passwd_login = password_verify($data_login["passwd"], $data_user["passwd"]);

            if (!$passwd_login == true) {
                // Guardamos el mensaje a mostrar
                $msg = base64_encode(self::USER_NOT_FOUND);

                // Mostramos la página de login
                header("Location:" . self::VIEW_LOGIN . "?msg=$msg");
                exit();
            }

            // Comprobamos si se trata de una cuenta activa, si es una cuenta activa, habrá cambiado
            // la contraseña de default 
            if ($data_user["code"] != "" || $data_user["code"] != null) { 
                $msg = self::USER_NOT_ACTIVATE;
                // Mostramos la página de login
                require_once(self::VIEW_NOT_ACTIVATE);
                return;
            }

            
            $rol = $this->empleado->get_rol($data_user["roles_id"]);
            // $rol = $rol["rol"];
            // $rol = 'prueba';

            // var_dump($data_user);

            // Iniciamos sesión
            session_start();
            // Guardamos las siguientes variables en la session
            $_SESSION["login"] = true;
            $_SESSION["id"] = $data_user['id'];
            $_SESSION["nombre"] = $data_user["nombre"];
            $_SESSION["apellidos"] = $data_user["apellidos"];
            $_SESSION["correo"] = $data_user["correo"];
            $_SESSION["rol"] = $rol;            

            // Si la casilla de recuerdame está marcada, generamos una cookie
            if(isset($data_login['remember_me']))
            {
                $time = time() + (60*60*4); // Durará 4 h
                $token_key = hash('sha256', $time . $data_user['nombre']);
                $token_value = hash('sha256', 'remember_me:' . $time . 'yusdf&&b1yuisg/cw!·$5!euiahcqwe');
                setcookie('remem', $token_key .':'.$token_value, $time, '/', null, false);

                $this->empleado->query("UPDATE perrera.empleados SET token_key = '$token_key', token_value = '$token_value' WHERE id = " . $data_user['id'] . " LIMIT 1");

            }


            // COSAS QUE DICE LA PERSONA DEL VIDEO
            // SESION -> IDENTIFICA EL NAVEGADOR A TRAVÉS DE UNA COOKIE QUE CREA
            // SESSION HAVE A LIFESPAN, TERMINAN DESPUÉS DE UN TIEMPO POR LO QUE SI QUIERES CREAR ALGO QUE RECUERDE AL USUARIO DURANTE MÁS TIEMPO, HABRÁ QUE CREAR UNA COOKIE
            // LA COOKIE ES VISIBLE AL USUARIO ASI QUE NO SE RECOMIENDA GUARDAR INFORMACION EN ELLAS
            // PARA ESTABLECER UNA COOKIE NO PODEMOS HACER $_SESSION['MACARRONES'] = TRUE
            // TENEMOS QUE UTILIZAR LA FUNCIÓN SETCOOKIE(NAME) Y PARA LEERLA SERÍA ALGO COMO ECHO $_COOKIE[NAME]
            // $_SESSION["remember"] = true; // INDEX PAGE LUEGO LO MAS POSIBLE ES QUE TENGA QUE CAMBIARLO POR EL MOMENTO LO DEJO AQUÍ
            
            // Dependiendo del rol asignado  
            // POR AHORA VOY A MANDARLOS TODOS AL MISMO INDEX

            header("Location: AsignarTareasC.php?action=index_home");
            exit();
        } catch (Exception $e) {
            Utils::save_log_error("Unexpected error caught: " . $e->getMessage());
        }
    }

    /**
     * Cierra la sesión
     */
    public function logout()
    {
        // Para terminar una sesión, necesitamos eliminar las variables
        // de sesión y, luego, eliminar la sesión

        // Podemos eliminar las variables de la sesion con 
        // session_unset()
        session_unset();
        // Ahora, destruimos la sesion
        session_destroy();
        // Borramos la cookie de sesión 
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        echo 'hi';
        // Redireccionamos a la vista de Login
        header("Location:" . self::VIEW_LOGIN);
        die;
        exit();
    }
}


// Comprobamos que la clave action se encuentra dentro del array de $_REQUEST
$action = (isset($_REQUEST["action"])) ? $_REQUEST["action"] : "";



// Intanciamos un nuevo objeto de la clase Login()
$login = new LoginC();
// Definimos un nuevo array
$data_login = [];


// Dependiendo del valor de $action, realizamos una cosa u otra
switch ($action) {
    case "login":
        // Comprobamos que estén las claves correo y passwd en el array $_REQUEST
        if (!isset($_REQUEST["correo"]) || !isset($_REQUEST["passwd"])) {
            // Incluimos la vista login
            // header("Location:../../../public/Login.php");            
            header("Location:../../public/Login.php");
            break;
        }

        // Llamamos a la función login y le pasamos como parámetro los valores 
        // limpiados y validados        
        $data_login["correo"] = addslashes($_REQUEST["correo"]);
        $data_login["passwd"] = addslashes($_REQUEST["passwd"]);
        $data_login["remember_me"] = isset($_REQUEST['remember_me']) ? addslashes($_REQUEST['remember_me']) : null;

        // $data_login = Utils::clean_array($data_login);       MÁS ADELANTE

        $login->login($data_login);

        break;

    
        // Si $action tiene como valor "logout"
    case "logout":
        // Llamamos a la función logout para finalizar la sesión
        $login->logout();
        break;



    default:
        // Incluimos la vista de Login
        // header("Location:../../public/Login.php");
        // exit();
        // break;
}

var_dump(password_hash('paula123', PASSWORD_DEFAULT));
