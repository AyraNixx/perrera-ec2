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
    const UPDT_UNDELETE_TAREA_ASIGNADA = 'UPDATE perrera.tareas_asignadas SET disponible = 1 WHERE id = :id LIMIT 1';
    const UPDT_UNDELETE_ATENCION_VETERINARIA = 'UPDATE perrera.animales_atendidos_veterinarios SET disponible = 1 WHERE id = :id LIMIT 1';
    
    // INSERTS
    const INSERT_ANIMALES_PHOTOS = 'INSERT INTO perrera.imgs (animales_id, nombre, tipo, tamanio, ruta) VALUES ';
    const INSERT_EMPLEADOS_PHOTOS = 'INSERT INTO perrera.imgs (empleados_id, nombre, tipo, tamanio, ruta) VALUES ';
    const SEARCH_ANIMALES_TABLE = 'SELECT a.*, e.nombre as nombre_especie, j.ubicacion as ubicacion FROM perrera.animales a JOIN perrera.especies e ON  a.especies_id = e.id JOIN perrera.jaulas j ON a.jaulas_id = j.id WHERE a.nombre LIKE :search_value OR a.raza LIKE :search_value OR e.nombre LIKE :search_value ORDER BY a.';

    // SEARCH
    const SEARCH_ANIMALES_TABLE_TOTAL_PAGES = 'SELECT a.Id FROM perrera.animales a JOIN perrera.especies e ON  a.especies_id = e.id JOIN perrera.jaulas j ON a.jaulas_id = j.id WHERE a.nombre LIKE :search_value OR a.raza LIKE :search_value OR e.nombre LIKE :search_value ORDER BY a.nombre';
    const SEARCH_ESPECIES_TABLE = 'SELECT id, nombre, descripcion, disponible FROM perrera.especies WHERE nombre LIKE :search_value OR descripcion LIKE :search_value ORDER BY ';
    const SEARCH_ROLES_TABLE = 'SELECT id, rol, descripcion, disponible FROM perrera.roles WHERE rol LIKE :search_value OR descripcion LIKE :search_value ORDER BY ';
    const SEARCH_TAREAS_TABLE = 'SELECT id, asunto, descripcion, disponible FROM perrera.tareas WHERE asunto LIKE :search_value OR descripcion LIKE :search_value ORDER BY ';
    const SEARCH_VETERINARIOS_TABLE = 'SELECT * FROM perrera.veterinarios WHERE nombre LIKE :search_value OR apellidos LIKE :search_value OR correo LIKE :search_value OR especialidad LIKE :search_value OR nombre_clinica LIKE :search_value ORDER BY ';
    const SEARCH_ADOPTANTES_TABLE = 'SELECT * FROM perrera.adoptante WHERE nombre LIKE :search_value OR apellidos LIKE :search_value OR NIF LIKE :search_value OR correo LIKE :search_value OR estado_solicitud LIKE :search_value ORDER BY ';
    const SEARCH_EMPLEADOS_TABLE = 'SELECT * FROM perrera.empleados WHERE nombre LIKE :search_value OR apellidos LIKE :search_value OR NIF LIKE :search_value OR correo LIKE :search_value ORDER BY ';
    const SEARCH_DUENIOS_TABLE = 'SELECT * FROM perrera.duenios WHERE nombre LIKE :search_value OR apellidos LIKE :search_value OR NIF LIKE :search_value OR correo LIKE :search_value ORDER BY ';
    const SEARCH_VOLUNTARIOS_TABLE = 'SELECT * FROM perrera.voluntarios WHERE nombre LIKE :search_value OR apellidos LIKE :search_value OR NIF LIKE :search_value OR correo LIKE :search_value OR telf LIKE :search_value ORDER BY ';
    const SEARCH_JAULAS_TABLE = 'SELECT j.*, e.nombre as nombre_especie FROM perrera.jaulas j JOIN perrera.especies e ON j.especies_id = e.id WHERE j.ubicacion LIKE :search_value OR j.descripcion LIKE :search_value OR e.nombre LIKE :search_value AND j.disponible = 1 ORDER BY j.';
    const SEARCH_ESPECIES_TABLE_TOTAL_PAGES = 'SELECT Id FROM perrera.especies WHERE nombre LIKE :search_value OR descripcion LIKE :search_value ORDER BY nombre ';
    const SEARCH_ROLES_TABLE_TOTAL_PAGES = 'SELECT Id FROM perrera.roles WHERE rol LIKE :search_value OR descripcion LIKE :search_value ORDER BY rol ';
    const SEARCH_TAREAS_TABLE_TOTAL_PAGES = 'SELECT Id FROM perrera.tareas WHERE asunto LIKE :search_value OR descripcion LIKE :search_value ORDER BY asunto ';
    const SEARCH_JAULAS_TABLE_TOTAL_PAGES = 'SELECT j.Id FROM perrera.jaulas j JOIN perrera.especies e ON j.especies_id = e.id WHERE j.ubicacion LIKE :search_value OR j.descripcion LIKE :search_value OR e.nombre LIKE :search_value AND j.disponible = 1 ORDER BY j.ubicacion ';
    const SEARCH_VETERINARIOS_TABLE_TOTAL_PAGES = 'SELECT Id FROM perrera.veterinarios WHERE nombre LIKE :search_value OR apellidos LIKE :search_value OR correo LIKE :search_value OR especialidad LIKE :search_value OR nombre_clinica LIKE :search_value ORDER BY nombre';
    const SEARCH_ADOPTANTES_TABLE_TOTAL_PAGES = 'SELECT Id FROM perrera.adoptante WHERE nombre LIKE :search_value OR apellidos LIKE :search_value OR NIF LIKE :search_value OR correo LIKE :search_value OR estado_solicitud LIKE :search_value ORDER BY';
    const SEARCH_EMPLEADOS_TABLE_TOTAL_PAGES = 'SELECT Id FROM perrera.empleados WHERE nombre LIKE :search_value OR apellidos LIKE :search_value OR NIF LIKE :search_value OR correo LIKE :search_value ORDER BY';
    const SEARCH_VOLUNTARIOS_TABLE_TOTAL_PAGES = 'SELECT Id FROM perrera.voluntarios WHERE nombre LIKE :search_value OR apellidos LIKE :search_value OR NIF LIKE :search_value OR correo LIKE :search_value OR telf LIKE :search_value ORDER BY nombre';
    const SEARCH_DUENIOS_TABLE_TOTAL_PAGES = 'SELECT Id FROM perrera.duenios WHERE nombre LIKE :search_value OR apellidos LIKE :search_value OR NIF LIKE :search_value OR correo LIKE :search_value ORDER BY nombre';
    const SEARCH_TAREAS_ASIGNADAS_TABLE = 'SELECT ta.id, ta.asunto, ta.estado_asignacion, ta.prioridad, ta.fecha_asignacion, ta.fecha_finalizacion, j.ubicacion AS ubicacion, j.tamanio AS tamanio, j.ocupada AS ocupada, j.estado_comida AS estado_comida, j.estado_limpieza AS estado_limpieza, e.id AS empleados_id, CONCAT(e.nombre, " ", e.apellidos) AS nombre_empleado, v.id AS voluntarios_id, CONCAT(v.nombre, " ", v.apellidos) AS nombre_voluntario, t.asunto AS tarea_asunto, t.descripcion AS tarea_descripcion FROM tareas_asignadas ta LEFT JOIN jaulas j ON ta.jaulas_id = j.id LEFT JOIN empleados e ON ta.empleados_id = e.id LEFT JOIN voluntarios v ON ta.voluntarios_id = v.id LEFT JOIN tareas t ON ta.tareas_id1 = t.id WHERE ta.asunto LIKE :search_value OR ta.estado_asignacion LIKE :search_value OR ta.prioridad LIKE :search_value OR CONCAT(e.nombre, " ", e.apellidos) LIKE :search_value OR CONCAT(v.nombre, " ", v.apellidos) LIKE :search_value ORDER BY ta.';
    const SEARCH_TAREAS_ASIGNADAS_TABLE_TOTAL_PAGES = 'SELECT ta.id FROM tareas_asignadas ta LEFT JOIN jaulas j ON ta.jaulas_id = j.id LEFT JOIN empleados e ON ta.empleados_id = e.id LEFT JOIN voluntarios v ON ta.voluntarios_id = v.id LEFT JOIN tareas t ON ta.tareas_id1 = t.id WHERE ta.asunto LIKE :search_value OR ta.estado_asignacion LIKE :search_value OR ta.prioridad LIKE :search_value OR CONCAT(e.nombre, " ", e.apellidos) LIKE :search_value OR CONCAT(v.nombre, " ", v.apellidos) LIKE :search_value ORDER BY ta.asunto';
    
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
    const GET_TAREA = 'SELECT * FROM perrera.tareas WHERE id = :id';
    const GET_EMPLEADO = 'SELECT * FROM perrera.empleados WHERE id = :id';
    const GET_EMPLEADOS_INACTIVE = 'SELECT * FROM perrera.empleados INNER JOIN perrera.roles r ON r.id = e.roles_id WHERE e.disponible = 0 AND r.disponible = 1';
    const GET_ESPECIES_INACTIVE = 'SELECT * FROM perrera.especies WHERE disponible = 0';
    const GET_JAULAS_INACTIVE = 'SELECT j.*, e.nombre as nombre_especie FROM perrera.jaulas j INNER JOIN perrera.especies e ON j.especies_id = e.id  WHERE j.disponible = 0 AND e.disponible = 1';
    const GET_VOLUNTARIOS_INACTIVE = 'SELECT * FROM perrera.voluntarios WHERE disponible = 0';
    const GET_ROLES_INACTIVE = 'SELECT * FROM perrera.roles WHERE disponible = 0';
    const GET_DUENIOS_INACTIVE = 'SELECT * FROM perrera.duenios WHERE disponible = 0';
    const GET_VETERINARIOS_INACTIVE = 'SELECT * FROM perrera.veterinarios WHERE disponible = 0';
    const GET_ADOPTANTES_INACTIVE = 'SELECT * FROM perrera.adoptante WHERE disponible = 0';
    const GET_TAREAS_INACTIVE = 'SELECT * FROM perrera.tareas WHERE disponible = 0';
    const GET_ANIMALES_INACTIVE = 'SELECT * FROM perrera.animales a INNER JOIN especies e ON a.especies_id = e.id WHERE a.disponible = 0 AND e.disponible = 1';
    const GET_TAREAS_ASIGNADAS_INACTIVE = 'SELECT * FROM perrera.tareas_asignadas WHERE disponible = 0';
    const GET_ATENCION_VETERINARIA_INACTIVE = 'SELECT aav.*, an.nombre as nombre_animal, j.ubicacion, e.nombre AS nombre_especie, CONCAT(v.nombre, " ", v.apellidos) AS nombre_completo_veterinario FROM perrera.animales_atendidos_veterinarios aav JOIN perrera.animales an ON aav.animales_id = an.id JOIN perrera.especies e ON an.especies_id = e.id JOIN perrera.jaulas j ON an.jaulas_id = j.id JOIN perrera.veterinarios v ON aav.veterinarios_id = v.id WHERE aav.disponible = 0';
    const GET_VOLUNTARIO = 'SELECT * FROM perrera.voluntarios WHERE id = :id';
    const GET_ADOPTANTE = 'SELECT a.*, GROUP_CONCAT(al.id SEPARATOR ",") AS animal_ids, GROUP_CONCAT(al.nombre SEPARATOR ",") AS animal_nombres, GROUP_CONCAT(e.nombre SEPARATOR ",") AS nombre_especies FROM perrera.adoptante a LEFT JOIN animales al ON a.id = al.adoptante_id LEFT JOIN especies e ON al.especies_id = e.id WHERE a.id = :id GROUP BY a.id';
    const GET_JAULA = 'SELECT j.*,  e.nombre AS nombre_especie, GROUP_CONCAT(a.id SEPARATOR ",") AS animal_ids, GROUP_CONCAT(a.nombre SEPARATOR ",") AS animal_nombres, GROUP_CONCAT(a.estado_adopcion SEPARATOR ",") AS animal_estados_adopcion FROM jaulas j JOIN perrera.especies e ON j.especies_id = e.id LEFT JOIN animales a ON j.id = a.jaulas_id WHERE j.id = :id GROUP BY j.id, e.nombre';
    const GET_VETERINARIO = 'SELECT * FROM perrera.veterinarios WHERE id = :id';    
    const GET_USER_TOKEN_PSSWD_SELECT = 'SELECT * FROM perrera.empleados WHERE reset_token_psswd_hash = :reset_token';
    const GET_USER_TOKEN_EMAIL_SELECT = 'SELECT * FROM perrera.empleados WHERE reset_token_email_hash = :reset_token';
    const GET_ROWS_SEARCH = 'SELECT * FROM :name_table WHERE ';
    const GET_ANIMAL = "SELECT a.id, a.nombre, a.especies_id, a.raza, a.genero, a.tamanio, a.peso, a.colores, a.personalidad, a.fech_nac, a.estado_adopcion, a.estado_salud, a.necesidades_especiales, a.otras_observaciones, a.jaulas_id, e.nombre as especie, j.ubicacion as jaula, j.id as jaula_id, GROUP_CONCAT(i.id SEPARATOR ',') as img_ids, GROUP_CONCAT(i.animales_id SEPARATOR ',') as img_id_animals, GROUP_CONCAT(i.ruta SEPARATOR ',') as img_paths, GROUP_CONCAT(i.disponible SEPARATOR ',') as img_actives FROM perrera.animales a JOIN perrera.especies e ON a.especies_id = e.id JOIN perrera.jaulas j ON a.jaulas_id = j.id LEFT JOIN perrera.imgs i ON a.id = i.animales_id WHERE a.id = :id GROUP BY a.id, a.nombre, a.especies_id, a.raza, a.genero, a.tamanio, a.peso, a.colores, a.personalidad, a.fech_nac, a.estado_adopcion, a.estado_salud, a.necesidades_especiales, a.otras_observaciones, a.jaulas_id, e.nombre, j.ubicacion";
    const GET_ANIMAL2 = "SELECT a.id, a.nombre, a.especies_id, a.raza, a.genero, a.tamanio, a.peso, a.colores, a.personalidad, a.fech_nac, a.estado_adopcion, a.estado_salud, a.necesidades_especiales, a.otras_observaciones, a.jaulas_id, e.nombre as especie, j.ubicacion as jaula, j.id as jaula_id FROM perrera.animales a JOIN perrera.especies e ON a.especies_id = e.id JOIN perrera.jaulas j ON a.jaulas_id = j.id WHERE a.id = :id";
    const GET_ANIMAL_MODAL_ADOPTANTE = "SELECT a.id, a.nombre, e.nombre as especie, j.ubicacion as jaula FROM perrera.animales a JOIN perrera.especies e ON a.especies_id = e.id LEFT JOIN perrera.jaulas j ON a.jaulas_id = j.id WHERE a.disponible = 1 AND a.adoptante_id IS NULL AND a.estado_adopcion = 'Disponible para adopcion' ORDER BY a.nombre";
    const GET_ANIMAL_MODAL_DUENIO = "SELECT a.id, a.nombre, e.nombre as especie, j.ubicacion as jaula FROM perrera.animales a JOIN perrera.especies e ON a.especies_id = e.id LEFT JOIN perrera.jaulas j ON a.jaulas_id = j.id WHERE a.disponible = 1 AND a.id NOT IN (SELECT animales_id FROM perrera.historial_animal_duenio WHERE disponible = 1) ORDER BY a.nombre";
    const GET_IMGS_ANIMAL = "SELECT * FROM perrera.imgs WHERE animales_id = :id_animal";
    const GET_DUENIO_MODAL = "SELECT id, nombre, apellidos, NIF, correo FROM perrera.duenios WHERE disponible = 1";
    const GET_DUENIO = 'SELECT d.*, GROUP_CONCAT(a.id SEPARATOR ",") AS animal_ids, GROUP_CONCAT(a.nombre SEPARATOR ",") AS animal_nombres, GROUP_CONCAT(e.nombre SEPARATOR ",") AS nombre_especies, GROUP_CONCAT(ha.fech_registro SEPARATOR ",") AS fechas_registro FROM duenios d LEFT JOIN (SELECT duenios_id, animales_id, fech_registro FROM historial_animal_duenio WHERE disponible = 1) ha ON d.id = ha.duenios_id LEFT JOIN animales a ON ha.animales_id = a.id LEFT JOIN especies e ON a.especies_id = e.id WHERE d.id = :id GROUP BY d.id';
    const GET_ANIMAL_LIST_DUENIO = 'SELECT GROUP_CONCAT(a.id SEPARATOR ",") AS animal_ids, GROUP_CONCAT(a.nombre SEPARATOR ",") AS animal_nombres, GROUP_CONCAT(e.nombre SEPARATOR ",") AS nombre_especies, GROUP_CONCAT(ha.fech_registro SEPARATOR ",") AS fechas_registro FROM historial_animal_duenio ha LEFT JOIN animales a ON ha.animales_id = a.id LEFT JOIN especies e ON a.especies_id = e.id WHERE ha.duenios_id = :id AND ha.disponible = 1';
    const GET_ANIMAL_LIST_ADOPTANTE = 'SELECT GROUP_CONCAT(a.id SEPARATOR ",") AS animal_ids, GROUP_CONCAT(a.nombre SEPARATOR ",") AS animal_nombres, GROUP_CONCAT(e.nombre SEPARATOR ",") AS nombre_especies FROM animales a LEFT JOIN especies e ON a.especies_id = e.id WHERE a.adoptante_id = :adoptante_id AND a.disponible = 1';
    const GET_ANIMAL_LIST_JAULA = 'SELECT GROUP_CONCAT(a.id SEPARATOR ",") AS animal_ids, GROUP_CONCAT(a.nombre SEPARATOR ",") AS animal_nombres, GROUP_CONCAT(e.nombre SEPARATOR ",") AS nombre_especies, j.id AS jaula_id, j.ubicacion AS ubicacion_jaula FROM animales a LEFT JOIN especies e ON a.especies_id = e.id JOIN jaulas j ON a.jaulas_id = j.id WHERE a.disponible = 1 AND a.jaulas_id = :jaulas_id GROUP BY j.id ORDER BY j.id';
    const GET_ADOPTANTE_SELECT = 'SELECT * FROM perrera.adoptante WHERE disponible = 1 ORDER BY nombre';
    const GET_ROL_SELECT = 'SELECT * FROM perrera.roles WHERE disponible = 1 ORDER BY rol';
    const GET_DUENIO_SELECT = 'SELECT * FROM perrera.duenios WHERE disponible = 1 ORDER BY nombre';
    const GET_EMPLEADO_SELECT = 'SELECT * FROM perrera.empleados WHERE disponible = 1 ORDER BY nombre';
    const GET_VOLUNTARIO_SELECT = 'SELECT * FROM perrera.voluntarios WHERE disponible = 1 ORDER BY nombre';
    const GET_TAREA_SELECT = 'SELECT * FROM perrera.tareas WHERE disponible = 1 ORDER BY asunto';
    const GET_VETERINARIO_SELECT = 'SELECT * FROM perrera.veterinarios WHERE disponible = 1 ORDER BY nombre';
    const GET_ANIMAL_SELECT = 'SELECT * FROM perrera.animales WHERE disponible = 1 ORDER BY nombre';
    const GET_JAULA_SELECT = 'SELECT j.*, e.nombre AS nombre_especie FROM perrera.jaulas j INNER JOIN perrera.especies e ON j.especies_id = e.id WHERE j.disponible = 1 ORDER BY j.ubicacion';
    const GET_TAREA_ASIGNADA = 'SELECT ta.id, ta.asunto, es.nombre as nombre_especie, ta.estado_asignacion, ta.prioridad, ta.fecha_asignacion, ta.jaulas_id, ta.fecha_finalizacion, j.ubicacion AS ubicacion, j.tamanio AS tamanio, j.ocupada AS ocupada, j.estado_comida AS estado_comida, j.estado_limpieza AS estado_limpieza, e.id AS empleados_id, CONCAT(e.nombre, " ", e.apellidos) AS nombre_empleado, v.id AS voluntarios_id, CONCAT(v.nombre, " ", v.apellidos) AS nombre_voluntario, t.asunto AS tarea_asunto, t.descripcion AS tarea_descripcion FROM tareas_asignadas ta LEFT JOIN jaulas j ON ta.jaulas_id = j.id LEFT JOIN empleados e ON ta.empleados_id = e.id LEFT JOIN voluntarios v ON ta.voluntarios_id = v.id LEFT JOIN tareas t ON ta.tareas_id1 = t.id LEFT JOIN especies es ON j.especies_id = es.id  WHERE ta.id = :id ';
    const GET_TAREAS_ASIGNADAS = 'SELECT ta.id, es.nombre as nombre_especie, ta.asunto, ta.estado_asignacion, ta.prioridad, ta.fecha_asignacion, ta.jaulas_id, ta.fecha_finalizacion, j.ubicacion AS ubicacion, j.tamanio AS tamanio, j.ocupada AS ocupada, j.estado_comida AS estado_comida, j.estado_limpieza AS estado_limpieza, e.id AS empleados_id, CONCAT(e.nombre, " ", e.apellidos) AS nombre_empleado, v.id AS voluntarios_id, CONCAT(v.nombre, " ", v.apellidos) AS nombre_voluntario, t.asunto AS tarea_asunto, t.descripcion AS tarea_descripcion, es.nombre AS especie_nombre FROM tareas_asignadas ta LEFT JOIN jaulas j ON ta.jaulas_id = j.id LEFT JOIN empleados e ON ta.empleados_id = e.id LEFT JOIN voluntarios v ON ta.voluntarios_id = v.id LEFT JOIN tareas t ON ta.tareas_id1 = t.id LEFT JOIN especies es ON j.especies_id = es.id ORDER BY ta.asunto';
    const GET_ATENCION_VETERINARIA = 'SELECT aav.id, aav.animales_id, aav.veterinarios_id, aav.motivo, aav.fecha_atencion, aav.diagnostico, aav.procedimientos, aav.medicamentos, aav.comentarios, aav.coste, aav.disponible, a.nombre AS nombre_animal, a.especies_id, e.nombre AS nombre_especie, a.tamanio, a.genero, a.peso, v.nombre AS nombre_veterinario, v.apellidos AS apellidos_veterinario, v.correo AS correo_veterinario, v.telf AS telf_veterinario, v.nombre_clinica, v.telf_clinica, v.correo_clinica, j.ubicacion AS ubicacion_jaula FROM animales_atendidos_veterinarios aav LEFT JOIN animales a ON aav.animales_id = a.id LEFT JOIN especies e ON a.especies_id = e.id LEFT JOIN veterinarios v ON aav.veterinarios_id = v.id LEFT JOIN jaulas j ON a.jaulas_id = j.id WHERE aav.id = :id';
    const GET_ATENCIONES_VETERINARIAS = 'SELECT aav.id, aav.animales_id, aav.veterinarios_id, aav.motivo, aav.fecha_atencion, aav.diagnostico, aav.procedimientos, aav.medicamentos, aav.comentarios, aav.coste, aav.disponible, a.nombre AS nombre_animal, a.especies_id, e.nombre AS nombre_especie, a.tamanio, a.genero, a.peso, v.nombre AS nombre_veterinario, v.apellidos AS apellidos_veterinario, v.correo AS correo_veterinario, v.telf AS telf_veterinario, v.nombre_clinica, v.telf_clinica, v.correo_clinica, j.ubicacion AS ubicacion_jaula FROM animales_atendidos_veterinarios aav LEFT JOIN animales a ON aav.animales_id = a.id LEFT JOIN especies e ON a.especies_id = e.id LEFT JOIN veterinarios v ON aav.veterinarios_id = v.id LEFT JOIN jaulas j ON a.jaulas_id = j.id ORDER BY aav.fecha_atencion';
    const SEARCH_ATENCIONES_VETERINARIAS_TABLE = 'SELECT aav.id, aav.animales_id, aav.veterinarios_id, aav.motivo, aav.fecha_atencion, aav.diagnostico, aav.procedimientos, aav.medicamentos, aav.comentarios, aav.coste, aav.disponible, a.nombre AS nombre_animal, a.especies_id, e.nombre AS nombre_especie, a.tamanio, a.genero, a.peso, v.nombre AS nombre_veterinario, v.apellidos AS apellidos_veterinario, v.correo AS correo_veterinario, v.telf AS telf_veterinario, v.nombre_clinica, v.telf_clinica, v.correo_clinica, j.ubicacion AS ubicacion_jaula FROM animales_atendidos_veterinarios aav LEFT JOIN animales a ON aav.animales_id = a.id LEFT JOIN especies e ON a.especies_id = e.id LEFT JOIN veterinarios v ON aav.veterinarios_id = v.id LEFT JOIN jaulas j ON a.jaulas_id = j.id WHERE v.nombre LIKE :search_value OR CONCAT(v.nombre, " ", v.apellidos) LIKE :search_value OR a.nombre LIKE :search_value OR v.telf_clinica LIKE :search_value ORDER BY aav.fecha_atencion';
    const SEARCH_ATENCIONES_VETERINARIAS_TABLE_TOTAL_PAGES = 'SELECT aav.id FROM animales_atendidos_veterinarios aav LEFT JOIN animales a ON aav.animales_id = a.id LEFT JOIN especies e ON a.especies_id = e.id LEFT JOIN veterinarios v ON aav.veterinarios_id = v.id LEFT JOIN jaulas j ON a.jaulas_id = j.id WHERE v.nombre LIKE :search_value OR CONCAT(v.nombre, " ", v.apellidos) LIKE :search_value OR a.nombre LIKE :search_value OR v.telf_clinica LIKE :search_value ORDER BY aav.fecha_atencion';

    // UPDATES
    const UPDT_ESPECIE = 'UPDATE perrera.especies SET nombre = :nombre, descripcion = :descripcion WHERE id = :id';
    const UPDT_ROL = 'UPDATE perrera.roles SET rol = :rol, descripcion = :descripcion WHERE id = :id';
    const UPDT_TAREA = 'UPDATE perrera.tareas SET asunto = :asunto, descripcion = :descripcion WHERE id = :id';
    const UPDT_JAULA = 'UPDATE perrera.jaulas SET ubicacion = :ubicacion, tamanio = :tamanio, ocupada = :ocupada, estado_comida = :estado_comida, estado_limpieza = :estado_limpieza, otros_comentarios = :otros_comentarios, descripcion = :descripcion, especies_id = :especies_id WHERE id = :id';
    const UPDT_VETERINARIO = 'UPDATE veterinarios SET nombre = :nombre, apellidos = :apellidos, correo = :correo, telf = :telf, especialidad = :especialidad, nombre_clinica = :nombre_clinica, direccion_clinica = :direccion_clinica, telf_clinica = :telf_clinica, correo_clinica = :correo_clinica, hora_apertura = :hora_apertura, hora_cierre = :hora_cierre, otra_informacion = :otra_informacion WHERE id = :id;';
    const UPDT_VOLUNTARIO = 'UPDATE voluntarios SET nombre = :nombre, apellidos = :apellidos, fech_nac = :fech_nac, NIF = :NIF, correo = :correo, telf = :telf, disponibilidad = :disponibilidad, experiencia_previa = :experiencia_previa, comentarios = :comentarios, fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin, informacion_relevante = :informacion_relevante WHERE id = :id;';
    const UPDT_ADOPTANTE = 'UPDATE adoptante SET nombre = :nombre, apellidos = :apellidos, fech_nac = :fech_nac, NIF = :NIF, correo = :correo, telf = :telf, direccion = :direccion, ciudad = :ciudad, codigo_postal = :codigo_postal, pais = :pais, ocupacion = :ocupacion, tipo_vivienda = :tipo_vivienda, tiene_jardin = :tiene_jardin, preferencia_adopcion = :preferencia_adopcion, otra_mascota = :otra_mascota, tipo_otra_mascota = :tipo_otra_mascota, estado_solicitud = :estado_solicitud, fecha_solicitud = :fecha_solicitud, comentarios = :comentarios WHERE id = :id';
    const UPDT_DUENIO = 'UPDATE duenios SET nombre = :nombre, apellidos = :apellidos, fech_nac = :fech_nac, NIF = :NIF, correo = :correo, telf = :telf, ocupacion = :ocupacion, direccion = :direccion, ciudad = :ciudad, codigo_postal = :codigo_postal, pais = :pais, permiso_visita = :permiso_visita, fecha_ultima_visita = :fecha_ultima_visita, observaciones = :observaciones WHERE id = :id';
    const UPDT_ANIMAL_DUENIO = 'UPDATE perrera.animales SET adoptante_id = :adoptante_id WHERE id IN ($in)';
    const UPDATE_ASSIGNED_TO_TAREA_ASIGNACION = 'UPDATE perrera.tareas_asignadas SET empleados_id = :empleados_id, voluntarios_id = :voluntarios_id WHERE id = :id';
    const UPDATE_TAREA_ASIGNADA = 'UPDATE nombre_tabla SET asunto = :asunto, estado_asignacion = :estado_asignacion, prioridad = :prioridad, fecha_asignacion = :fecha_asignacion, fecha_finalizacion = :fecha_finalizacion, tareas_id1 = :tareas_id1, empleados_id = :empleados_id, voluntarios_id = :voluntarios_id, jaulas_id = :jaulas_id WHERE id = :id';
    const UPDATE_ATENCION_VETERINARIA = 'UPDATE animales_atendidos_veterinarios SET motivo = :motivo, fecha_atencion = :fecha_atencion, diagnostico = :diagnostico, procedimientos = :procedimientos, medicamentos = :medicamentos, comentarios = :comentarios, coste = :coste WHERE id = :id';
    const UPDATE_JAULA_STATUS = 'UPDATE jaulas SET ocupada = 0 WHERE id = :id';

    //  DELETES
    const DELETE_ESPECIE = 'UPDATE perrera.especies SET disponible = 0 WHERE id = :id';
    const DELETE_ROL = 'UPDATE perrera.roles SET disponible = 0 WHERE id = :id';
    const DELETE_JAULA = 'UPDATE perrera.jaulas SET disponible = 0 WHERE id = :id';
    const DELETE_VETERINARIO = 'UPDATE perrera.veterinarios SET disponible = 0 WHERE id = :id';
    const DELETE_VOLUNTARIO = 'UPDATE perrera.voluntarios SET disponible = 0 WHERE id = :id';
    const DELETE_EMPLEADO = 'UPDATE perrera.empleados SET disponible = 0 WHERE id = :id';
    const DELETE_DUENIO = 'UPDATE perrera.duenios SET disponible = 0 WHERE id = :id';
    const DELETE_DUENIO_HISTORIAL_DUENIO = 'UPDATE perrera.historial_animal_duenio SET disponible = 0, fech_finalizacion = NOW(), estado_actual = "Terminado" WHERE duenios_id = :duenios_id';
    const DELETE_TAREA = 'UPDATE perrera.tareas SET disponible = 0 WHERE id = :id';
    const DELETE_TAREA_ASIGNADA = 'UPDATE perrera.tareas_asignadas SET disponible = 0 WHERE id = :id';
    const DELETE_ATENCION_VETERINARIA = 'UPDATE perrera.animales_atendidos_veterinarios SET disponible = 0 WHERE id = :id';
    const DELETE_ADOPTANTE = 'UPDATE perrera.adoptante SET disponible = 0 WHERE id = :id';
    const DELETE_IMG_QUERY = 'DELETE FROM perrera.imgs WHERE Id = :id';
    const DELETE_IMGS_ANIMAL_QUERY = 'DELETE FROM perrera.imgs WHERE animales_id = :id';
    const DELETE_ANIMAL_DUENIO = 'UPDATE historial_animal_duenio SET fech_finalizacion = NOW(), estado_actual = "Terminado", disponible = 0 WHERE duenios_id = :id AND animales_id = :animal_id';
    const DELETE_ANIMAL_ADOPTANTE = 'UPDATE animales SET adoptante_id = NULL, estado_adopcion = :estado_adopcion WHERE id = :id';
    const DELETE_ANIMAL_JAULA = 'UPDATE animales SET jaulas_id = NULL WHERE id = :id';
    const DELETE_ADOPTANTE_ANIMALS = 'UPDATE animales SET adoptante_id = NULL, estado_adopcion = "Disponible para adopcion" WHERE adoptante_id = :id';


    const FIND_NIF_ADOPTANTE = 'SELECT Id FROM perrera.adoptante WHERE NIF = :NIF';
    const FIND_NIF_ADOPTANTE_UPD = 'SELECT EXISTS (SELECT 1 FROM perrera.adoptante WHERE NIF = :NIF AND id <> :id) AS resultado';
    const FIND_NIF_VOLUNTARIO_UPD = 'SELECT EXISTS (SELECT 1 FROM perrera.voluntarios WHERE NIF = :NIF AND id <> :id) AS resultado';
    const FIND_NIF_DUENIO = 'SELECT Id FROM perrera.duenios WHERE NIF = :NIF';
    const FIND_NIF_VOLUNTARIO = 'SELECT Id FROM perrera.voluntarios WHERE NIF = :NIF';
    const FIND_EMAIL_VETERINARIO = 'SELECT Id FROM perrera.veterinarios WHERE correo = :correo';
    const FIND_EMAIL_VETERINARIO_UPD = 'SELECT CASE WHEN EXISTS (SELECT 1 FROM perrera.veterinarios WHERE correo = :correo AND id <> :id) THEN true ELSE false END AS resultado';


    // SOFT-DELETE DE ESPECIES
    const SOFT_DEL_ESPECIE_ESPECIE = 'UPDATE perrera.especies SET disponible = 0 WHERE id = :id';
    const SOFT_DEL_ESPECIE_JAULA = 'UPDATE perrera.jaulas SET disponible = 0 WHERE especies_id = :id';
    const SOFT_DEL_ESPECIE_ANIMAL = 'UPDATE perrera.animales SET disponible = 0, adoptante_id = NULL, jaulas_id = NULL WHERE especies_id = :id';
    const SOFT_DEL_ESPECIE_ASISTENCIA_VETERINARIA = 'UPDATE perrera.animales_atendidos_veterinarios SET disponible = 0 WHERE animales_id IN (SELECT id FROM perrera.animales WHERE especies_id = :id)';
    const SOFT_DEL_ESPECIE_IMGS = 'UPDATE perrera.imgs SET disponible = 0 WHERE animales_id IN (SELECT id FROM perrera.animales WHERE especies_id = :id)';
    const SOFT_DEL_ESPECIE_ANIMALES_CON_DUENIO = 'UPDATE perrera.historial_animal_duenio SET disponible = 0 WHERE animales_id IN (SELECT id FROM perrera.animales WHERE especies_id = :id)';
    const SOFT_DEL_ESPECIE_TAREAS_ASIGNADAS = 'UPDATE perrera.tareas_asignadas SET disponible = 0 WHERE jaulas_id IN (SELECT id FROM perrera.jaulas WHERE especies_id = :id)';
    
    const SOFT_UNDEL_ESPECIE_ESPECIE = 'UPDATE perrera.especies SET disponible = 1 WHERE id = :id';
    const SOFT_UNDEL_ESPECIE_JAULA = 'UPDATE perrera.jaulas SET disponible = 1 WHERE especies_id = :id';
    const SOFT_UNDEL_ESPECIE_ANIMAL = 'UPDATE perrera.animales SET disponible = 0, adoptante_id = NULL, jaulas_id = NULL WHERE especies_id = :id';
    const SOFT_UNDEL_ESPECIE_ASISTENCIA_VETERINARIA = 'UPDATE perrera.animales_atendidos_veterinarios SET disponible = 0 WHERE animales_id IN (SELECT id FROM perrera.animales WHERE especies_id = :id)';
    
    const SOFT_DEL_VETERINARIO_VETERINARIO = 'UPDATE perrera.veterinarios SET disponible = 0 WHERE id = :id';
    const SOFT_DEL_VETERINARIO_ASISTENCIA = 'UPDATE perrera.animales_atendidos_veterinarios SET disponible = 0 WHERE veterinarios_id = :id';
    const UNDEL_VETERINARIO_VETERINARIO = 'UPDATE perrera.veterinarios SET disponible = 1 WHERE id = :id';
    const UNDEL_VETERINARIO_ASISTENCIA = 'UPDATE perrera.animales_atendidos_veterinarios aav INNER JOIN perrera.animales a ON aav.animales_id = a.id SET aav.disponible = 1 WHERE aav.veterinarios_id = :id AND a.disponible = 1';

    const SOFT_DEL_VOLUNTARIO_VOLUNTARIO = 'UPDATE perrera.voluntarios SET disponible = 0 WHERE id = :id';
    const SOFT_DEL_VOLUNTARIO_TAREAS_ASIGNADAS = 'UPDATE perrera.tareas_asignadas SET disponible = 0 WHERE voluntarios_id = :id';
    const UNDEL_VOLUNTARIO_VOLUNTARIO = 'UPDATE perrera.voluntarios SET disponible = 1 WHERE id = :id';
    const UNDEL_VOLUNTARIO_TAREA_ASIGNADA = 'UPDATE perrera.tareas_asignadas ta LEFT JOIN perrera.jaulas j ON ta.jaulas_id = j.id INNER JOIN perrera.tareas t ON ta.tareas_id1 = t.id SET ta.disponible = 1 WHERE ta.voluntarios_id = :id AND (ta.jaulas_id IS NULL OR j.disponible = 1) AND t.disponible = 1';


    const SOFT_DEL_TAREA_TAREA = 'UPDATE perrera.tareas SET disponible = 0 WHERE id = :id';
    const SOFT_DEL_TAREAS_TAREAS_ASIGNADAS = 'UPDATE perrera.tareas_asignadas SET disponible = 0 WHERE tareas_id = :id';
    const UNDEL_TAREAS_TAREAS = 'UPDATE perrera.tareas SET disponible = 1 WHERE id = :id';
    const UNDEL_TAREAS_TAREA_ASIGNADA = 'UPDATE perrera.tareas_asignadas ta LEFT JOIN perrera.jaulas j ON ta.jaulas_id = j.id AND j.disponible = 1 LEFT JOIN perrera.empleados e ON ta.empleados_id = e.id AND e.disponible = 1 LEFT JOIN perrera.voluntarios v ON ta.voluntarios_id = v.id AND v.disponible = 1 SET ta.disponible = 1 WHERE ta.tareas_id = :id AND (ta.jaulas_id IS NULL OR j.disponible = 1) AND ((ta.empleados_id IS NOT NULL AND e.disponible = 1 AND ta.voluntarios_id IS NULL) OR (ta.voluntarios_id IS NOT NULL AND v.disponible = 1 AND ta.empleados_id IS NULL))';


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
    const VIEW_TAREA = '../views/V_TareasVer.php';
    const VIEW_TAREAS_ASIGNADAS = '../views/V_TareasAsignadas.php';
    const VIEW_TAREA_ASIGNADA = '../views/V_TareasAsignadasVer.php';
    const VIEW_ATENCION_VETERINARIA = '../views/V_AtencionVeterinariaVer.php';
    const VIEW_EMPLEADO = '../views/V_EmpleadoVer.php';

    // CONTROLLERS
    const CONTROLLER_SETTINGS = 'http://localhost/DES/perrera-ec2/app/controllers/SettingsC.php';
    const CONTROLLER_LOGIN = 'http://localhost/DES/perrera-ec2/app/controllers/LoginC.php';
    const CONTROLLER_EMPLOYEE = 'http://localhost/DES/perrera-ec2/app/controllers/EmpleadoC.php';

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
    const ERROR_SEND_MSG_WELCOME = 'No se ha podido enviar el correo de bienvenida. Comunique al empleado su clave.';
    const ERROR_ADD_IMG = 'No se han podido añadir las imágenes.';
    const ERROR_FIELDS_EMPLOYEE = 'No se ha podido insertar el empleado. Por favor, inténtelo de nuevo.';
    const ERROR_EXIST_EMPLOYEE = 'Ya existe un empleado con este correo.';
    const ERROR_EXIST_EMPLOYEE_INACTIVE = 'Existe un empleado inactivo con este correo. Utilice otro correo o contacte con un empleado para reactivar la cuenta';
    const ERROR_ROW_NOT_FOUND = 'Registro no encontrado.';
    const ERROR_ROW_NOT_INACTIVE = 'El registro no está inactivo, por lo que no se puede recuperar.';
    const ERROR_TAREA_EMPLEADO_VOLUNTARIO = 'Debes seleccionar o un voluntario o un empleado para realizar la tarea.';
    const ERROR_DONT_EXIST_EMPLOYEE = 'No se ha encontrado el empleado en la bd';
    const ERROR_DONT_EXIST_VOLUNTEER = 'No se ha encontrado el voluntario en la bd';
    const ERROR_DONT_EXIST_CAGE = 'No se ha encontrado la jaula en la bd';
    const ERROR_NIF = 'Existe un registro con este NIF en la base de datos';
    const ERROR_EMAIL_EXIST = 'Existe un registro con este correo en la base de datos';

    // MSGs
    const ADD_IMG_SUCCESS = 'La/s imagen/es han sido añadidas con éxito.';
    const ADD_IMG_ERROR = 'No se han podido insertar las imágenes.';


    // OK
    const PSSWD_CHANGED = 'Contraseña modificada con éxito.';
    const DELETE_ROW = 'Registro borrado con éxito.';
    const UNDELETE_ROW = 'Registro recuperado con éxito.';

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