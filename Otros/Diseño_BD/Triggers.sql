
use perrera;

SHOW TRIGGERS;

/*



						TRIGGERS PARA INCREMENTAR EL ID EN UNO DEPENDIENDO DE LA CANTIDAD DE ELEMENTOS QUE HAYA EN LA TABLA



*/

/*TRIGGER QUE SALTA ANTES DE LA INSERCIÓN DE UN NUEVO ANIMAL*/
/*
	Este trigger comprobará si una jaula tiene aún espacio disponible para meter a otro animal dentro.
    En caso de que haya espacio, se insertará sin problemas. Sin embargo cuando la cantidad de animales
    asociados a la jaula sea igual que el tamaño máximo de la jaula, el campo ocupada de la jaula pasará 
    a valer 1, lo que indica que está completa.
*/
DROP TRIGGER IF EXISTS update_jail_status;
DELIMITER $$
CREATE TRIGGER update_jail_status
BEFORE INSERT ON animales
FOR EACH ROW
BEGIN
    DECLARE total_animales_jaulas INT;
    DECLARE tamanio_jaula INT;

    -- Obtener el tamaño máximo de la jaula
    SELECT tamanio INTO tamanio_jaula FROM jaulas WHERE id = NEW.jaulas_id;

    -- Contar cuántos animales hay en la jaula
    SELECT COUNT(*) INTO total_animales_jaulas FROM animales WHERE jaulas_id = NEW.jaulas_id;

    -- Verificar si la jaula está ocupada
    IF EXISTS (SELECT 1 FROM jaulas WHERE id = NEW.jaulas_id AND ocupada = 1) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'La jaula está ocupada, no se pueden insertar más animales';
    ELSE
        -- Verificar si la jaula ya alcanzó su capacidad máxima
        IF (total_animales_jaulas >= tamanio_jaula) THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No hay espacio disponible en esta jaula';
        ELSE
            -- Si no está ocupada y hay espacio disponible, actualizar ocupada a 1 si se alcanza la capacidad
            IF (total_animales_jaulas + 1 >= tamanio_jaula) THEN
                UPDATE jaulas SET ocupada = 1 WHERE id = NEW.jaulas_id;
            END IF;
        END IF;
    END IF;

END$$
DELIMITER ;


DROP TRIGGER IF EXISTS validate_jaulas_id;
DELIMITER $$
CREATE TRIGGER validate_jaulas_id
BEFORE INSERT ON animales
FOR EACH ROW
BEGIN
    -- Verificar si jaulas_id es diferente de NULL
    IF NEW.jaulas_id IS NOT NULL THEN
        -- Verificar si el jaulas_id existe en la tabla jaulas
        IF NOT EXISTS (SELECT 1 FROM jaulas WHERE id = NEW.jaulas_id) THEN
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El jaulas_id especificado no existe en la tabla jaulas';
        END IF;
    END IF;
END$$
DELIMITER ;



DROP TRIGGER IF EXISTS update_jail_status_after_delete;
DELIMITER $$
CREATE TRIGGER update_jail_status_after_delete
AFTER DELETE ON animales
FOR EACH ROW
BEGIN
	UPDATE jaulas 
		SET ocupada = 0 
			WHERE id = OLD.jaulas_id AND tamanio > (SELECT COUNT(*) FROM animales WHERE jaulas_id = OLD.jaulas_id);
END$$
DELIMITER ;
