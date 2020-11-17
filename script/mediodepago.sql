CREATE TABLE `circuito_agroturistico`.`medio_pago` (
  `idMedio_pago` INT NOT NULL,
  `nombre` VARCHAR(450) NOT NULL,
  `idImagen` INT NULL DEFAULT NULL,
  `baja` BIT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idmedio_pago`));

ALTER TABLE `circuito_agroturistico`.`medio_pago` 
CHANGE COLUMN `idMedio_pago` `idMedio_pago` INT(11) NOT NULL AUTO_INCREMENT ;


CREATE TABLE `circuito_agroturistico`.`mediopago_productor` (
  `idMediopago_productor` INT(11) NOT NULL AUTO_INCREMENT,
  `idMedio_pago` INT NOT NULL,
  `idProductor` INT NOT NULL,
  PRIMARY KEY (`idMediopago_productor`));

ALTER TABLE `circuito_agroturistico`.`mediopago_productor` 
CHANGE COLUMN `idMediopago_productor` `idMediopago_productor` INT(11) NOT NULL AUTO_INCREMENT ;
