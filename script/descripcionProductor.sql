ALTER TABLE `circuito_agroturistico`.`productor` ADD COLUMN `descripcion` VARCHAR(2000) NULL DEFAULT NULL AFTER `nombreApellido`;

ALTER TABLE `circuito_agroturistico`.`producto` 
CHANGE COLUMN `descripcion` `descripcion` VARCHAR(1000) NOT NULL ;
