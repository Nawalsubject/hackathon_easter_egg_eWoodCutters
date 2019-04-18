DROP TABLE IF EXISTS `db_choco`.`videobonus`;
CREATE TABLE `db_choco`.`videobonus` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `url` VARCHAR(255) NOT NULL,
  `descr` VARCHAR(255) NULL,
  PRIMARY KEY (`id`));

DROP TABLE IF EXISTS `db_choco`.`backgroundmap`;
CREATE TABLE `db_choco`.`backgroundmap` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `picture` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255) NULL,
  PRIMARY KEY (`id`));

TRUNCATE `db_choco`.`backgroundmap`;
INSERT INTO `db_choco`.`backgroundmap` (`id`, `picture`) VALUES ('1', 'zelda.jpg');
INSERT INTO `db_choco`.`backgroundmap` (`id`, `picture`) VALUES ('2', 'mario_world.jpg');
INSERT INTO `db_choco`.`backgroundmap` (`id`, `picture`) VALUES ('3', 'mario_bros.jpg');
INSERT INTO `db_choco`.`backgroundmap` (`id`, `picture`) VALUES ('4', 'mario.jpg');
INSERT INTO `db_choco`.`backgroundmap` (`id`, `picture`) VALUES ('5', 'donut.png');
INSERT INTO `db_choco`.`backgroundmap` (`id`, `picture`) VALUES ('6', 'bomberman.jpg');


