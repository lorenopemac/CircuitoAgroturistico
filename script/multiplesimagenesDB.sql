CREATE TABLE `circuito_agroturistico`.`imagen_productor` (
  `idImagen_productor` INT NOT NULL AUTO_INCREMENT,
  `idImagen` INT NOT NULL,
  `idProductor` INT NOT NULL,
  `baja` BIT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idImagen_productor`));


CREATE TABLE `circuito_agroturistico`.`imagen_producto` (
  `idImagen_producto` INT NOT NULL AUTO_INCREMENT,
  `idImagen` INT NOT NULL,
  `idProducto` INT NOT NULL,
  `baja` BIT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idImagen_producto`));


ALTER TABLE `circuito_agroturistico`.`productor` 
DROP COLUMN `web`,
DROP COLUMN `twitter`,
DROP COLUMN `Instagram`,
DROP COLUMN `facebook`;
