ALTER TABLE `circuito_agroturistico`.`productor` 
ADD COLUMN `nombreFantasia` VARCHAR(100) NULL DEFAULT NULL AFTER `longitud`,
ADD COLUMN `nombreApellido` VARCHAR(45) NULL DEFAULT NULL AFTER `nombreFantasia`,
CHANGE COLUMN `cuit` `cuit` BIGINT(20) NULL DEFAULT NULL ;


