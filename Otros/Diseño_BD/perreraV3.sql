-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';


-- -----------------------------------------------------
-- Schema perrera
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `perrera` ;

-- -----------------------------------------------------
-- Schema perrera
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `perrera` DEFAULT CHARACTER SET utf8 ;
USE `perrera` ;

-- -----------------------------------------------------
-- Table `perrera`.`voluntarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `perrera`.`voluntarios` ;

CREATE TABLE IF NOT EXISTS `perrera`.`voluntarios` (
  `id` VARCHAR(22) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `apellidos` VARCHAR(45) NOT NULL,
  `fech_nac` DATE NOT NULL,
  `NIF` VARCHAR(45) NOT NULL,
  `correo` VARCHAR(150) NOT NULL,
  `telf` VARCHAR(15) NOT NULL,
  `disponibilidad` TINYINT(4) NOT NULL,
  `fecha_inicio` DATE NOT NULL,
  `fecha_fin` DATE NOT NULL,
  `experiencia_previa` TINYINT(4) NOT NULL,
  `comentarios` TEXT NOT NULL,
  `informacion_relevante` TEXT NOT NULL,
  `disponible` TINYINT(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `NIF_UNIQUE` (`NIF` ASC) )
ENGINE = InnoDB;

USE `perrera` ;

-- -----------------------------------------------------
-- Table `perrera`.`adoptante`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `perrera`.`adoptante` ;

CREATE TABLE IF NOT EXISTS `perrera`.`adoptante` (
  `id` VARCHAR(22) NOT NULL,
  `nombre` VARCHAR(100) NOT NULL DEFAULT 'No especificado',
  `apellidos` VARCHAR(120) NOT NULL DEFAULT 'No especificado',
  `fech_nac` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `NIF` VARCHAR(15) NOT NULL DEFAULT 'No especificado',
  `correo` VARCHAR(150) NOT NULL DEFAULT 'No especificado',
  `telf` VARCHAR(15) NOT NULL DEFAULT 'No especificado',
  `direccion` VARCHAR(255) NOT NULL DEFAULT 'No especificado',
  `ciudad` VARCHAR(255) NOT NULL,
  `codigo_postal` VARCHAR(45) NOT NULL,
  `pais` VARCHAR(255) NOT NULL,
  `ocupacion` VARCHAR(255) NOT NULL,
  `tipo_vivienda` VARCHAR(255) NOT NULL,
  `tiene_jardin` TINYINT(4) NOT NULL DEFAULT 0,
  `preferencia_adopcion` TINYINT(4) NOT NULL DEFAULT 0,
  `otra_mascota` TINYINT(4) NOT NULL DEFAULT 0,
  `tipo_otra_mascota` VARCHAR(45) NULL,
  `estado_solicitud` VARCHAR(255) NOT NULL DEFAULT 1,
  `fecha_solicitud` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `comentarios` TEXT NULL,
  `disponible` TINYINT(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `NIF_UNIQUE` (`NIF` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `perrera`.`especies`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `perrera`.`especies` ;

CREATE TABLE IF NOT EXISTS `perrera`.`especies` (
  `id` VARCHAR(22) NOT NULL DEFAULT '1',
  `nombre` VARCHAR(45) NOT NULL DEFAULT 'No especificado',
  `descripcion` VARCHAR(100) NOT NULL DEFAULT '-',
  `disponible` TINYINT(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `idespecies_UNIQUE` (`id` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `perrera`.`jaulas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `perrera`.`jaulas` ;

CREATE TABLE IF NOT EXISTS `perrera`.`jaulas` (
  `id` VARCHAR(22) NOT NULL,
  `ubicacion` VARCHAR(100) NOT NULL DEFAULT 'A-00',
  `tamanio` INT(11) NOT NULL DEFAULT 0,
  `ocupada` TINYINT(4) NOT NULL DEFAULT 0,
  `estado_comida` TINYINT(4) NOT NULL DEFAULT 0,
  `estado_limpieza` TINYINT(4) NOT NULL DEFAULT 0,
  `descripcion` VARCHAR(254) NULL DEFAULT NULL,
  `otros_comentarios` TEXT NULL DEFAULT NULL,
  `especies_id` VARCHAR(22) NOT NULL,
  `disponible` TINYINT(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`, `especies_id`),
  INDEX `fk_jaulas_especies1_idx` (`especies_id` ASC) ,
  CONSTRAINT `fk_jaulas_especies1`
    FOREIGN KEY (`especies_id`)
    REFERENCES `perrera`.`especies` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `perrera`.`animales`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `perrera`.`animales` ;

CREATE TABLE IF NOT EXISTS `perrera`.`animales` (
  `id` VARCHAR(22) NOT NULL,
  `nombre` VARCHAR(100) NOT NULL DEFAULT '-',
  `especies_id` VARCHAR(22) NOT NULL,
  `raza` VARCHAR(30) NOT NULL DEFAULT 'No especificada',
  `genero` CHAR(1) NOT NULL DEFAULT 'M',
  `tamanio` VARCHAR(20) NOT NULL DEFAULT '-',
  `peso` DECIMAL(5,2) NOT NULL DEFAULT 0.00,
  `colores` VARCHAR(100) NOT NULL DEFAULT 'No especificado',
  `personalidad` VARCHAR(45) NOT NULL DEFAULT '-',
  `fech_nac` DATE NOT NULL DEFAULT '1800-01-01',
  `estado_adopcion` VARCHAR(50) NOT NULL DEFAULT 'Disponible',
  `fecha_adopcion` TIMESTAMP NULL,
  `estado_salud` VARCHAR(50) NOT NULL DEFAULT 'Bien',
  `necesidades_especiales` CHAR(2) NOT NULL DEFAULT 'NO',
  `otras_observaciones` VARCHAR(255) NOT NULL DEFAULT '-',
  `jaulas_id` VARCHAR(22) NOT NULL,
  `disponible` TINYINT(4) NOT NULL DEFAULT 1,
  `adoptante_id` VARCHAR(22) NULL,
  PRIMARY KEY (`id`, `especies_id`, `jaulas_id`),
  INDEX `fk_animales_jaulas1_idx` (`jaulas_id` ASC) ,
  INDEX `fk_animales_especies1_idx` (`especies_id` ASC) ,
  INDEX `fk_animales_adoptante1_idx` (`adoptante_id` ASC) ,
  CONSTRAINT `fk_animales_especies1`
    FOREIGN KEY (`especies_id`)
    REFERENCES `perrera`.`especies` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_animales_jaulas1`
    FOREIGN KEY (`jaulas_id`)
    REFERENCES `perrera`.`jaulas` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_animales_adoptante1`
    FOREIGN KEY (`adoptante_id`)
    REFERENCES `perrera`.`adoptante` (`id`)
	ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `perrera`.`veterinarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `perrera`.`veterinarios` ;

CREATE TABLE IF NOT EXISTS `perrera`.`veterinarios` (
  `id` VARCHAR(22) NOT NULL,
  `nombre` VARCHAR(100) NOT NULL DEFAULT 'No especificado',
  `apellidos` VARCHAR(120) NOT NULL DEFAULT 'No especificado',
  `correo` VARCHAR(150) NOT NULL DEFAULT 'No especificado',
  `telf` VARCHAR(15) NOT NULL DEFAULT 'No especificado',
  `especialidad` VARCHAR(45) NOT NULL,
  `nombre_clinica` VARCHAR(255) NOT NULL,
  `direccion_clinica` VARCHAR(255) NOT NULL,
  `telf_clinica` VARCHAR(15) NOT NULL,
  `correo_clinica` VARCHAR(150) NOT NULL,
  `hora_apertura` TIME NOT NULL,
  `hora_cierre` TIME NOT NULL,
  `otra_informacion` VARCHAR(255) NULL DEFAULT NULL,
  `disponible` TINYINT(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `perrera`.`animales_atendidos_veterinarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `perrera`.`animales_atendidos_veterinarios`;

CREATE TABLE IF NOT EXISTS `perrera`.`animales_atendidos_veterinarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `animales_id` VARCHAR(22) NOT NULL,
  `veterinarios_id` VARCHAR(22) NOT NULL,
  `motivo` TEXT NOT NULL DEFAULT 'No especificado',
  `fecha_atencion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `diagnostico` TEXT NOT NULL DEFAULT 'No especificado',
  `procedimientos` VARCHAR(200) NOT NULL DEFAULT 'No especificado',
  `medicamentos` VARCHAR(200) NOT NULL DEFAULT 'No especificado',
  `comentarios` TEXT NULL DEFAULT NULL,
  `coste` DECIMAL(7,2) NOT NULL DEFAULT 0.00,
  `disponible` TINYINT(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  INDEX `fk_animales_has_veterinarios_veterinarios1_idx` (`veterinarios_id` ASC),
  INDEX `fk_animales_has_veterinarios_animales1_idx` (`animales_id` ASC),
  CONSTRAINT `fk_animales_has_veterinarios_animales1`
    FOREIGN KEY (`animales_id`)
    REFERENCES `perrera`.`animales` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_animales_has_veterinarios_veterinarios1`
    FOREIGN KEY (`veterinarios_id`)
    REFERENCES `perrera`.`veterinarios` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `perrera`.`duenios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `perrera`.`duenios` ;

CREATE TABLE IF NOT EXISTS `perrera`.`duenios` (
  `id` VARCHAR(22) NOT NULL,
  `nombre` VARCHAR(100) NOT NULL DEFAULT 'No especificado',
  `apellidos` VARCHAR(120) NOT NULL DEFAULT 'No especificado',
  `fech_nac` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `NIF` VARCHAR(15) NOT NULL DEFAULT 'No especificado',
  `correo` VARCHAR(150) NOT NULL DEFAULT 'No especificado',
  `telf` VARCHAR(15) NOT NULL DEFAULT 'No especificado',
  `ocupacion` VARCHAR(255) NOT NULL,
  `direccion` VARCHAR(255) NOT NULL DEFAULT 'No especificado',
  `ciudad` VARCHAR(255) NOT NULL,
  `codigo_postal` VARCHAR(45) NOT NULL,
  `pais` VARCHAR(255) NOT NULL,
  `permiso_visita` TINYINT(4) NOT NULL DEFAULT 1,
  `fecha_ultima_visita` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `observaciones` TEXT NULL,
  `disponible` TINYINT(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `NIF_UNIQUE` (`NIF` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `perrera`.`roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `perrera`.`roles` ;

CREATE TABLE IF NOT EXISTS `perrera`.`roles` (
  `id` VARCHAR(22) NOT NULL,
  `rol` VARCHAR(45) NOT NULL DEFAULT 'admin',
  `descripcion` VARCHAR(150) NOT NULL DEFAULT '-',
  `disponible` TINYINT(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `perrera`.`empleados`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `perrera`.`empleados` ;

CREATE TABLE IF NOT EXISTS `perrera`.`empleados` (
  `id` VARCHAR(22) NOT NULL,
  `nombre` VARCHAR(100) NOT NULL DEFAULT 'No especificado',
  `apellidos` VARCHAR(120) NOT NULL DEFAULT 'No especificado',
  `NIF` VARCHAR(15) NOT NULL DEFAULT 'No especificado',
  `fech_nac` DATE NULL,
  `direccion` VARCHAR(255) NOT NULL,
  `ciudad` VARCHAR(255) NOT NULL,
  `pais` VARCHAR(255) NOT NULL,
  `codigo_postal` VARCHAR(45) NOT NULL,
  `telf` VARCHAR(15) NOT NULL DEFAULT 'No especificado',
  `correo` VARCHAR(150) NOT NULL DEFAULT 'No especificado',
  `passwd` VARCHAR(255) NULL,
  `code` VARCHAR(255) NULL,
  `reset_token_psswd_hash` VARCHAR(255) NULL,
  `t_reset_token_psswd_expires_at` DATETIME NULL,
  `reset_token_email_hash` VARCHAR(255) NULL,
  `t_reset_token_email_expires_at` DATETIME NULL,
  `roles_id` VARCHAR(22) NOT NULL,
  `disponible` TINYINT(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`, `roles_id`),
  UNIQUE INDEX `correo_UNIQUE` (`correo` ASC) ,
  INDEX `fk_empleados_roles1_idx` (`roles_id` ASC) ,
  CONSTRAINT `fk_empleados_roles1`
    FOREIGN KEY (`roles_id`)
    REFERENCES `perrera`.`roles` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `perrera`.`encargados_animales`
-- -----------------------------------------------------
-- DROP TABLE IF EXISTS `perrera`.`encargados_animales` ;

-- CREATE TABLE IF NOT EXISTS `perrera`.`encargados_animales` (
--   `animales_id` VARCHAR(22) NOT NULL,
--   `empleados_id` VARCHAR(22) NOT NULL,
  -- `fecha_asignacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  -- `fecha_desasignacion` TIMESTAMP NULL DEFAULT NULL,
  -- `disponible` TINYINT(4) NOT NULL DEFAULT 1,
  -- PRIMARY KEY (`animales_id`, `empleados_id`),
  -- INDEX `fk_encargados_animales_empleados1_idx` (`empleados_id` ASC) ,
  -- CONSTRAINT `fk_encargados_animales_animales1`
    -- FOREIGN KEY (`animales_id`)
    -- REFERENCES `perrera`.`animales` (`id`)
    -- ON DELETE CASCADE
    -- ON UPDATE CASCADE,
  -- CONSTRAINT `fk_encargados_animales_empleados1`
    -- FOREIGN KEY (`empleados_id`)
    -- REFERENCES `perrera`.`empleados` (`id`)
    -- ON DELETE CASCADE
    -- ON UPDATE CASCADE)
-- ENGINE = InnoDB
-- DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `perrera`.`imgs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `perrera`.`imgs` ;

CREATE TABLE IF NOT EXISTS `perrera`.`imgs` (
  `id` VARCHAR(22) NULL,
  `ruta` TEXT NOT NULL,
  `nombre` VARCHAR(255) NOT NULL,
  `tipo` VARCHAR(255) NOT NULL,
  `tamanio` VARCHAR(255) NOT NULL,
  `disponible` TINYINT(4) NOT NULL DEFAULT 1,
  `animales_id` VARCHAR(22) NULL,
  `empleados_id` VARCHAR(22) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_imgs_animales1_idx` (`animales_id` ASC) ,
  INDEX `fk_imgs_empleados1_idx` (`empleados_id` ASC) ,
  CONSTRAINT `fk_imgs_animales1`
    FOREIGN KEY (`animales_id`)
    REFERENCES `perrera`.`animales` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_imgs_empleados1`
    FOREIGN KEY (`empleados_id`)
    REFERENCES `perrera`.`empleados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `perrera`.`tareas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `perrera`.`tareas` ;

CREATE TABLE IF NOT EXISTS `perrera`.`tareas` (
  `id` VARCHAR(22) NOT NULL,
  `asunto` VARCHAR(100) NOT NULL DEFAULT 'No especificado',
  `descripcion` VARCHAR(100) NOT NULL,
  `disponible` TINYINT(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `perrera`.`tareas_asignadas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `perrera`.`tareas_asignadas`;

CREATE TABLE IF NOT EXISTS `perrera`.`tareas_asignadas` (
  `id` VARCHAR(225) NOT NULL,
  `asunto` VARCHAR(225) NOT NULL,
  `estado_asignacion` VARCHAR(255) NOT NULL DEFAULT 'Iniciada',
  `prioridad` VARCHAR(225) NOT NULL,
  `fecha_asignacion` TIMESTAMP NULL DEFAULT NULL,
  `fecha_finalizacion` TIMESTAMP NULL DEFAULT NULL,
  `jaulas_id` VARCHAR(22) NULL DEFAULT NULL,
  `empleados_id` VARCHAR(22) NULL DEFAULT NULL,
  `tareas_id1` VARCHAR(22) NOT NULL,
  `voluntarios_id` VARCHAR(22) NULL DEFAULT NULL,
  `disponible` TINYINT(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  INDEX `fk_tareas_asignadas_jaulas1_idx` (`jaulas_id` ASC),
  INDEX `fk_tareas_asignadas_empleados1_idx` (`empleados_id` ASC),
  INDEX `fk_tareas_asignadas_tareas2_idx` (`tareas_id1` ASC),
  INDEX `fk_tareas_asignadas_voluntarios1_idx` (`voluntarios_id` ASC),
  CONSTRAINT `fk_tareas_asignadas_jaulas1`
    FOREIGN KEY (`jaulas_id`)
    REFERENCES `perrera`.`jaulas` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tareas_asignadas_empleados1`
    FOREIGN KEY (`empleados_id`)
    REFERENCES `perrera`.`empleados` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tareas_asignadas_tareas2`
    FOREIGN KEY (`tareas_id1`)
    REFERENCES `perrera`.`tareas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tareas_asignadas_voluntarios1`
    FOREIGN KEY (`voluntarios_id`)
    REFERENCES `perrera`.`voluntarios` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION
) ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `perrera`.`historial_animal_duenio`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `perrera`.`historial_animal_duenio` ;

CREATE TABLE IF NOT EXISTS `perrera`.`historial_animal_duenio` (
  `duenios_id` VARCHAR(22) NOT NULL,
  `animales_id` VARCHAR(22) NOT NULL,
  `fech_registro` DATE NOT NULL,
  `fech_finalizacion` TIMESTAMP,
  `estado_actual` VARCHAR(255) NOT NULL DEFAULT 1,
  `disponible` TINYINT(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`duenios_id`, `animales_id`),
  INDEX `fk_duenios_has_animales_animales1_idx` (`animales_id` ASC) ,
  INDEX `fk_duenios_has_animales_duenios1_idx` (`duenios_id` ASC) ,
  CONSTRAINT `fk_duenios_has_animales_duenios1`
    FOREIGN KEY (`duenios_id`)
    REFERENCES `perrera`.`duenios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_duenios_has_animales_animales1`
    FOREIGN KEY (`animales_id`)
    REFERENCES `perrera`.`animales` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

USE `perrera`;

DELIMITER $$

USE `perrera`$$
DROP TRIGGER IF EXISTS `perrera`.`voluntarios_BEFORE_INSERT` $$
USE `perrera`$$
CREATE DEFINER=`root`@`localhost` TRIGGER `perrera`.`voluntarios_BEFORE_INSERT` BEFORE INSERT ON `voluntarios` FOR EACH ROW
BEGIN
	SET NEW.id = CONCAT('006', UUID_SHORT());
END$$


DELIMITER ;
USE `perrera`;

DELIMITER $$

USE `perrera`$$
DROP TRIGGER IF EXISTS `perrera`.`adoptante_add_id` $$
USE `perrera`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `perrera`.`adoptante_add_id`
BEFORE INSERT ON `perrera`.`adoptante`
FOR EACH ROW
BEGIN
	SET NEW.id = CONCAT('004', UUID_SHORT());
END$$


USE `perrera`$$
DROP TRIGGER IF EXISTS `perrera`.`especies_BEFORE_INSERT` $$
USE `perrera`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `perrera`.`especies_BEFORE_INSERT`
BEFORE INSERT ON `perrera`.`especies`
FOR EACH ROW
BEGIN
	IF (NEW.id = '1') THEN
		SET NEW.id = CONCAT('00B', UUID_SHORT());
    END IF;
END$$


USE `perrera`$$
DROP TRIGGER IF EXISTS `perrera`.`jaulas_add_id` $$
USE `perrera`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `perrera`.`jaulas_add_id`
BEFORE INSERT ON `perrera`.`jaulas`
FOR EACH ROW
BEGIN
	SET NEW.id = CONCAT('00J', UUID_SHORT());
END$$


USE `perrera`$$
DROP TRIGGER IF EXISTS `perrera`.`animales_add_id` $$
USE `perrera`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `perrera`.`animales_add_id`
BEFORE INSERT ON `perrera`.`animales`
FOR EACH ROW
BEGIN
	SET NEW.id = CONCAT('001', UUID_SHORT());
END$$


USE `perrera`$$
DROP TRIGGER IF EXISTS `perrera`.`veterinarios_add_id` $$
USE `perrera`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `perrera`.`veterinarios_add_id`
BEFORE INSERT ON `perrera`.`veterinarios`
FOR EACH ROW
BEGIN
	SET NEW.id = CONCAT('005', UUID_SHORT());
END$$


USE `perrera`$$
DROP TRIGGER IF EXISTS `perrera`.`duenios_add_id` $$
USE `perrera`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `perrera`.`duenios_add_id`
BEFORE INSERT ON `perrera`.`duenios`
FOR EACH ROW
BEGIN
	SET NEW.id = CONCAT('003', UUID_SHORT());
END$$


USE `perrera`$$
DROP TRIGGER IF EXISTS `perrera`.`roles_BEFORE_INSERT` $$
USE `perrera`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `perrera`.`roles_BEFORE_INSERT`
BEFORE INSERT ON `perrera`.`roles`
FOR EACH ROW
BEGIN
	SET NEW.id = CONCAT('001', UUID_SHORT());
END$$


USE `perrera`$$
DROP TRIGGER IF EXISTS `perrera`.`empleados_add_id` $$
USE `perrera`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `perrera`.`empleados_add_id`
BEFORE INSERT ON `perrera`.`empleados`
FOR EACH ROW
BEGIN
	SET NEW.id = CONCAT('002', UUID_SHORT());
END$$


USE `perrera`$$
DROP TRIGGER IF EXISTS `perrera`.`tareas_add_id` $$
USE `perrera`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `perrera`.`tareas_add_id`
BEFORE INSERT ON `perrera`.`tareas`
FOR EACH ROW
BEGIN
	SET NEW.id = CONCAT('00D', UUID_SHORT());
END$$


USE `perrera`$$
DROP TRIGGER IF EXISTS `perrera`.`tareas_asignadas_BEFORE_INSERT` $$
USE `perrera`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `perrera`.`tareas_asignadas_BEFORE_INSERT`
BEFORE INSERT ON `perrera`.`tareas_asignadas`
FOR EACH ROW
BEGIN
	IF (NEW.empleados_id IS NULL AND NEW.voluntarios_id IS NULL) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Al menos, uno de los campos empleados_id y voluntarios_id debe estar relleno';
	ELSE
		SET NEW.id = CONCAT('004', UUID_SHORT());
    END IF;    
END$$


DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
