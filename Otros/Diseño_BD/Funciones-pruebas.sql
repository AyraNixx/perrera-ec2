DELIMITER //

DROP FUNCTION IF EXISTS add_id;
CREATE FUNCTION add_id( tabla VARCHAR(100))
RETURNS INT

BEGIN

   DECLARE new_id INT;

   SELECT IFNULL(MAX(id) + 1, 1) INTO new_id FROM tabla;
   RETURN new_id;

END; //

DELIMITER ;


use perrera;

SET @id_rol = add_id('perrera');

INSERT INTO roles (id, rol) VALUES(@id_rol, 'prueba');


/*SET @id = IFNULL((SELECT MAX(id) + 1 FROM voluntarios), 1);*/