ALTER TABLE `docker_database_ems_live`.`transfers` 
ADD COLUMN `description` VARCHAR(255) NULL DEFAULT NULL AFTER `created_by`;
ALTER TABLE `docker_database_ems_live`.`transfers` 
CHANGE COLUMN `description` `description` VARCHAR(255) NULL DEFAULT NULL AFTER `amount`;
