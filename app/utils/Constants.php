<?php
namespace utils;
class Constants 
{
    // QUERYS
    const UPDT_PSSWD_SELECT = 'UPDATE perrera.empleados SET passwd = :new_psswd WHERE id = :id LIMIT 1';
    const UPDT_EMAIL_SELECT = 'UPDATE perrera.empleados SET correo = :new_email WHERE id = :id LIMIT 1';
    const UPDT_TLF_SELECT = 'UPDATE perrera.empleados SET telf = :new_tlf WHERE id = :id LIMIT 1';

    // ACTIONS
    const UPDT_PROFILE_STR = 'CHANGE_PROFILE';
    const UPDT_PASSWD_STR = 'CHANGE_PSSWD';
    const UPDT_EMAIL_STR = 'CHANGE_EMAIL';
    const UPDT_TLF_STR = 'CHANGE_TLF';

    // VIEWS
    const VIEW_PROFILE = '../views/V_UserSettings.php';

    // ERRORES
    const ERROR_UPDATE = "No se ha podido modificar el registro.";
    const ERROR_PSSWD = "No se ha podido modificar la contraseña.";
    const ERROR_EMAIL = "No se ha podido modificar el email.";
    const ERROR_TLF = "No se ha podido cambiar el teléfono.";
}
// MENSAJES PARA LAS OPERACIONES EN LA BASE DE DATOS
define("ERROR_INSERT", "No se ha podido introducir el nuevo registro a la base de datos. Revisa los datos introducidos");
define("ERROR_UPDATE", "No se ha podido modificar el registro.");
define("ERROR_DELETE", "No se ha podido eliminar el elemento.");


// PÁGINAS PARA EL CONTROLADOR DE ANIMALES
define("VIEW_ANIMAL", "V_Animales.php");
define("VIEW_UPDATE_EDIT", "../views/update_or_add_animal.php");


// CONSTANTES ROLES EMPLEADOS
define("USER_ROL_ADMIN", "ADMINISTRADOR");
define("USER_ROL_ENCADOP", "ENCARGADO DE ADOPCIONES");
define("USER_ROL_ENCTAREAS", "ENCARGADO DE TAREAS");
define("USER_ROL_ENCVOLUN", "ENCARGADO DE VOLUNTARIOS");
define("USER_ROL_EMPLEADO", "EMPLEADO");



?>