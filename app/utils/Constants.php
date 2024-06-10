<?php
namespace utils;
class Constants 
{
    // QUERYS
    const UPDT_PSSWD_SELECT = 'UPDATE perrera.empleados SET passwd = :new_psswd WHERE id = :id LIMIT 1';
    const UPDT_EMAIL_SELECT = 'UPDATE perrera.empleados SET correo = :new_email WHERE id = :id LIMIT 1';
    const UPDT_TLF_SELECT = 'UPDATE perrera.empleados SET telf = :new_tlf WHERE id = :id LIMIT 1';
    const UPDT_REST_PSSWD_VALUE_SELECT = 'UPDATE perrera.empleados SET reset_token_psswd_hash = :reset_token_psswd_hash, t_reset_token_psswd_expires_at = :t_reset_token_psswd_expires_at WHERE id = :id';
    const UPDT_PROFILE_SELECT = 'UPDATE perrera.empleados SET nombre = :name, apellidos = :surname, fech_nac = :fech_nac WHERE id = :id';
    const UPDT_REST_EMAIL_VALUE_SELECT = 'UPDATE perrera.empleados SET reset_token_email_hash = :reset_token_email_hash, t_reset_token_email_expires_at = :t_reset_token_email_expires_at WHERE id = :id';
    const UPDT_IMG = 'UPDATE perrera.imgs SET ruta = :ruta, nombre = :nombre, tipo = :tipo, tamanio = :tamanio WHERE id = :id LIMIT 1';

    
    // UNDELETES
    const UPDT_UNDELETE_ANIMALES = 'UPDATE perrera.animales SET disponible = 1 WHERE id = :id LIMIT 1';    
    const UPDT_UNDELETE_ROLES = 'UPDATE perrera.roles SET disponible = 1 WHERE id = :id LIMIT 1';  
    const UPDT_UNDELETE_JAULAS = 'UPDATE perrera.jaulas SET disponible = 1 WHERE id = :id LIMIT 1'; 
    const UPDT_UNDELETE_ESPECIES = 'UPDATE perrera.especies SET disponible = 1 WHERE id = :id LIMIT 1'; 
    const UPDT_UNDELETE_EMPLEADOS = 'UPDATE perrera.empleados SET disponible = 1 WHERE id = :id LIMIT 1'; 
    const UPDT_UNDELETE_ADOPTANTES = 'UPDATE perrera.adoptante SET disponible = 1 WHERE id = :id LIMIT 1'; 
    const UPDT_UNDELETE_VETERINARIOS = 'UPDATE perrera.veterinarios SET disponible = 1 WHERE id = :id LIMIT 1';  
    const UPDT_UNDELETE_DUENIOS = 'UPDATE perrera.duenios SET disponible = 1 WHERE id = :id LIMIT 1';
    const UPDT_UNDELETE_VOLUNTARIOS = 'UPDATE perrera.voluntarios SET disponible = 1 WHERE id = :id LIMIT 1';
    const UPDT_UNDELETE_TAREAS = 'UPDATE perrera.tareas SET disponible = 1 WHERE id = :id LIMIT 1';
    
    // INSERTS
    const INSERT_ANIMALES_PHOTOS = 'INSERT INTO perrera.imgs (animales_id, nombre, tipo, tamanio, ruta) VALUES ';
    const INSERT_EMPLEADOS_PHOTOS = 'INSERT INTO perrera.imgs (empleado_id, nombre, ruta) VALUES ';
    const SEARCH_ANIMALES_TABLE = 'SELECT a.*, e.nombre as nombre_especie, j.ubicacion as ubicacion FROM perrera.animales a JOIN perrera.especies e ON  a.especies_id = e.id JOIN perrera.jaulas j ON a.jaulas_id = j.id WHERE a.nombre LIKE :search_value OR a.raza LIKE :search_value OR e.nombre LIKE :search_value ORDER BY a.';
    const SEARCH_ANIMALES_TABLE_TOTAL_PAGES = 'SELECT a.Id FROM perrera.animales a JOIN perrera.especies e ON  a.especies_id = e.id JOIN perrera.jaulas j ON a.jaulas_id = j.id WHERE a.nombre LIKE :search_value OR a.raza LIKE :search_value OR e.nombre LIKE :search_value ORDER BY a.nombre';
    const SEARCH_ESPECIES_TABLE = 'SELECT id, nombre, descripcion, disponible FROM perrera.especies WHERE nombre LIKE :search_value OR descripcion LIKE :search_value ORDER BY ';
    const SEARCH_ROLES_TABLE = 'SELECT id, rol, descripcion, disponible FROM perrera.roles WHERE rol LIKE :search_value OR descripcion LIKE :search_value ORDER BY ';
    const SEARCH_VETERINARIOS_TABLE = 'SELECT * FROM perrera.veterinarios WHERE nombre LIKE :search_value OR apellidos LIKE :search_value OR correo LIKE :search_value OR especialidad LIKE :search_value OR nombre_clinica LIKE :search_value ORDER BY ';
    const SEARCH_ADOPTANTES_TABLE = 'SELECT * FROM perrera.adoptante WHERE nombre LIKE :search_value OR apellidos LIKE :search_value OR NIF LIKE :search_value OR correo LIKE :search_value OR estado_solicitud LIKE :search_value ORDER BY ';
    const SEARCH_VOLUNTARIOS_TABLE = 'SELECT * FROM perrera.voluntarios WHERE nombre LIKE :search_value OR apellidos LIKE :search_value OR NIF LIKE :search_value OR correo LIKE :search_value OR telf LIKE :search_value ORDER BY ';
    const SEARCH_JAULAS_TABLE = 'SELECT j.*, e.nombre as nombre_especie FROM perrera.jaulas j JOIN perrera.especies e ON j.especies_id = e.id WHERE j.nombre LIKE :search_value OR j.descripcion LIKE :search_value OR e.nombre LIKE :search_value ORDER BY j.';
    const SEARCH_ESPECIES_TABLE_TOTAL_PAGES = 'SELECT Id FROM perrera.especies WHERE nombre LIKE :search_value OR descripcion LIKE :search_value ORDER BY nombre ';
    const SEARCH_ROLES_TABLE_TOTAL_PAGES = 'SELECT Id FROM perrera.roles WHERE rol LIKE :search_value OR descripcion LIKE :search_value ORDER BY rol ';
    const SEARCH_JAULAS_TABLE_TOTAL_PAGES = 'SELECT j.Id FROM perrera.jaulas j JOIN perrera.especies e ON j.especies_id = e.id WHERE j.nombre LIKE :search_value OR j.descripcion LIKE :search_value OR e.nombre LIKE :search_value ORDER BY j.ubicacion ';
    const SEARCH_VETERINARIOS_TABLE_TOTAL_PAGES = 'SELECT Id FROM perrera.veterinarios WHERE nombre LIKE :search_value OR apellidos LIKE :search_value OR correo LIKE :search_value OR especialidad LIKE :search_value OR nombre_clinica LIKE :search_value ORDER BY nombre';
    const SEARCH_ADOPTANTES_TABLE_TOTAL_PAGES = 'SELECT Id FROM perrera.adoptante WHERE nombre LIKE :search_value OR apellidos LIKE :search_value OR NIF LIKE :search_value OR correo LIKE :search_value OR estado_solicitud LIKE :search_value ORDER BY';
    const SEARCH_VOLUNTARIOS_TABLE_TOTAL_PAGES = 'SELECT Id FROM perrera.voluntarios WHERE nombre LIKE :search_value OR apellidos LIKE :search_value OR NIF LIKE :search_value OR correo LIKE :search_value OR telf LIKE :search_value ORDER BY nombre';
    
    // GETTERS
    const GET_IMGS_ANIMAL_QUERY = 'SELECT * FROM perrera.imgs WHERE animales_id = :id';
    const GET_IMGS_EMPLOYEE_QUERY = 'SELECT * FROM perrera.imgs WHERE id_empleado = :id';
    const GET_IMG_QUERY = 'SELECT * FROM perrera.imgs WHERE id = :id LIMIT 1';
    const GET_ESPECIES = 'SELECT * FROM perrera.especies WHERE disponible = 1';
    const GET_VETERINARIOS = 'SELECT * FROM perrera.veterinarios WHERE disponible = 1';
    const GET_JAULAS = 'SELECT * FROM perrera.jaulas WHERE disponible = 1';
    const GET_VOLUNTARIOS = 'SELECT * FROM perrera.voluntarios WHERE disponible = 1';
    const GET_ROLES = 'SELECT * FROM perrera.roles WHERE disponible = 1';
    const GET_JAULAS_BY_ESPECIE_AVAILABLE = 'SELECT j.*, e.id as especie_id, e.nombre as nombre_especie FROM perrera.jaulas j JOIN perrera.especies e ON j.especies_id = e.id WHERE j.especies_id = :id AND j.disponible = 1 AND (((SELECT (j.tamanio - COUNT(a.id)) FROM perrera.animales a WHERE a.jaulas_id = j.id) > 0 ) OR (j.id = :jaula_id))';
    const GET_LAST_JAULA_NUMBER = 'SELECT LPAD(MAX(SUBSTRING_INDEX(ubicacion, "-", -1)) + 1, 2, "0") AS ultimo_num FROM perrera.jaulas WHERE LEFT(ubicacion, 1) = :letter_cage';
    const GET_ESPECIE = 'SELECT * FROM perrera.especies WHERE id = :id';
    const GET_ROL = 'SELECT * FROM perrera.roles WHERE id = :id';
    const GET_VOLUNTARIO = 'SELECT * FROM perrera.voluntarios WHERE id = :id';
    const GET_ADOPTANTE = 'SELECT * FROM perrera.adoptante WHERE id = :id';
    const GET_DUENIO = 'SELECT * FROM perrera.duenios WHERE id = :id';
    const GET_JAULA = 'SELECT j.*, e.nombre as nombre_especie FROM perrera.jaulas j JOIN perrera.especies e ON j.especies_id = e.id WHERE j.id = :id';
    const GET_VETERINARIO = 'SELECT * FROM perrera.veterinarios WHERE id = :id';    const GET_USER_TOKEN_PSSWD_SELECT = 'SELECT * FROM perrera.empleados WHERE reset_token_psswd_hash = :reset_token';
    const GET_USER_TOKEN_EMAIL_SELECT = 'SELECT * FROM perrera.empleados WHERE reset_token_email_hash = :reset_token';
    const GET_ROWS_SEARCH = 'SELECT * FROM :name_table WHERE ';
    const GET_ANIMAL = "SELECT a.id, a.nombre, a.especies_id, a.raza, a.genero, a.tamanio, a.peso, a.colores, a.personalidad, a.fech_nac, a.estado_adopcion, a.estado_salud, a.necesidades_especiales, a.otras_observaciones, a.jaulas_id, e.nombre as especie, j.ubicacion as jaula, j.id as jaula_id, GROUP_CONCAT(i.id SEPARATOR ',') as img_ids, GROUP_CONCAT(i.animales_id SEPARATOR ',') as img_id_animals, GROUP_CONCAT(i.ruta SEPARATOR ',') as img_paths, GROUP_CONCAT(i.disponible SEPARATOR ',') as img_actives FROM perrera.animales a JOIN perrera.especies e ON a.especies_id = e.id JOIN perrera.jaulas j ON a.jaulas_id = j.id LEFT JOIN perrera.imgs i ON a.id = i.animales_id WHERE a.id = :id GROUP BY a.id, a.nombre, a.especies_id, a.raza, a.genero, a.tamanio, a.peso, a.colores, a.personalidad, a.fech_nac, a.estado_adopcion, a.estado_salud, a.necesidades_especiales, a.otras_observaciones, a.jaulas_id, e.nombre, j.ubicacion";
    const GET_ANIMAL2 = "SELECT a.id, a.nombre, a.especies_id, a.raza, a.genero, a.tamanio, a.peso, a.colores, a.personalidad, a.fech_nac, a.estado_adopcion, a.estado_salud, a.necesidades_especiales, a.otras_observaciones, a.jaulas_id, e.nombre as especie, j.ubicacion as jaula, j.id as jaula_id FROM perrera.animales a JOIN perrera.especies e ON a.especies_id = e.id JOIN perrera.jaulas j ON a.jaulas_id = j.id WHERE a.id = :id";
    const GET_ANIMAL_MODAL = "SELECT a.id, a.nombre, e.nombre as especie, j.ubicacion as jaula FROM perrera.animales a JOIN perrera.especies e ON a.especies_id = e.id JOIN perrera.jaulas j ON a.jaulas_id = j.id ORDER BY a.nombre";
    const GET_IMGS_ANIMAL = "SELECT * FROM perrera.imgs WHERE animales_id = :id_animal";
    
    // UPDATES
    const UPDT_ESPECIE = 'UPDATE perrera.especies SET nombre = :nombre, descripcion = :descripcion WHERE id = :id';
    const UPDT_ROL = 'UPDATE perrera.roles SET rol = :rol, descripcion = :descripcion WHERE id = :id';
    const UPDT_JAULA = 'UPDATE perrera.jaulas SET ubicacion = :ubicacion, tamanio = :tamanio, ocupada = :ocupada, estado_comida = :estado_comida, estado_limpieza = :estado_limpieza, otros_comentarios = :otros_comentarios, descripcion = :descripcion, especies_id = :especies_id WHERE id = :id';
    const UPDT_VETERINARIO = 'UPDATE veterinarios SET nombre = :nombre, apellidos = :apellidos, correo = :correo, telf = :telf, direccion = :direccion, especialidad = :especialidad, nombre_clinica = :nombre_clinica, direccion_clinica = :direccion_clinica, telf_clinica = :telf_clinica, correo_clinica = :correo_clinica, hora_apertura = :hora_apertura, hora_cierre = :hora_cierre, otra_informacion = :otra_informacion WHERE id = :id;';
    const UPDT_VOLUNTARIO = 'UPDATE voluntarios SET nombre = :nombre, apellidos = :apellidos, fech_nac = :fech_nac, NIF = :NIF, correo = :correo, telf = :telf, disponibilidad = :disponibilidad, experiencia_previa = :experiencia_previa, comentarios = :comentarios, fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin, informacion_relevante = :informacion_relevante WHERE id = :id;';
    const UPDT_ADOPTANTE = 'UPDATE adoptante SET nombre = :nombre, apellidos = :apellidos, fech_nac = :fech_nac, NIF = :NIF, correo = :correo, telf = :telf, direccion = :direccion, ciudad = :ciudad, codigo_postal = :codigo_postal, pais = :pais, ocupacion = :ocupacion, tipo_vivienda = :tipo_vivienda, tiene_jardin = :tiene_jardin, preferencia_adopcion = :preferencia_adopcion, otra_mascota = :otra_mascota, tipo_otra_mascota = :tipo_otra_mascota, estado_solicitud = :estado_solicitud, fecha_solicitud = :fecha_solicitud, tiempo_espera = :tiempo_espera, estado_adopcion = :estado_adopcion, fecha_adopcion = :fecha_adopcion, comentarios = :comentarios, animales_id = :animales_id WHERE id = :id';
    const UPDT_DUENIO = 'UPDATE duenios SET nombre = :nombre, apellidos = :apellidos, fech_nac = :fech_nac, NIF = :NIF, correo = :correo, telf = :telf, direccion = :direccion, ciudad = :ciudad, codigo_postal = :codigo_postal, pais = :pais, permiso_visita = :permiso_visita, fecha_ultima_visita = :fecha_ultima_visita, observaciones = :observaciones WHERE id = :id';

    //  DELETES
    const DELETE_ESPECIE = 'UPDATE perrera.especies SET disponible = 0 WHERE id = :id';
    const DELETE_ROL = 'UPDATE perrera.roles SET disponible = 0 WHERE id = :id';
    const DELETE_JAULA = 'UPDATE perrera.jaulas SET disponible = 0 WHERE id = :id';
    const DELETE_VETERINARIO = 'UPDATE perrera.veterinarios SET disponible = 0 WHERE id = :id';
    const DELETE_VOLUNTARIO = 'UPDATE perrera.jaulas SET disponible = 0 WHERE id = :id';
    const DELETE_EMPLEADO = 'UPDATE perrera.jaulas SET disponible = 0 WHERE id = :id';
    const DELETE_DUENIO = 'UPDATE perrera.jaulas SET disponible = 0 WHERE id = :id';
    const DELETE_TAREA = 'UPDATE perrera.jaulas SET disponible = 0 WHERE id = :id';
    const DELETE_ADOPTANTE = 'UPDATE perrera.jaulas SET disponible = 0 WHERE id = :id';
    const DELETE_IMG_QUERY = 'DELETE FROM perrera.imgs WHERE Id = :id';
    const DELETE_IMGS_ANIMAL_QUERY = 'DELETE FROM perrera.imgs WHERE animales_id = :id';

    // ACTIONS
    const UPDT_PROFILE_STR = 'CHANGE_PROFILE';
    const UPDT_PASSWD_STR = 'CHANGE_PSSWD';
    const UPDT_EMAIL_STR = 'CHANGE_EMAIL';
    const UPDT_TLF_STR = 'CHANGE_TLF';
    const RESET_PSSWD = 'RESET_PSSWD';
    const RESET_EMAIL = 'RESET_EMAIL';

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
    const VIEW_ANIMAL = '../views/V_AnimalVer.php';
    const VIEW_ESPECIE = '../views/V_EspecieVer.php';
    const VIEW_JAULA = '../views/V_JaulaVer.php';
    const VIEW_ROL = '../views/V_RolVer.php';
    const VIEW_VETERINARIO = '../views/V_VeterinarioVer.php';
    const VIEW_VOLUNTARIO = '../views/V_VoluntarioVer.php';
    const VIEW_DUENIO = '../views/V_DuenioVer.php';
    const VIEW_ADOPTANTE = '../views/V_AdoptanteVer.php';
    const VIEW_TAREA = '../views/V_TareaVer.php';

    // CONTROLLERS
    const CONTROLLER_SETTINGS = 'http://localhost/DES/perrera-ec2/app/controllers/SettingsC.php';
    const CONTROLLER_LOGIN = 'http://localhost/DES/perrera-ec2/app/controllers/LoginC.php';

    // TABLES' NAME
    const ANIMAL_TABLE = 'animales';
    const EMPLOYEES_TABLE = 'empleados';

    // ERRORES
    const ERROR_UPDATE = "No se ha podido modificar el registro.";
    const ERROR_INSERT = "No se ha podido insertar el registro.";
    const ERROR_DELETE = "No se ha podido eliminar el registro.";
    const ERROR_UNDELETE = "No se ha podido recuperar el registro.";
    const ERROR_SELECT = 'No se ha podido encontrar el/los registro/s.';
    const ERROR_TOKEN_EXPIRED = 'Token expirado, póngase en contacto con soporte.';
    const ERROR_PSSWD = "No se ha podido modificar la contraseña.";
    const ERROR_DIFFERENT_PSSWD = 'Las contraseñas no coinciden';
    const ERROR_OLD_PSSWD = 'No puedes utilizar la contraseña antigua.';
    const ERROR_EMAIL = "No se ha podido modificar el email.";
    const ERROR_TLF = "No se ha podido cambiar el teléfono.";
    const ERROR_PROFILE = "No se ha podido cambiar los datos del usuario.";
    const ERROR_SEND_MSG_PSSWD = 'No se ha podido enviar el mensaje de confirmación';
    const ERROR_SEND_MSG_EMAIL = 'No se ha enviado el email.';
    const ERROR_ADD_IMG = 'No se han podido añadir las imágenes.';

    // MSGs
    const ADD_IMG_SUCCESS = 'La/s imagen/es han sido añadidas con éxito.';
    const ADD_IMG_ERROR = 'No se han podido insertar las imágenes.';


    // OK
    const PSSWD_CHANGED = 'Contraseña modificada con éxito.';

    // ROL
    const ROL_ADMIN = 'Administrador'; // TO DO
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