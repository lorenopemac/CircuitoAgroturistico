CREATE TABLE `circuito_agroturistico`.`redsocial_Productor` (
  `idRedsocial_Productor` INT NOT NULL AUTO_INCREMENT,
  `idRed_social` INT NOT NULL,
  `idProductor` INT NOT NULL,
  PRIMARY KEY (`idRedsocial_Productor`));


ALTER TABLE `circuito_agroturistico`.`redsocial_Productor` 
ADD COLUMN `direccion` VARCHAR(150) NOT NULL AFTER `idProductor`;
