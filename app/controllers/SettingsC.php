<?php

// Damos un apodo al directorio
namespace controller;

use \utils\Utils;
use \utils\Constants;
// use \utils\Route;
use \model\Empleado;
use \Exception;

require_once "../utils/Utils.php";
require_once "../utils/Constants.php";
require_once "../models/Empleado.php";

class Settings
{
    private $empleado;
    private $data;

    private $msg;
    private $alert;

    function __construct()
    {
        $this->empleado = new Empleado();
        $this->data = $this->empleado->user_found($_SESSION["correo"]);
        
    }

    public function getMsg(){
        return $this->msg;
    }
    public function setMsg($msg){
        $this->msg = $msg;
        return $this;
    }
    public function getAlert(){
        return $this->alert;
    }
    public function setAlert($alert){
        $this->alert = $alert;
        return $this;
    }

    public function run(String $action){
        if ($action == Constants::UPDT_PASSWD_STR) {
            $this->updt_psswd();
        } else if ($action == Constants::UPDT_EMAIL_STR) {
            $this->updt_email();
        } else if ($action == Constants::UPDT_TLF_STR) {
            $this->updt_tlf();
        } else if ($action == Constants::UPDT_PROFILE_STR) {
            $this->updt_profile();
        } else if($action == Constants::RESET_PSSWD){
            $this->reset_psswd();
        }else {
            $this->index();
        }
    }

    private function index()
    {
        $new_msg = $this->getMsg();
        $data = $this->data;
        $alert = $this->alert;

        require_once Constants::VIEW_PROFILE;
    }

    private function updt_psswd() {
        if (isset($_POST['new_psswd'])) { // Si nos llega un valor con la clave new_psswd por Post
            $new_psswd = password_hash($_POST['new_psswd'], PASSWORD_ARGON2I); // encriptamos la nueva contraseña
            if ($new_psswd != $this->data['passwd']) {
                $params = ['new_psswd' => $new_psswd, 'id' => $this->data['id']]; // Creamos un array para guardar la contraseña y el id del usuario
                $result = $this->empleado->queryParam(Constants::UPDT_PSSWD_SELECT, $params); // Realizamos la consulta                               
                if (empty($result) || $result == false) { // Si nos ha devuelto nulo, ha ocurrido un error
                    $this->setMsg(Constants::ERROR_PSSWD); // guardamos el mensaje de error
                } else {
                    $token_params = Utils::generate_token_email_link(); // Generamos el token de reset y el tiempo que es válido
                    $token_params["id"] = $this->data['id']; // Añadimos, además, el id del usuario para realizar la query
                    $reset_psswd_token = $this->empleado->queryParam(Constants::UPDT_REST_PSSWD_VALUE_SELECT, $token_params); // ejecutamos la consulta                                       
                    if (!empty($reset_psswd_token) || $reset_psswd_token != false) { // Si todo ha ido bien
                        // Generamos un array para almacenar los valores neesarios para el correo de notificación
                        $data_email = [
                            'subject' => Constants::SEND_RESET_PSSWD_SUBJECT, 
                            'name' => $this->data['nombre'] . ' ' . $this->data['apellidos'], 
                            'email' => $_SESSION['correo'], 
                            'link' => Constants::CONTROLLER_SETTINGS . '?action=' . Constants::RESET_PSSWD . '&token_psswd=' . $token_params['reset_token_psswd_hash']];
                        $send_msg = Utils::send_email($data_email); // Enviamos el email                                                  
                        ($send_msg == null || empty($send_msg)) ?? $this->setMsg(Constants::ERROR_SEND_MSG_PSSWD);  // Si algo ha salido mal durante el envío del email, lo informamos                                    
                    }
                }
            } else {
                $this->setAlert(Constants::ERROR_OLD_PSSWD);
            }
        }
        $this->index();
    }


    private function updt_email() {
        if (isset($_POST['new_email'])) { // Si a través del POST vienen valores asociadas a estas dos claves            
            $new_email = $_POST['new_email']; // almacenamos el nuevo email
            $old_email = $this->data['correo']; // almacenamos el antiguo email
            if ($new_email != $old_email) { // comprobamos que el nuevo correo es distinto del antiguo
                $params = ['new_email' => $new_email, 'id' => $this->data['id']]; // creamos un array con los datos necesarios para realizar la query
                $result = $this->empleado->queryParam(Constants::UPDT_EMAIL_SELECT, $params); // ejecutamos la query y guardamos el resultado
                if ($result != false || !empty($result)) { // si el resultado es distinto de falso o no está vacio
                    $_SESSION['correo'] = $new_email; // Actualizamos el correo en la sesión
                    $token_params = Utils::generate_token_email_link(); // Generamos el token de reset y el tiempo que es válido
                    $token_params["id"] = $this->data['id']; // Añadimos, además, el id del usuario para realizar la query
                    $reset_email_token = $this->empleado->queryParam(Constants::UPDT_REST_EMAIL_VALUE_SELECT, $token_params); // ejecutamos la consulta
                    if (!empty($reset_email_token) || $reset_email_token != false) { // Si todo ha ido bien
                        $data_email = [
                            'subject' => Constants::SEND_RESET_EMAIL_SUBJECT,
                            'name' => $this->data['nombre'] . ' ' . $this->data['apellidos'],
                            'email' => $old_email,
                            // 'link' => Constants::CONTROLLER_SETTINGS . '?action=' . Constants::RESET_EMAIL . '&token_email=' . $token_params['reset_token_email_hash']
                        ];
                        $send_msg = Utils::send_email($data_email); // Enviamos el email   
                        ($send_msg == null || empty($send_msg)) ?? $this->setMsg(Constants::ERROR_SEND_MSG_EMAIL);  // Si algo ha salido mal durante el envío del email, lo informamos                                                        
                    }
                }
                if ($result == false || empty($result)) {
                    $this->setMsg(Constants::ERROR_EMAIL);
                }
            }
        }
        $this->data['correo'] = $new_email;
        $this->index();
    }


    private function updt_tlf() {
        if (isset($_POST['tlf'])) {
            $params = ['new_tlf' => $_POST['tlf'], 'id' => $this->data['id']];
            $result = $this->empleado->queryParam(Constants::UPDT_TLF_SELECT, $params);

            if ($result == null) {
                $this->setMsg(Constants::ERROR_TLF);
            }
        }
        $this->data['telf'] = $_POST['tlf'];
        $this->index();
    }

    private function updt_profile(){
        if(isset($_POST)){
            $params = ["name" => $_POST["name"], "surname" => $_POST["lname"], "fechnac" => $_POST["fechnac"], "id" => $this->data["id"]];
        }
        $result = $this->empleado->queryParam(Constants::UPDT_PROFILE_SELECT, $params);
        if ($result == null) {
            $this->setMsg(Constants::ERROR_PROFILE);
        }
        $this->data['nombre'] = $_POST["name"];
        $this->data['apellidos'] = $_POST["lname"];
        $this->data['fechnac'] = $_POST["fechnac"];
        $this->index();
    }
    

    private function reset_psswd(){
        if(isset($_REQUEST['token_psswd'])){
            $token = ['reset_token' => $_REQUEST['token_psswd']];
            $result = $this->empleado->queryParam(Constants::GET_USER_TOKEN_PSSWD_SELECT, $token);  
            if($result == false || empty($result)) {
                $msg = base64_encode(Constants::ERROR_PSSWD);
                header('Location:' . Constants::VIEW_LOGIN . '?action=' . Constants::RESET_PSSWD . '&msg=' . $msg);
                die;
            }
            $this->data = $result[0];
            $data = $this->data;
            if(!isset($_REQUEST['email'])){
                if(strtotime($data['t_reset_token_psswd_expires_at']) <= time()){ // Si ya ha expirado el tiempo disponible del token
                    $msg = base64_encode(Constants::ERROR_TOKEN_EXPIRED);
                    header('Location:' . Constants::VIEW_LOGIN . '?action=' . Constants::RESET_PSSWD . '&msg=' . $msg);
                    die;
                }
                include Constants::VIEW_CHANGE_PSSWD;
            }else if(isset($_REQUEST['email'])){
                if (isset($_POST['new_psswd']) && isset($_POST['new_psswd2'])) { // Si nos llega un valor con la clave new_psswd por Post
                    if($_POST['new_psswd'] != $_POST['new_psswd2']){
                        $msg = base64_encode(Constants::ERROR_DIFFERENT_PSSWD);
                        header('Location:' . Constants::VIEW_CHANGE_PSSWD_URL . '?&msg=' . $msg . '&token_psswd=' . $_REQUEST['token_psswd']);
                        die;
                    }
                    $new_psswd = password_hash($_POST['new_psswd'], PASSWORD_ARGON2I); // encriptamos la nueva contraseña
                    $params = ['new_psswd' => $new_psswd, 'id' => $data['id']]; // Creamos un array para guardar la contraseña y el id del usuario
                    $result = $this->empleado->queryParam(Constants::UPDT_PSSWD_SELECT, $params); // Realizamos la consulta             
                    if (empty($result) || $result == false) { // Si nos ha devuelto nulo, ha ocurrido un error
                        $msg = base64_encode(Constants::ERROR_PSSWD);
                    }
                    $msgOk = base64_encode(Constants::PSSWD_CHANGED);
                    header('Location:' . Constants::VIEW_LOGIN . '?' . ((isset($msg)) ? '&msg=' . $msg : '&msgOk=' . $msgOk));
                    die;
                }                
            }
        }
    }
}

//Comprobamos que la sesion esta iniciada
session_start();

$settings = new Settings();
$action = !empty($_REQUEST["action"]) ? $_REQUEST["action"] : "index";

//Si no tenemos guardado login 
if (!Utils::is_logged_in() && (!$action != Constants::RESET_PSSWD || !$action != Constants::RESET_EMAIL)) {
    header("Location:../../public/Login.php");
    die;
}
$settings->run($action);

// echo password_hash('Kesesoesoeskeso0!', PASSWORD_ARGON2I);