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

    public function run(String $action)
    {
        if($action == Constants::UPDT_PASSWD_STR){
            $this->updt_psswd();
        }else if($action == Constants::UPDT_EMAIL_STR){
            $this->updt_email();            
        }else if($action == Constants::UPDT_TLF_STR){
            $this->updt_tlf();
        }else if($action == Constants::UPDT_PROFILE_STR){
            $this->updt_psswd();
        }else{
            $this->index();
        }
    }    

    private function index()
    {
        $new_msg = $this->getMsg();
        $data = $this->data;

        require_once Constants::VIEW_PROFILE;
    }

    private function updt_psswd()
    {
        if(isset($_POST['new_psswd'])){

            $new_psswd = password_hash($_POST['new_psswd'], PASSWORD_ARGON2I);
            $params = ['new_psswd' => $new_psswd, 'id' => $this->data['id']];
            $result = $this->empleado->queryParam(Constants::UPDT_PSSWD_SELECT, $params);

            if($result == null){
                $this->setMsg(Constants::ERROR_PSSWD);
            }
        }
        $this->index();
    }


    private function updt_email()
    {
        if(isset($_POST['new_email'])){
            $params = ['new_email' => $_POST['new_email'], 'id' => $this->data['id']];
            $result = $this->empleado->queryParam(Constants::UPDT_PSSWD_SELECT, $params);

            if($result == null){
                $this->setMsg(Constants::ERROR_EMAIL);
            }
        }
        $this->index();
    }


    private function updt_tlf()
    {
        if(isset($_POST['new_tlf'])){
            $params = ['new_tlf' => $_POST['new_tlf'], 'id' => $this->data['id']];
            $result = $this->empleado->queryParam(Constants::UPDT_PSSWD_SELECT, $params);

            if($result == null){
                $this->setMsg(Constants::ERROR_TLF);
            }
        }
        $this->index();
    }


    private function updt_profile()
    {

    }
}


//Comprobamos que la sesion esta iniciada
session_start();

//Si no tenemos guardado login 
if (!Utils::is_logged_in()) {
    header("Location:../../public/Login.php");
    die;
}


$settings = new Settings();
$action = !empty($_REQUEST["action"]) ? $_REQUEST["action"] : "index";
var_dump($action);
$settings->run($action);


?>