ALTER TABLE `circuito_agroturistico`.`red_social` 
ADD COLUMN `idImagen` VARCHAR(45) NULL AFTER `baja`;


ALTER TABLE `productor` ADD `baja` BIT(1) NOT NULL DEFAULT b'0' AFTER `numeroTelefono`;
ALTER TABLE `provincia` ADD `baja` BIT(1) NOT NULL DEFAULT b'0' AFTER `nombre`;