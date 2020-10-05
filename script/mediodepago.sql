CREATE TABLE `circuito_agroturistico`.`medio_pago` (
  `idMedio_pago` INT NOT NULL,
  `nombre` VARCHAR(450) NOT NULL,
  `idImagen` INT NULL DEFAULT NULL,
  `baja` BIT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idmedio_pago`));



CREATE TABLE `circuito_agroturistico`.`mediopago_productor` (
  `idMediopago_productor` INT NOT NULL,
  `idMedio_pago` INT NOT NULL,
  `idProductor` INT NOT NULL,
  PRIMARY KEY (`idMediopago_productor`));
