-- MySQL Script generated by MySQL Workbench
-- Tue Apr 23 21:34:31 2024
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema nfa021ProjetV2
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `nfa021ProjetV2` ;

-- -----------------------------------------------------
-- Schema nfa021ProjetV2
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `nfa021ProjetV2` DEFAULT CHARACTER SET utf8 ;
USE `nfa021ProjetV2` ;

-- -----------------------------------------------------
-- Table `nfa021ProjetV2`.`VILLE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nfa021ProjetV2`.`VILLE` ;

CREATE TABLE IF NOT EXISTS `nfa021ProjetV2`.`VILLE` (
  `idVille` INT NOT NULL AUTO_INCREMENT,
  `cp` VARCHAR(5) NOT NULL,
  `nomVille` VARCHAR(75) NOT NULL,
  `departement` VARCHAR(50) NOT NULL,
  `region` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`idVille`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `nfa021ProjetV2`.`CLIENT`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nfa021ProjetV2`.`CLIENT` ;

CREATE TABLE IF NOT EXISTS `nfa021ProjetV2`.`CLIENT` (
  `idClient` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(150) NOT NULL,
  `prenom` VARCHAR(150) NOT NULL,
  `adresse` VARCHAR(150) NOT NULL,
  `telephone` VARCHAR(15) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `profilAdmin` TINYINT NULL,
  `estValide` INT NULL,
  `jetonValidation` VARCHAR(255) NULL,
  `fkIdVille` INT NOT NULL,
  PRIMARY KEY (`idClient`, `fkIdVille`),
  CONSTRAINT `CLIENT_fkIdVille`
    FOREIGN KEY (`fkIdVille`)
    REFERENCES `nfa021ProjetV2`.`VILLE` (`idVille`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `IDX_CLIENT_VILLE_fkIdVille` ON `nfa021ProjetV2`.`CLIENT` (`fkIdVille` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `nfa021ProjetV2`.`FORFAIT`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nfa021ProjetV2`.`FORFAIT` ;

CREATE TABLE IF NOT EXISTS `nfa021ProjetV2`.`FORFAIT` (
  `idForfait` INT NOT NULL AUTO_INCREMENT,
  `duree` VARCHAR(45) NOT NULL,
  `tarif` DOUBLE NOT NULL,
  PRIMARY KEY (`idForfait`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `nfa021ProjetV2`.`INSTRUMENT`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nfa021ProjetV2`.`INSTRUMENT` ;

CREATE TABLE IF NOT EXISTS `nfa021ProjetV2`.`INSTRUMENT` (
  `idInstrument` INT NOT NULL AUTO_INCREMENT,
  `typeInstrument` VARCHAR(150) NOT NULL,
  `marque` VARCHAR(50) NOT NULL,
  `modele` VARCHAR(50) NOT NULL,
  `numeroSerie` VARCHAR(50) NOT NULL,
  `dateAchat` DATE NOT NULL,
  `parcLocation` TINYINT NOT NULL,
  `fkIdClient` INT,
  `fkIdLocation` INT,
  PRIMARY KEY (`idInstrument`),
  CONSTRAINT `INSTRUMENT_fkIdClient`
    FOREIGN KEY (`fkIdClient`)
    REFERENCES `nfa021ProjetV2`.`CLIENT` (`idClient`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `IDX_INSTRUMENT_CLIENT_fkIdClient` ON `nfa021ProjetV2`.`INSTRUMENT` (`fkIdClient` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `nfa021ProjetV2`.`LOCATION`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nfa021ProjetV2`.`LOCATION` ;

CREATE TABLE IF NOT EXISTS `nfa021ProjetV2`.`LOCATION` (
  `idLocation` INT NOT NULL AUTO_INCREMENT,
  `dateLocation` DATE NOT NULL,
  `finLocation` DATE NOT NULL,
  `fkIdInstruLoc` INT NOT NULL,
  `fkIdForfait` INT NOT NULL,
  `fkIdClient` INT NOT NULL,
  `fkIdInstrument` INT NOT NULL,
  PRIMARY KEY (`idLocation`, `fkIdInstruLoc`, `fkIdForfait`, `fkIdClient`, `fkIdInstrument`),
  CONSTRAINT `LOCATION_fkIdForfait`
    FOREIGN KEY (`fkIdForfait`)
    REFERENCES `nfa021ProjetV2`.`FORFAIT` (`idForfait`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `LOCATION_fkIdClient`
    FOREIGN KEY (`fkIdClient`)
    REFERENCES `nfa021ProjetV2`.`CLIENT` (`idClient`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `LOCATION_fkIdInstrument`
    FOREIGN KEY (`fkIdInstrument`)
    REFERENCES `nfa021ProjetV2`.`INSTRUMENT` (`idInstrument`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `IDX_LOCATION_FORFAIT_fkIdForfait` ON `nfa021ProjetV2`.`LOCATION` (`fkIdForfait` ASC) VISIBLE;

CREATE INDEX `IDX_LOCATION_CLIENT_fkIdClient` ON `nfa021ProjetV2`.`LOCATION` (`fkIdClient` ASC) VISIBLE;

CREATE INDEX `IDX_LOCATION_INSTRUMENT_fkIdInstrument` ON `nfa021ProjetV2`.`LOCATION` (`fkIdInstrument` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `nfa021ProjetV2`.`ENTRETIEN`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nfa021ProjetV2`.`ENTRETIEN` ;

CREATE TABLE IF NOT EXISTS `nfa021ProjetV2`.`ENTRETIEN` (
  `idEntretien` INT NOT NULL AUTO_INCREMENT,
  `dateEntretien` DATE NOT NULL,
  `descriptionEntretien` LONGTEXT NOT NULL,
  `prixEntretien` DOUBLE NOT NULL,
  `fkIdInstrument` INT NOT NULL,
  PRIMARY KEY (`idEntretien`, `fkIdInstrument`),
  CONSTRAINT `ENTRETIEN_fkIdInstrument`
    FOREIGN KEY (`fkIdInstrument`)
    REFERENCES `nfa021ProjetV2`.`INSTRUMENT` (`idInstrument`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `IDX_ENTRETIEN_INSTRUMENT_fkIdInstrument` ON `nfa021ProjetV2`.`ENTRETIEN` (`fkIdInstrument` ASC) VISIBLE;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
