ALTER TABLE `circuito_agroturistico`.`provincia` 
ADD COLUMN `baja` BIT(1) NOT NULL DEFAULT 0 AFTER `nombre`;

ALTER TABLE `circuito_agroturistico`.`localidad` 
ADD COLUMN `baja` BIT(1) NOT NULL DEFAULT 0 AFTER `localidadcol`;
