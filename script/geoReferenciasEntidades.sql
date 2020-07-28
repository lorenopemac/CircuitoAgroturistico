ALTER TABLE `circuito_agroturistico`.`feria` 
ADD COLUMN `longitud` VARCHAR(450) NULL AFTER `baja`,
ADD COLUMN `latitud` VARCHAR(450) NULL AFTER `longitud`;


ALTER TABLE `circuito_agroturistico`.`productor` 
ADD COLUMN `latitud` VARCHAR(450) NULL AFTER `baja`,
ADD COLUMN `longitud` VARCHAR(450) NULL AFTER `latitud`;

ALTER TABLE `circuito_agroturistico`.`producto` 
ADD COLUMN `latitud` VARCHAR(450) NULL AFTER `baja`,
ADD COLUMN `longitud` VARCHAR(450) NULL AFTER `latitud`;
