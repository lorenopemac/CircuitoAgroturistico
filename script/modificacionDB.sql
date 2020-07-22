ALTER TABLE `circuito_agroturistico`.`feria` 
ADD COLUMN `idLocalidad` INT NOT NULL AFTER `nombre`,
ADD COLUMN `baja` BIT(1) NOT NULL DEFAULT 0 AFTER `idLocalidad`;


ALTER TABLE `circuito_agroturistico`.`categoria` 
ADD COLUMN `baja` BIT(1) NOT NULL DEFAULT 0 AFTER `descripcion`;

ALTER TABLE `circuito_agroturistico`.`producto` 
ADD COLUMN `baja` BIT(1) NOT NULL AFTER `idProductor`;


ALTER TABLE `circuito_agroturistico`.`productor` 
ADD COLUMN `baja` BIT(1) NOT NULL DEFAULT 0 ;


CREATE TABLE `circuito_agroturistico`.`red_social` (
  `idRed_social` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `baja` BIT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idRed_social`));
