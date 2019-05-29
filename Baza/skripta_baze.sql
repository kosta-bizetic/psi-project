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
-- Table `psigram`.`korisnik`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `psigram`.`korisnik` ;

CREATE TABLE IF NOT EXISTS `psigram`.`korisnik` (
  `id_korisnik` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(20) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `ime` VARCHAR(45) NOT NULL,
  `prezime` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `datum_rodjenja` DATE NOT NULL,
  `pol` BINARY(1) NOT NULL,
  `tip` VARCHAR(1) NOT NULL,
  `profilna_slika_path` VARCHAR(256) NULL DEFAULT NULL,
  PRIMARY KEY (`id_korisnik`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `psigram`.`objava`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `psigram`.`objava` ;

CREATE TABLE IF NOT EXISTS `psigram`.`objava` (
  `id_objava` INT(11) NOT NULL AUTO_INCREMENT,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `slika_path` VARCHAR(256) NOT NULL,
  `sponzorisana` BINARY(1) NOT NULL,
  `Korisnik_id_korisnik` INT(11) NOT NULL,
  PRIMARY KEY (`id_objava`),
  INDEX `fk_Objava_Korisnik_idx` (`Korisnik_id_korisnik` ASC),
  CONSTRAINT `fk_Objava_Korisnik`
    FOREIGN KEY (`Korisnik_id_korisnik`)
    REFERENCES `psigram`.`korisnik` (`id_korisnik`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `psigram`.`komentar`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `psigram`.`komentar` ;

CREATE TABLE IF NOT EXISTS `psigram`.`komentar` (
  `id_komentar` INT(11) NOT NULL AUTO_INCREMENT,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `text` VARCHAR(256) NOT NULL,
  `Korisnik_id_korisnik` INT(11) NOT NULL,
  `Objava_id_objava` INT(11) NOT NULL,
  PRIMARY KEY (`id_komentar`),
  INDEX `fk_Komentar_Korisnik1_idx` (`Korisnik_id_korisnik` ASC),
  INDEX `fk_Komentar_Objava1_idx` (`Objava_id_objava` ASC),
  CONSTRAINT `fk_Komentar_Korisnik1`
    FOREIGN KEY (`Korisnik_id_korisnik`)
    REFERENCES `psigram`.`korisnik` (`id_korisnik`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Komentar_Objava1`
    FOREIGN KEY (`Objava_id_objava`)
    REFERENCES `psigram`.`objava` (`id_objava`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `psigram`.`lajk`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `psigram`.`lajk` ;

CREATE TABLE IF NOT EXISTS `psigram`.`lajk` (
  `Korisnik_id_korisnik` INT(11) NOT NULL,
  `Objava_id_objava` INT(11) NOT NULL,
  INDEX `fk_Lajk_Korisnik1_idx` (`Korisnik_id_korisnik` ASC),
  INDEX `fk_Lajk_Objava1_idx` (`Objava_id_objava` ASC),
  CONSTRAINT `fk_Lajk_Korisnik1`
    FOREIGN KEY (`Korisnik_id_korisnik`)
    REFERENCES `psigram`.`korisnik` (`id_korisnik`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Lajk_Objava1`
    FOREIGN KEY (`Objava_id_objava`)
    REFERENCES `psigram`.`objava` (`id_objava`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `psigram`.`prati`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `psigram`.`prati` ;

CREATE TABLE IF NOT EXISTS `psigram`.`prati` (
  `Korisnik_id_korisnik_pratilac` INT(11) NOT NULL,
  `Korisnik_id_korisnik_praceni` INT(11) NOT NULL,
  INDEX `fk_Prati_Korisnik1_idx` (`Korisnik_id_korisnik_pratilac` ASC),
  INDEX `fk_Prati_Korisnik2_idx` (`Korisnik_id_korisnik_praceni` ASC),
  CONSTRAINT `fk_Prati_Korisnik1`
    FOREIGN KEY (`Korisnik_id_korisnik_pratilac`)
    REFERENCES `psigram`.`korisnik` (`id_korisnik`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Prati_Korisnik2`
    FOREIGN KEY (`Korisnik_id_korisnik_praceni`)
    REFERENCES `psigram`.`korisnik` (`id_korisnik`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
