<?php
namespace utils;
class Constants 
{
    // QUERYS
    const UPDT_PSSWD_SELECT = 'UPDATE perrera.empleados SET passwd = :new_psswd WHERE id = :id LIMIT 1';
    const UPDT_EMAIL_SELECT = 'UPDATE perrera.empleados SET correo = :new_email WHERE id = :id LIMIT 1';
    const UPDT_TLF_SELECT = 'UPDATE perrera.empleados SET telf = :new_tlf WHERE id = :id LIMIT 1';
    const UPDT_REST_PSSWD_VALUE_SELECT = 'UPDATE perrera.empleados SET reset_token_psswd_hash = :reset_token_psswd_hash, t_reset_token_psswd_expires_at = :t_reset_token_psswd_expires_at WHERE id = :id';
    const UPDT_PROFILE = 'UPDATE perrera.empleados SET nombre = :name, apellidos = :surname, fechnac = :fechnac WHERE id = :id';
    const UPDT_REST_EMAIL_VALUE_SELECT = 'UPDATE perrera.empleados SET reset_token_email_hash = :reset_token_email_hash, t_reset_token_email_expires_at = :t_reset_token_email_expires_at WHERE id = :id';
    const GET_USER_TOKEN_PSSWD_SELECT = 'SELECT * FROM perrera.empleados WHERE reset_token_psswd_hash = :reset_token';
    const GET_USER_TOKEN_EMAIL_SELECT = 'SELECT * FROM perrera.empleados WHERE reset_token_email_hash = :reset_token';

    // ACTIONS
    const UPDT_PROFILE_STR = 'CHANGE_PROFILE';
    const UPDT_PASSWD_STR = 'CHANGE_PSSWD';
    const UPDT_EMAIL_STR = 'CHANGE_EMAIL';
    const UPDT_TLF_STR = 'CHANGE_TLF';
    const RESET_PSSWD = 'RESET_PSSWD';
    const RESET_EMAIL = 'RESET_PSSWD';

    //  EMAIL
    const SEND_RESET_PSSWD = 'resetPsswd';
    const SEND_RESET_EMAIL = 'resetEmail';
    const SEND_WELCOME_EMAIL_SUBJECT = 'Bienvenido/a a ¡Patas Arriba!';
    const SEND_RESET_PSSWD_SUBJECT = 'Confirmación de Cambio de Contraseña';
    const SEND_RESET_EMAIL_SUBJECT = 'Confirmación de Cambio de Correo Electrónico';

    // VIEWS
    const VIEW_PROFILE = '../views/V_UserSettings.php';
    const VIEW_CHANGE_PSSWD_URL = 'http://localhost/DES/perrera-ec2/app/views/V_ChangePsswd.php';
    const VIEW_CHANGE_PSSWD = '../views/V_ChangePsswd.php';
    const VIEW_LOGIN = 'http://localhost/DES/perrera-ec2/public/Login.php';

    // CONTROLLERS
    const CONTROLLER_SETTINGS = 'http://localhost/DES/perrera-ec2/app/controllers/SettingsC.php';
    const CONTROLLER_LOGIN = 'http://localhost/DES/perrera-ec2/app/controllers/LoginC.php';

    // ERRORES
    const ERROR_UPDATE = "No se ha podido modificar el registro.";
    const ERROR_INSERT = "No se ha podido insertar el registro.";
    const ERROR_DELETE = "No se ha podido eliminar el registro.";
    const ERROR_SELECT = 'No se ha podido encontrar el/los registro/s.';
    const ERROR_TOKEN_EXPIRED = 'Token expirado, póngase en contacto con soporte.';
    const ERROR_PSSWD = "No se ha podido modificar la contraseña.";
    const ERROR_DIFFERENT_PSSWD = 'Las contraseñas no coinciden';
    const ERROR_OLD_PSSWD = 'No puedes utilizar la contraseña antigua.';
    const ERROR_EMAIL = "No se ha podido modificar el email.";
    const ERROR_TLF = "No se ha podido cambiar el teléfono.";
    const ERROR_SEND_MSG_PSSWD = 'No se ha podido enviar el mensaje de confirmación';
    const ERROR_SEND_MSG_EMAIL = 'No se ha enviado el email.';

    // OK
    const PSSWD_CHANGED = 'Contraseña modificada con éxito.';
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