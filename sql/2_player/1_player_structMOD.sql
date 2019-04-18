DROP TABLE IF EXISTS `db_choco`.`player`;
CREATE TABLE `db_choco`.`player` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `charac_id` VARCHAR(100) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `species` VARCHAR(255) NOT NULL,
  `gender` VARCHAR(255) NOT NULL,
  `origin` VARCHAR(255) NOT NULL,
  `picture` VARCHAR(255) NOT NULL, 
  `kind` VARCHAR(255) NOT NULL,
  `life` INT NOT NULL,
  `x_init` INT NULL DEFAULT 0,
  `y_init` INT NULL DEFAULT 0,
  PRIMARY KEY (`id`));

DROP TABLE IF EXISTS `db_choco`.`object`;
CREATE TABLE `db_choco`.`object` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `content_type_id` INT NOT NULL,
  `content_id` VARCHAR(100) NULL,
  `player_id` INT NOT NULL,
  PRIMARY KEY (`id`));

DROP TABLE IF EXISTS `db_choco`.`content_type`;
CREATE TABLE `db_choco`.`content_type` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `bag` TINYINT NOT NULL DEFAULT 1,
  `descr` VARCHAR(255) NULL,
  PRIMARY KEY (`id`));

TRUNCATE `db_choco`.`content_type`;
INSERT INTO `db_choco`.`content_type` (`id`, `name`, `bag`) VALUES ('1', 'oeuf', 1);
INSERT INTO `db_choco`.`content_type` (`id`, `name`, `bag`)  VALUES ('2', 'lait', 1);
INSERT INTO `db_choco`.`content_type` (`id`, `name`, `bag`)  VALUES ('3', 'chocolat', 1);
INSERT INTO `db_choco`.`content_type` (`id`, `name`, `bag`)  VALUES ('4', 'character', 0);
INSERT INTO `db_choco`.`content_type` (`id`, `name`, `bag`)  VALUES ('5', 'easter egg', 0);


