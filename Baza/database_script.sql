-- MySQL Script generated by MySQL Workbench
-- Wed May 29 12:52:20 2019
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema psigram
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `psigram` ;

-- -----------------------------------------------------
-- Schema psigram
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `psigram` DEFAULT CHARACTER SET utf8 ;
USE `psigram` ;

-- -----------------------------------------------------
-- Table `psigram`.`User`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `psigram`.`User` ;

CREATE TABLE IF NOT EXISTS `psigram`.`User` (
  `id_user` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(20) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `surname` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `date_of_birth` DATE NOT NULL,
  `gender` BINARY(1) NOT NULL,
  `type` VARCHAR(1) NOT NULL DEFAULT 'u' COMMENT 'u - user\na - admin\nb - business',
  `profile_picture_path` VARCHAR(256) NULL,
  PRIMARY KEY (`id_user`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `psigram`.`Post`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `psigram`.`Post` ;

CREATE TABLE IF NOT EXISTS `psigram`.`Post` (
  `id_post` INT NOT NULL AUTO_INCREMENT,
  `timestamp` TIMESTAMP(0) NOT NULL,
  `image_path` VARCHAR(256) NOT NULL,
  `sponsored` BINARY(1) NOT NULL,
  `id_user` INT NOT NULL,
  PRIMARY KEY (`id_post`),
  INDEX `fk_Post_User_idx` (`id_user` ASC),
  CONSTRAINT `fk_Post_User`
    FOREIGN KEY (`id_user`)
    REFERENCES `psigram`.`User` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `psigram`.`Like`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `psigram`.`Like` ;

CREATE TABLE IF NOT EXISTS `psigram`.`Like` (
  `id_user` INT NOT NULL,
  `id_post` INT NOT NULL,
  INDEX `fk_Like_User_idx` (`id_user` ASC),
  INDEX `fk_Like_Post_idx` (`id_post` ASC),
  CONSTRAINT `fk_Like_User`
    FOREIGN KEY (`id_user`)
    REFERENCES `psigram`.`User` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Like_Post`
    FOREIGN KEY (`id_post`)
    REFERENCES `psigram`.`Post` (`id_post`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `psigram`.`Follows`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `psigram`.`Follows` ;

CREATE TABLE IF NOT EXISTS `psigram`.`Follows` (
  `id_user_following` INT NOT NULL,
  `id_user_followed` INT NOT NULL,
  INDEX `fk_Follows_User1_idx` (`id_user_following` ASC),
  INDEX `fk_Follows_User2_idx` (`id_user_followed` ASC),
  CONSTRAINT `fk_Follows_User1`
    FOREIGN KEY (`id_user_following`)
    REFERENCES `psigram`.`User` (`id_user`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Follows_User2`
    FOREIGN KEY (`id_user_followed`)
    REFERENCES `psigram`.`User` (`id_user`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `psigram`.`Comment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `psigram`.`Comment` ;

CREATE TABLE IF NOT EXISTS `psigram`.`Comment` (
  `id_comment` INT NOT NULL AUTO_INCREMENT,
  `timestamp` TIMESTAMP(0) NOT NULL,
  `text` VARCHAR(256) NOT NULL,
  `id_user` INT NOT NULL,
  `id_post` INT NOT NULL,
  PRIMARY KEY (`id_comment`),
  INDEX `fk_Comment_User_idx` (`id_user` ASC),
  INDEX `fk_Comment_Post_idx` (`id_post` ASC),
  CONSTRAINT `fk_Comment_User`
    FOREIGN KEY (`id_user`)
    REFERENCES `psigram`.`User` (`id_user`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Comment_Post`
    FOREIGN KEY (`id_post`)
    REFERENCES `psigram`.`Post` (`id_post`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
