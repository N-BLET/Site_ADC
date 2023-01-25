-- -----------------------------------------------------
-- Data for table `nfa021Projet`.`VILLE`
-- Création d'une première ville par défaut pour l'administrateur 
-- -----------------------------------------------------
START TRANSACTION;
USE `nfa021Projet`;
INSERT INTO `nfa021Projet`.`VILLE` (`idVille`, `cp`, `nomVille`, `departement`, `region`) VALUES (DEFAULT, '69230', 'SAINT GENIS LAVAL', 'RHÔNE (69)', 'AUVERGNE-RHÔNE-ALPES');
INSERT INTO `nfa021Projet`.`VILLE` (`idVille`, `cp`, `nomVille`, `departement`, `region`) VALUES (DEFAULT, '69000', 'LYON', 'RHÔNE (69)', 'AUVERGNE-RHÔNE-ALPES');
INSERT INTO `nfa021Projet`.`VILLE` (`idVille`, `cp`, `nomVille`, `departement`, `region`) VALUES (DEFAULT, '69100', 'VILLEURBANNE', 'RHÔNE (69)', 'AUVERGNE-RHÔNE-ALPES');
INSERT INTO `nfa021Projet`.`VILLE` (`idVille`, `cp`, `nomVille`, `departement`, `region`) VALUES (DEFAULT, '42460', 'JARNOSSE', 'LOIRE (42)', 'AUVERGNE-RHÔNE-ALPES');
INSERT INTO `nfa021Projet`.`VILLE` (`idVille`, `cp`, `nomVille`, `departement`, `region`) VALUES (DEFAULT, '75000', 'PARIS', 'PARIS (75)', 'ÎLE-DE-FRANCE');

COMMIT;


-- -----------------------------------------------------------------------------
-- Data for table `nfa021Projet`.`CLIENT`
-- Création des premiers clients
-- bletou@hotmail.fr "l'administrateur web" a pour mot de passe : AdcGj2021*
-- Les autres utilisateurs ont pour mot de passe Test1*
-- -----------------------------------------------------------------------------
START TRANSACTION;
USE `nfa021Projet`;
INSERT INTO `nfa021Projet`.`CLIENT` (`idClient`, `nom`, `prenom`, `adresse`, `telephone`, `email`, `password`, `profilAdmin`, `estValide`, `jetonValidation`, `fkIdVille`) VALUES (DEFAULT, 'BLET', 'Nicolas', '29 Rue des Halles', '06.63.49.03.39', 'bletou@hotmail.fr', '$2y$10$rMy9orR6RgmmZzujoCt.pev1.wwpfkMqEkN489/msHKrDYs4WcuWC', 1, 1, 0,1);
INSERT INTO `nfa021Projet`.`CLIENT` (`idClient`, `nom`, `prenom`, `adresse`, `telephone`, `email`, `password`, `profilAdmin`, `estValide`, `jetonValidation`, `fkIdVille`) VALUES (DEFAULT, 'GUICHON', 'Jocelyn', 'Le Bourg', '06.12.41.63.47', 'guichon.jocelyn@orange.fr', '$2y$10$3LVkTrGmOp888UgyOHOVu.WuAVI/8eQTRd4xWc/eEykTTGQiCpDbu', 1, 1, 0, 4);
INSERT INTO `nfa021Projet`.`CLIENT` (`idClient`, `nom`, `prenom`, `adresse`, `telephone`, `email`, `password`, `profilAdmin`, `estValide`, `jetonValidation`, `fkIdVille`) VALUES (DEFAULT, 'LAVILLE', 'Charlotte', '12 Rue des Platanes', '06.12.34.56.78', 'charlotte.laville@gmail.com', '$2y$10$D9se7vfmVmjwr1U7bfRbZePduk6J0kQImetRMRNJ1908J8M32B86O', 0, 1, 0, 3);
INSERT INTO `nfa021Projet`.`CLIENT` (`idClient`, `nom`, `prenom`, `adresse`, `telephone`, `email`, `password`, `profilAdmin`, `estValide`, `jetonValidation`, `fkIdVille`) VALUES (DEFAULT, 'GUICHON', 'Anne', 'Le Bourg', '06.98.76.54.32', 'anne.guichon@yahoo.fr', '$2y$10$AdHMUlbq77ghkD6K19A5JuskJfaCpJMcEizPpuJrEtWoR1ICFmDeC', 1, 1, 0, 4);
INSERT INTO `nfa021Projet`.`CLIENT` (`idClient`, `nom`, `prenom`, `adresse`, `telephone`, `email`, `password`, `profilAdmin`, `estValide`, `jetonValidation`, `fkIdVille`) VALUES (DEFAULT, 'VACHER', 'Manon', '56 Rue des Cerisiers', '01.23.45.67.89', 'manon.vacher@hotmail.com', '$2y$10$j/m17vhXWfHz3xAOJSYc2ONLj.3nHAZgShCj2u0RstgpByUHCHe/G', 0, 1, 0, 2);
INSERT INTO `nfa021Projet`.`CLIENT` (`idClient`, `nom`, `prenom`, `adresse`, `telephone`, `email`, `password`, `profilAdmin`, `estValide`, `jetonValidation`, `fkIdVille`) VALUES (DEFAULT, 'FREMEAUX', 'Pierre', '3 Allée des Lilas', '01.98.76.54.32', 'fremeaux.pierre@gmail.com', '$2y$10$bMGJPxs6/74uegA1bJTnLOpjCIqon5tpLK9rzvWOBp.wDWW2FYt16', 0, 1, 0, 5);

COMMIT;


-- -----------------------------------------------------
-- Data for table `nfa021Projet`.`INSTRUMENT`
-- Création des premiers instruments en gestion
-- -----------------------------------------------------
START TRANSACTION;
USE `nfa021Projet`;
INSERT INTO `nfa021Projet`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `fkIdClient`) VALUES (DEFAULT, 'Clarinette en Sib', 'BUFFET CRAMPON', 'Tosca', '662020', '2014-01-01', 3);
INSERT INTO `nfa021Projet`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `fkIdClient`) VALUES (DEFAULT, 'Clarinette en Sib', 'BUFFET CRAMPON', 'Tosca', '727644', '2019-01-01', 4);
INSERT INTO `nfa021Projet`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `fkIdClient`) VALUES (DEFAULT, 'Clarinette en Sib', 'BUFFET CRAMPON', 'Légende', '686757', '2020-01-01', 5);
INSERT INTO `nfa021Projet`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `fkIdClient`) VALUES (DEFAULT, 'Clarinette en Sib', 'BUFFET CRAMPON', 'Festival', '686771', '2015-01-01', 1);
INSERT INTO `nfa021Projet`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `fkIdClient`) VALUES (DEFAULT, 'Clarinette en La', 'BUFFET CRAMPON', 'RC', '709584', '2017-01-01', 5);
INSERT INTO `nfa021Projet`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `fkIdClient`) VALUES (DEFAULT, 'Clarinette Basse', 'BUFFET CRAMPON', 'Prestige', 'H42587', '2007-01-01', 3);
INSERT INTO `nfa021Projet`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `fkIdClient`) VALUES (DEFAULT, 'Clarinette Basse', 'BUFFET CRAMPON', 'Prestige', '33977', '2006-01-01', 1);
INSERT INTO `nfa021Projet`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `fkIdClient`) VALUES (DEFAULT, 'Clarinette en Mib', 'BUFFET CRAMPON', 'RC', '507566', '2003-01-01', 4);
INSERT INTO `nfa021Projet`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `fkIdClient`) VALUES (DEFAULT, 'Clarinette en Sib', 'BUFFET CRAMPON', 'E13', '123456', '2015-01-01', 3);
INSERT INTO `nfa021Projet`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `fkIdClient`) VALUES (DEFAULT, 'Clarinette en Sib', 'BUFFET CRAMPON', 'E13', '654321', '2020-01-01', 2);
INSERT INTO `nfa021Projet`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `fkIdClient`) VALUES (DEFAULT, 'Clarinette en Sib', 'BUFFET CRAMPON', 'Prodige', '112233', '2018-01-01', 6);
INSERT INTO `nfa021Projet`.`INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `fkIdClient`) VALUES (DEFAULT, 'Clarinette en Sib', 'BUFFET CRAMPON', 'Prodige', '332211', '2021-01-01', 6);

COMMIT;


-- -----------------------------------------------------
-- Data for table `nfa021Projet`.`ENTRETIEN`
-- Création des premiers entretiens
-- -----------------------------------------------------
START TRANSACTION;
USE `nfa021Projet`;
INSERT INTO `nfa021Projet`.`ENTRETIEN` (`idEntretien`, `dateEntretien`, `descriptionEntretien`, `prixEntretien`, `fkIdInstrument`) VALUES (DEFAULT, '2020-03-31', 'Révision complète avec detection de fuite corps du bas. ', 250.55, 4);
INSERT INTO `nfa021Projet`.`ENTRETIEN` (`idEntretien`, `dateEntretien`, `descriptionEntretien`, `prixEntretien`, `fkIdInstrument`) VALUES (DEFAULT, '2019-06-18', 'Révision partielle', 100, 1);
INSERT INTO `nfa021Projet`.`ENTRETIEN` (`idEntretien`, `dateEntretien`, `descriptionEntretien`, `prixEntretien`, `fkIdInstrument`) VALUES (DEFAULT, '2021-03-16', 'Révision partielle avec changement ressorts, tampons.', 185, 3);
INSERT INTO `nfa021Projet`.`ENTRETIEN` (`idEntretien`, `dateEntretien`, `descriptionEntretien`, `prixEntretien`, `fkIdInstrument`) VALUES (DEFAULT, '2020-09-08', 'Réglage du mécanisme', 150.80, 2);
INSERT INTO `nfa021Projet`.`ENTRETIEN` (`idEntretien`, `dateEntretien`, `descriptionEntretien`, `prixEntretien`, `fkIdInstrument`) VALUES (DEFAULT, '2020-09-08', 'Révision complète', 500, 6);

COMMIT;


-- -----------------------------------------------------
-- Data for table `nfa021Projet`.`FORFAIT`
-- Création des premiers tarifs de location
-- -----------------------------------------------------
START TRANSACTION;
USE `nfa021Projet`;
INSERT INTO `nfa021Projet`.`FORFAIT` (`idForfait`, `duree`, `tarif`) VALUES (DEFAULT, 'Tarif trismestriel', 90);
INSERT INTO `nfa021Projet`.`FORFAIT` (`idForfait`, `duree`, `tarif`) VALUES (DEFAULT, 'Tarif annuel', 180);

COMMIT;


-- -----------------------------------------------------
-- Data for table `nfa021Projet`.`INSTRUMENT_LOCATION`
-- Création des premiers instruments de location
-- -----------------------------------------------------
START TRANSACTION;
USE `nfa021Projet`;
INSERT INTO `nfa021Projet`.`INSTRUMENT_LOCATION` (`idInstruLoc`, `typeInstruLoc`, `marqueInstruLoc`, `modeleInstruLoc`, `numeroSerieInstruLoc`, `dateAchatInstruLoc`) VALUES (DEFAULT, 'Clarinette en Sib', 'BUFFET CRAMPON', 'Tosca', '012345', '2016-01-01');
INSERT INTO `nfa021Projet`.`INSTRUMENT_LOCATION` (`idInstruLoc`, `typeInstruLoc`, `marqueInstruLoc`, `modeleInstruLoc`, `numeroSerieInstruLoc`, `dateAchatInstruLoc`) VALUES (DEFAULT, 'Clarinette en Ut', 'BUFFET CRAMPON', 'Tosca', '123456', '2018-01-01');
INSERT INTO `nfa021Projet`.`INSTRUMENT_LOCATION` (`idInstruLoc`, `typeInstruLoc`, `marqueInstruLoc`, `modeleInstruLoc`, `numeroSerieInstruLoc`, `dateAchatInstruLoc`) VALUES (DEFAULT, 'Clarinette en La', 'BUFFET CRAMPON', 'Légende', '654321', '2019-01-01');
INSERT INTO `nfa021Projet`.`INSTRUMENT_LOCATION` (`idInstruLoc`, `typeInstruLoc`, `marqueInstruLoc`, `modeleInstruLoc`, `numeroSerieInstruLoc`, `dateAchatInstruLoc`) VALUES (DEFAULT, 'Clarinette en Mib', 'BUFFET CRAMPON', 'Festival', '543210', '2015-01-01');
INSERT INTO `nfa021Projet`.`INSTRUMENT_LOCATION` (`idInstruLoc`, `typeInstruLoc`, `marqueInstruLoc`, `modeleInstruLoc`, `numeroSerieInstruLoc`, `dateAchatInstruLoc`) VALUES (DEFAULT, 'Clarinette Basse', 'BUFFET CRAMPON', 'RC', '45679', '2017-01-01');
INSERT INTO `nfa021Projet`.`INSTRUMENT_LOCATION` (`idInstruLoc`, `typeInstruLoc`, `marqueInstruLoc`, `modeleInstruLoc`, `numeroSerieInstruLoc`, `dateAchatInstruLoc`) VALUES (DEFAULT, 'Clarinette Alto', 'BUFFET CRAMPON', 'Prestige', '987654', '2008-01-01');
INSERT INTO `nfa021Projet`.`INSTRUMENT_LOCATION` (`idInstruLoc`, `typeInstruLoc`, `marqueInstruLoc`, `modeleInstruLoc`, `numeroSerieInstruLoc`, `dateAchatInstruLoc`) VALUES (DEFAULT, 'Clarinette en Sib', 'BUFFET CRAMPON', 'Prestige', '654321', '2007-01-01');
INSERT INTO `nfa021Projet`.`INSTRUMENT_LOCATION` (`idInstruLoc`, `typeInstruLoc`, `marqueInstruLoc`, `modeleInstruLoc`, `numeroSerieInstruLoc`, `dateAchatInstruLoc`) VALUES (DEFAULT, 'Clarinette en La', 'BUFFET CRAMPON', 'RC', '147258', '2004-01-01');
INSERT INTO `nfa021Projet`.`INSTRUMENT_LOCATION` (`idInstruLoc`, `typeInstruLoc`, `marqueInstruLoc`, `modeleInstruLoc`, `numeroSerieInstruLoc`, `dateAchatInstruLoc`) VALUES (DEFAULT, 'Clarinette en Ut', 'BUFFET CRAMPON', 'E13', '963852', '2016-01-01');
INSERT INTO `nfa021Projet`.`INSTRUMENT_LOCATION` (`idInstruLoc`, `typeInstruLoc`, `marqueInstruLoc`, `modeleInstruLoc`, `numeroSerieInstruLoc`, `dateAchatInstruLoc`) VALUES (DEFAULT, 'Clarinette en Ut', 'BUFFET CRAMPON', 'E13', '159753', '2021-01-01');
INSERT INTO `nfa021Projet`.`INSTRUMENT_LOCATION` (`idInstruLoc`, `typeInstruLoc`, `marqueInstruLoc`, `modeleInstruLoc`, `numeroSerieInstruLoc`, `dateAchatInstruLoc`) VALUES (DEFAULT, 'Clarinette en Ut', 'BUFFET CRAMPON', 'Prodige', '753951', '2019-01-01');
INSERT INTO `nfa021Projet`.`INSTRUMENT_LOCATION` (`idInstruLoc`, `typeInstruLoc`, `marqueInstruLoc`, `modeleInstruLoc`, `numeroSerieInstruLoc`, `dateAchatInstruLoc`) VALUES (DEFAULT, 'Clarinette en Sib', 'BUFFET CRAMPON', 'Prodige', '357159', '2012-01-01');

COMMIT;


-- -----------------------------------------------------
-- Data for table `nfa021Projet`.`LOCATION`
-- Création des premières locations
-- -----------------------------------------------------
START TRANSACTION;
USE `nfa021Projet`;
INSERT INTO `nfa021Projet`.`LOCATION` (`idLocation`, `dateLocation`, `finLocation`, `fkIdInstruLoc`, `fkIdClient`, `fkIdForfait`) VALUES (DEFAULT, '2021-09-01', '2022-09-01', 2, 4, 2);
INSERT INTO `nfa021Projet`.`LOCATION` (`idLocation`, `dateLocation`, `finLocation`, `fkIdInstruLoc`, `fkIdClient`, `fkIdForfait`) VALUES (DEFAULT, '2021-01-05', '2021-04-05', 8, 6, 1);
INSERT INTO `nfa021Projet`.`LOCATION` (`idLocation`, `dateLocation`, `finLocation`, `fkIdInstruLoc`, `fkIdClient`, `fkIdForfait`) VALUES (DEFAULT, '2021-05-01', '2021-08-01', 3, 2, 1);
INSERT INTO `nfa021Projet`.`LOCATION` (`idLocation`, `dateLocation`, `finLocation`, `fkIdInstruLoc`, `fkIdClient`, `fkIdForfait`) VALUES (DEFAULT, '2021-05-01', '2021-08-01', 6, 5, 1);

COMMIT;

