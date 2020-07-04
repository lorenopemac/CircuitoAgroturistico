CREATE SCHEMA `circuito_agroturistico` ;

CREATE TABLE `circuito_agroturistico`.`productor` (
  `idProductor` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `cuit` INT NOT NULL,
  `idLocalidad` INT NOT NULL,
  `idProvincia` INT NOT NULL,
  `nombreCalle` VARCHAR(100) NULL,
  `numeroCalle` INT NULL,
  `numeroTelefono` INT NOT NULL,
  `facebook` VARCHAR(150) NULL,
  `Instagram` VARCHAR(150) NULL,
  `twitter` VARCHAR(150) NULL,
  `web` VARCHAR(150) NULL,
  PRIMARY KEY (`idProductor`),
  UNIQUE INDEX `id_UNIQUE` (`idProductor` ASC));



CREATE TABLE `circuito_agroturistico`.`provincia` (
  `idProvincia` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(75) NOT NULL,
  PRIMARY KEY (`idProvincia`));



CREATE TABLE `circuito_agroturistico`.`localidad` (
  `idLocalidad` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `idProvincia` INT NOT NULL,
  `codigoPostal` INT NULL,
  `localidadcol` VARCHAR(45) NULL,
  PRIMARY KEY (`idLocalidad`));



CREATE TABLE `circuito_agroturistico`.`producto` (
  `idProducto` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `descripcion` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`idProducto`));


CREATE TABLE `circuito_agroturistico`.`categoria` (
  `idCategoria` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(65) NOT NULL,
  `descripcion` VARCHAR(150) NULL,
  PRIMARY KEY (`idCategoria`));
