-- -----------------------------------------------------
-- Data for table `nfa021ProjetV2`.`VILLE`
-- Création des premières villes 
-- -----------------------------------------------------
START TRANSACTION;
USE `nfa021ProjetV2`;
INSERT INTO `nfa021ProjetV2`.`VILLE` (`idVille`, `cp`, `nomVille`, `departement`, `region`) VALUES (DEFAULT, '69230', 'SAINT GENIS LAVAL', 'RHÔNE (69)', 'RHÔNE-ALPES');
INSERT INTO `nfa021ProjetV2`.`VILLE` (`idVille`, `cp`, `nomVille`, `departement`, `region`) VALUES (DEFAULT, '75001', 'PARIS', 'PARIS (75)', 'ÎLE-DE-FRANCE');
INSERT INTO `nfa021ProjetV2`.`VILLE` (`idVille`, `cp`, `nomVille`, `departement`, `region`) VALUES (DEFAULT, '33000', 'BORDEAUX', 'GIRONDE (33)', 'NOUVELLE-AQUITAINE');
INSERT INTO `nfa021ProjetV2`.`VILLE` (`idVille`, `cp`, `nomVille`, `departement`, `region`) VALUES (DEFAULT, '31000', 'TOULOUSE', 'HAUTE-GARONNE (31)', 'OCCITANIE');
INSERT INTO `nfa021ProjetV2`.`VILLE` (`idVille`, `cp`, `nomVille`, `departement`, `region`) VALUES (DEFAULT, '13000', 'MARSEILLE', 'BOUCHES-DU-RHÔNE (13)', 'PROVENCE-ALPES-CÔTE D''AZUR');
INSERT INTO `nfa021ProjetV2`.`VILLE` (`idVille`, `cp`, `nomVille`, `departement`, `region`) VALUES (DEFAULT, '69000', 'LYON', 'RHÔNE (69)', 'RHÔNE-ALPES');
INSERT INTO `nfa021ProjetV2`.`VILLE` (`idVille`, `cp`, `nomVille`, `departement`, `region`) VALUES (DEFAULT, '44000', 'NANTES', 'LOIRE-ATLANTIQUE (44)', 'PAYS DE LA LOIRE');
INSERT INTO `nfa021ProjetV2`.`VILLE` (`idVille`, `cp`, `nomVille`, `departement`, `region`) VALUES (DEFAULT, '67000', 'STRASBOURG', 'BAS-RHIN (67)', 'GRAND EST');
INSERT INTO `nfa021ProjetV2`.`VILLE` (`idVille`, `cp`, `nomVille`, `departement`, `region`) VALUES (DEFAULT, '59000', 'LILLE', 'NORD (59)', 'HAUTS-DE-FRANCE');
INSERT INTO `nfa021ProjetV2`.`VILLE` (`idVille`, `cp`, `nomVille`, `departement`, `region`) VALUES (DEFAULT, '35000', 'RENNES', 'ILLE-ET-VILAINE (35)', 'BRETAGNE');
INSERT INTO `nfa021ProjetV2`.`VILLE` (`idVille`, `cp`, `nomVille`, `departement`, `region`) VALUES (DEFAULT, '37000', 'TOURS', 'INDRE ET LOIRE (37)', 'CENTRE');

COMMIT;


-- -----------------------------------------------------
-- Data for table `nfa021ProjetV2`.`CLIENT`
-- Création du premier client : l'administrateur (MDP : AdcGj2021*)
-- Création des clients : (MDP : test)
-- -----------------------------------------------------
START TRANSACTION;
USE `nfa021ProjetV2`;
INSERT INTO `nfa021ProjetV2`.`CLIENT` (`idClient`, `nom`, `prenom`, `adresse`, `telephone`, `email`, `password`, `profilAdmin`, `estValide`, `jetonValidation`, `fkIdVille`) VALUES (DEFAULT, 'BLET', 'Nicolas', '29 Rue des Halles', '06.63.49.03.39', 'bletou@hotmail.fr', '$2y$10$rMy9orR6RgmmZzujoCt.pev1.wwpfkMqEkN489/msHKrDYs4WcuWC', 1, 1, 0,1);
INSERT INTO `nfa021ProjetV2`.`CLIENT` (`idClient`, `nom`, `prenom`, `adresse`, `telephone`, `email`, `password`, `profilAdmin`, `estValide`, `jetonValidation`, `fkIdVille`) VALUES (DEFAULT, 'DUPONT', 'Marie', '12 Rue de la Liberté', '06.12.34.56.78', 'marie.dupont@example.com', '$2y$10$3LVkTrGmOp888UgyOHOVu.WuAVI/8eQTRd4xWc/eEykTTGQiCpDbu', 0, 1, 0, 4);
INSERT INTO `nfa021ProjetV2`.`CLIENT` (`idClient`, `nom`, `prenom`, `adresse`, `telephone`, `email`, `password`, `profilAdmin`, `estValide`, `jetonValidation`, `fkIdVille`) VALUES (DEFAULT, 'MARTIN', 'Jean', '8 Avenue Victor Hugo', '06.98.76.54.32', 'jean.martin@example.com', '$2y$10$D9se7vfmVmjwr1U7bfRbZePduk6J0kQImetRMRNJ1908J8M32B86O', 0, 1, 0, 3);
INSERT INTO `nfa021ProjetV2`.`CLIENT` (`idClient`, `nom`, `prenom`, `adresse`, `telephone`, `email`, `password`, `profilAdmin`, `estValide`, `jetonValidation`, `fkIdVille`) VALUES (DEFAULT, 'BERTRAND', 'Sophie', '45 Boulevard des Roses', '07.12.34.56.78', 'sophie.bertrand@example.com', '$2y$10$AdHMUlbq77ghkD6K19A5JuskJfaCpJMcEizPpuJrEtWoR1ICFmDeC', 0, 1, 0, 7);
INSERT INTO `nfa021ProjetV2`.`CLIENT` (`idClient`, `nom`, `prenom`, `adresse`, `telephone`, `email`, `password`, `profilAdmin`, `estValide`, `jetonValidation`, `fkIdVille`) VALUES (DEFAULT, 'PETIT', 'Pierre', '3 Rue du Moulin', '06.54.32.10.98', 'pierre.petit@example.com', '$2y$10$j/m17vhXWfHz3xAOJSYc2ONLj.3nHAZgShCj2u0RstgpByUHCHe/G', 0, 1, 0, 6);
INSERT INTO `nfa021ProjetV2`.`CLIENT` (`idClient`, `nom`, `prenom`, `adresse`, `telephone`, `email`, `password`, `profilAdmin`, `estValide`, `jetonValidation`, `fkIdVille`) VALUES (DEFAULT, 'LEFEBVRE', 'Julie', '27 Avenue des Lilas', '07.98.76.54.32', 'julie.lefebvre@example.com', '$2y$10$bMGJPxs6/74uegA1bJTnLOpjCIqon5tpLK9rzvWOBp.wDWW2FYt16', 0, 1, 0, 5);

COMMIT;


-- -----------------------------------------------------------
-- Data for table `nfa021ProjetV2`.`INSTRUMENT`
-- Création des premiers instruments en gestion & en location
-- -----------------------------------------------------------
START TRANSACTION;
USE `nfa021ProjetV2`;
INSERT INTO `nfa021ProjetV2`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `parcLocation`, `fkIdClient`) VALUES (DEFAULT, 'Clarinette en Sib', 'BUFFET CRAMPON', 'Tosca', '662020', '2014-01-01', false, 3);
INSERT INTO `nfa021ProjetV2`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `parcLocation`, `fkIdClient`) VALUES (DEFAULT, 'Clarinette en Sib', 'BUFFET CRAMPON', 'Tosca', '727644', '2019-01-01', false, 4);
INSERT INTO `nfa021ProjetV2`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `parcLocation`, `fkIdClient`) VALUES (DEFAULT, 'Clarinette en Sib', 'BUFFET CRAMPON', 'Légende', '686757', '2020-01-01', false, 5);
INSERT INTO `nfa021ProjetV2`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `parcLocation`, `fkIdClient`) VALUES (DEFAULT, 'Clarinette en Sib', 'BUFFET CRAMPON', 'Festival', '686771', '2015-01-01', false, 1);
INSERT INTO `nfa021ProjetV2`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `parcLocation`, `fkIdClient`) VALUES (DEFAULT, 'Clarinette en La', 'BUFFET CRAMPON', 'RC', '709584', '2017-01-01', false, 5);
INSERT INTO `nfa021ProjetV2`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `parcLocation`, `fkIdClient`) VALUES (DEFAULT, 'Clarinette Basse', 'BUFFET CRAMPON', 'Prestige', 'H42587', '2007-01-01', false, 3);
INSERT INTO `nfa021ProjetV2`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `parcLocation`, `fkIdClient`) VALUES (DEFAULT, 'Clarinette Basse', 'BUFFET CRAMPON', 'Prestige', '33977', '2006-01-01', false, 1);
INSERT INTO `nfa021ProjetV2`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `parcLocation`, `fkIdClient`) VALUES (DEFAULT, 'Clarinette en Mib', 'BUFFET CRAMPON', 'RC', '507566', '2003-01-01', false, 4);
INSERT INTO `nfa021ProjetV2`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `parcLocation`, `fkIdClient`) VALUES (DEFAULT, 'Clarinette en Sib', 'BUFFET CRAMPON', 'E13', '123456', '2015-01-01', false, 3);
INSERT INTO `nfa021ProjetV2`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `parcLocation`, `fkIdClient`) VALUES (DEFAULT, 'Clarinette en Sib', 'BUFFET CRAMPON', 'E13', '654321', '2020-01-01', false, 2);
INSERT INTO `nfa021ProjetV2`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `parcLocation`, `fkIdClient`) VALUES (DEFAULT, 'Clarinette en Sib', 'BUFFET CRAMPON', 'Prodige', '112233', '2018-01-01', false, 6);
INSERT INTO `nfa021ProjetV2`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `parcLocation`, `fkIdClient`) VALUES (DEFAULT, 'Clarinette en Sib', 'BUFFET CRAMPON', 'Prodige', '332211', '2021-01-01', false, 6);

INSERT INTO `nfa021ProjetV2`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `parcLocation`) VALUES (DEFAULT, 'Clarinette en Sib', 'BUFFET CRAMPON', 'Tosca', '012345', '2016-01-01', true);
INSERT INTO `nfa021ProjetV2`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `parcLocation`) VALUES (DEFAULT, 'Clarinette en Ut', 'BUFFET CRAMPON', 'Tosca', '123456', '2018-01-01', true);
INSERT INTO `nfa021ProjetV2`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `parcLocation`) VALUES (DEFAULT, 'Clarinette en La', 'BUFFET CRAMPON', 'Légende', '654321', '2019-01-01', true);
INSERT INTO `nfa021ProjetV2`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `parcLocation`) VALUES (DEFAULT, 'Clarinette en Mib', 'BUFFET CRAMPON', 'Festival', '543210', '2015-01-01', true);
INSERT INTO `nfa021ProjetV2`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `parcLocation`) VALUES (DEFAULT, 'Clarinette Basse', 'BUFFET CRAMPON', 'RC', '45679', '2017-01-01', true);
INSERT INTO `nfa021ProjetV2`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `parcLocation`) VALUES (DEFAULT, 'Clarinette Alto', 'BUFFET CRAMPON', 'Prestige', '987654', '2008-01-01', true);
INSERT INTO `nfa021ProjetV2`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `parcLocation`) VALUES (DEFAULT, 'Clarinette en Sib', 'BUFFET CRAMPON', 'Prestige', '654321', '2007-01-01', true);
INSERT INTO `nfa021ProjetV2`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `parcLocation`) VALUES (DEFAULT, 'Clarinette en La', 'BUFFET CRAMPON', 'RC', '147258', '2004-01-01', true);
INSERT INTO `nfa021ProjetV2`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `parcLocation`) VALUES (DEFAULT, 'Clarinette en Ut', 'BUFFET CRAMPON', 'E13', '963852', '2016-01-01', true);
INSERT INTO `nfa021ProjetV2`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `parcLocation`) VALUES (DEFAULT, 'Clarinette en Ut', 'BUFFET CRAMPON', 'E13', '159753', '2021-01-01', true);
INSERT INTO `nfa021ProjetV2`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `parcLocation`) VALUES (DEFAULT, 'Clarinette en Ut', 'BUFFET CRAMPON', 'Prodige', '753951', '2019-01-01', true);
INSERT INTO `nfa021ProjetV2`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `parcLocation`) VALUES (DEFAULT, 'Clarinette en Sib', 'BUFFET CRAMPON', 'Prodige', '357159', '2012-01-01', true);

COMMIT;


-- -----------------------------------------------------
-- Data for table `nfa021ProjetV2`.`ENTRETIEN`
-- Création des premiers entretiens
-- -----------------------------------------------------
START TRANSACTION;
USE `nfa021ProjetV2`;
INSERT INTO `nfa021ProjetV2`.`ENTRETIEN` (`idEntretien`, `dateEntretien`, `descriptionEntretien`, `prixEntretien`, `fkIdInstrument`) VALUES (DEFAULT, '2020-03-31', 'Révision complète avec detection de fuite corps du bas. ', 250.55, 4);
INSERT INTO `nfa021ProjetV2`.`ENTRETIEN` (`idEntretien`, `dateEntretien`, `descriptionEntretien`, `prixEntretien`, `fkIdInstrument`) VALUES (DEFAULT, '2019-06-18', 'Révision partielle', 100, 1);
INSERT INTO `nfa021ProjetV2`.`ENTRETIEN` (`idEntretien`, `dateEntretien`, `descriptionEntretien`, `prixEntretien`, `fkIdInstrument`) VALUES (DEFAULT, '2021-03-16', 'Révision partielle avec changement ressorts, tampons.', 185, 3);
INSERT INTO `nfa021ProjetV2`.`ENTRETIEN` (`idEntretien`, `dateEntretien`, `descriptionEntretien`, `prixEntretien`, `fkIdInstrument`) VALUES (DEFAULT, '2020-09-08', 'Réglage du mécanisme', 150.80, 2);
INSERT INTO `nfa021ProjetV2`.`ENTRETIEN` (`idEntretien`, `dateEntretien`, `descriptionEntretien`, `prixEntretien`, `fkIdInstrument`) VALUES (DEFAULT, '2020-09-08', 'Révision complète', 500, 6);

COMMIT;


-- -----------------------------------------------------
-- Data for table `nfa021ProjetV2`.`FORFAIT`
-- Création des premiers tarifs de location
-- -----------------------------------------------------
START TRANSACTION;
USE `nfa021ProjetV2`;
INSERT INTO `nfa021ProjetV2`.`FORFAIT` (`idForfait`, `duree`, `tarif`) VALUES (DEFAULT, 'Tarif trismestriel', 90);
INSERT INTO `nfa021ProjetV2`.`FORFAIT` (`idForfait`, `duree`, `tarif`) VALUES (DEFAULT, 'Tarif annuel', 180);

COMMIT;


-- -----------------------------------------------------
-- Data for table `nfa021ProjetV2`.`LOCATION`
-- Création des premières locations
-- -----------------------------------------------------
START TRANSACTION;
USE `nfa021ProjetV2`;
INSERT INTO `nfa021ProjetV2`.`LOCATION` (`idLocation`, `dateLocation`, `finLocation`, `fkIdClient`, `fkIdForfait`, `fkIdInstrument`, `fkIdInstruLoc`) VALUES (DEFAULT, '2021-09-01', '2022-09-01', 2, 2, 13, 1);
INSERT INTO `nfa021ProjetV2`.`LOCATION` (`idLocation`, `dateLocation`, `finLocation`, `fkIdClient`, `fkIdForfait`, `fkIdInstrument`, `fkIdInstruLoc`) VALUES (DEFAULT, '2021-01-05', '2021-04-05', 5, 1, 14, 1);
INSERT INTO `nfa021ProjetV2`.`LOCATION` (`idLocation`, `dateLocation`, `finLocation`, `fkIdClient`, `fkIdForfait`, `fkIdInstrument`, `fkIdInstruLoc`) VALUES (DEFAULT, '2021-05-01', '2021-08-01', 3, 1, 15, 1);
INSERT INTO `nfa021ProjetV2`.`LOCATION` (`idLocation`, `dateLocation`, `finLocation`, `fkIdClient`, `fkIdForfait`, `fkIdInstrument`, `fkIdInstruLoc`) VALUES (DEFAULT, '2021-05-01', '2021-08-01', 6, 2, 16, 1);

COMMIT;

-- -----------------------------------------------------
-- Update for table `nfa021ProjetV2`.`INSTRUMENT`
-- Mise à jour des clés étrangères fkIdLocation suite à son peuplement
-- -----------------------------------------------------
START TRANSACTION;
USE `nfa021ProjetV2`;
UPDATE `nfa021ProjetV2`.`INSTRUMENT` SET `fkIdLocation` = 1, `fkIdClient` = 2 WHERE `idInstrument` = 13;
UPDATE `nfa021ProjetV2`.`INSTRUMENT` SET `fkIdLocation` = 2, `fkIdClient` = 5 WHERE `idInstrument` = 14;
UPDATE `nfa021ProjetV2`.`INSTRUMENT` SET `fkIdLocation` = 3, `fkIdClient` = 3 WHERE `idInstrument` = 15;
UPDATE `nfa021ProjetV2`.`INSTRUMENT` SET `fkIdLocation` = 4, `fkIdClient` = 6 WHERE `idInstrument` = 16;

COMMIT;
