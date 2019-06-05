-- MySQL Script generated by MySQL Workbench
-- Wed Jun  5 20:02:14 2019
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema psigram
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema psigram
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `psigram` DEFAULT CHARACTER SET utf8 ;
USE `psigram` ;
USE `psigram`;

DELIMITER $$

USE `psigram`$$
DROP TRIGGER IF EXISTS `psigram`.`Post_AFTER_INSERT` $$
USE `psigram`$$
CREATE DEFINER = CURRENT_USER TRIGGER `psigram`.`Post_AFTER_INSERT` AFTER INSERT ON `Post` FOR EACH ROW
BEGIN
	UPDATE User
    SET num_posts = num_posts + 1
    WHERE id_user = NEW.id_user;
END$$


USE `psigram`$$
DROP TRIGGER IF EXISTS `psigram`.`Post_AFTER_DELETE` $$
USE `psigram`$$
CREATE DEFINER = CURRENT_USER TRIGGER `psigram`.`Post_AFTER_DELETE` AFTER DELETE ON `Post` FOR EACH ROW
BEGIN
	UPDATE User
    SET num_posts = num_posts - 1
    WHERE id_user = OLD.id_user;
END$$


USE `psigram`$$
DROP TRIGGER IF EXISTS `psigram`.`Likes_AFTER_INSERT` $$
USE `psigram`$$
CREATE DEFINER = CURRENT_USER TRIGGER `psigram`.`Likes_AFTER_INSERT` AFTER INSERT ON `Likes` FOR EACH ROW
BEGIN
	UPDATE Post
    SET num_likes = num_likes + 1
    WHERE id_post = NEW.id_post;
END$$


USE `psigram`$$
DROP TRIGGER IF EXISTS `psigram`.`Likes_AFTER_DELETE` $$
USE `psigram`$$
CREATE DEFINER = CURRENT_USER TRIGGER `psigram`.`Likes_AFTER_DELETE` AFTER DELETE ON `Likes` FOR EACH ROW
BEGIN
	UPDATE Post
    SET num_likes = num_likes - 1
    WHERE id_post = OLD.id_post;
END$$


USE `psigram`$$
DROP TRIGGER IF EXISTS `psigram`.`Follows_AFTER_INSERT` $$
USE `psigram`$$
CREATE DEFINER = CURRENT_USER TRIGGER `psigram`.`Follows_AFTER_INSERT` AFTER INSERT ON `Follows` FOR EACH ROW
BEGIN
	UPDATE User
    SET num_followers = num_followers + 1
    WHERE id_user = NEW.id_user_followed;
    UPDATE User
    SET num_following = num_following + 1
    WHERE id_user = NEW.id_user_following;
END$$


USE `psigram`$$
DROP TRIGGER IF EXISTS `psigram`.`Follows_AFTER_DELETE` $$
USE `psigram`$$
CREATE DEFINER = CURRENT_USER TRIGGER `psigram`.`Follows_AFTER_DELETE` AFTER DELETE ON `Follows` FOR EACH ROW
BEGIN
	UPDATE User
    SET num_followers = num_followers - 1
    WHERE id_user = OLD.id_user_followed;
    UPDATE User
    SET num_following = num_following - 1
    WHERE id_user = OLD.id_user_following;
END$$


DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;