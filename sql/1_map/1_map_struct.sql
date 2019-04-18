DROP TABLE IF EXISTS `db_choco`.`map`;
CREATE TABLE `db_choco`.`map` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `width` INT NOT NULL,
  `height` INT NOT NULL,
  `background` VARCHAR(255) NOT NULL,
  `descr` TEXT NULL,
  PRIMARY KEY (`id`));

DROP TABLE IF EXISTS `db_choco`.`cell`;
CREATE TABLE `db_choco`.`cell` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `x` VARCHAR(45) NOT NULL,
  `y` VARCHAR(45) NOT NULL,
  `content_type_id` INT NULL,
  `content_status` TINYINT NULL,
  `player1_reveal` TINYINT NOT NULL DEFAULT 0,
  `player2_reveal` TINYINT NOT NULL DEFAULT 0,
  `map_id` INT NOT NULL,
  PRIMARY KEY (`id`));
