ALTER TABLE `circuito_agroturistico`.`categoria` 
ADD COLUMN `esAgroturismo` BIT(1) NOT NULL DEFAULT 0 AFTER `baja`;
