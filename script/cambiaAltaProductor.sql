ALTER TABLE `circuito_agroturistico`.`productor` 
CHANGE COLUMN `nombre` `nombre` VARCHAR(45) NULL DEFAULT NULL ,
CHANGE COLUMN `nombreFantasia` `nombreFantasia` VARCHAR(100) NULL ,
CHANGE COLUMN `nombreApellido` `nombreApellido` VARCHAR(45) NULL ;
