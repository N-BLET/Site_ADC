<?php
require_once(__DIR__ . '/../bdd/bd.inc.php');

class EntretienRepo
{
    public static function getEntretien(int $id)
	{
		$BD = connexionBD();

		$SQL = "SELECT idEntretien, dateEntretien, descriptionEntretien, prixEntretien, fkIdInstrument, nom " .
			"FROM `ENTRETIEN` " .
			"JOIN `INSTRUMENT` ON `ENTRETIEN`.`fkIdInstrument` = `INSTRUMENT`.`idInstrument` " .
            "JOIN `CLIENT` ON `INSTRUMENT`.`fkIdClient` = `CLIENT`.`idClient` " .
			"WHERE `ENTRETIEN`.idEntretien = :id;";

		$entretien  = null;

		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute(array(':id' => $id))) {
				if ($resultat = $requete->fetch(PDO::FETCH_ASSOC)) {
					$entretien = new Entretien($resultat["idEntretien"], $resultat["dateEntretien"], $resultat["descriptionEntretien"], $resultat["prixEntretien"], $resultat["fkIdInstrument"], $resultat["nom"]);
				}
			} else
				afficherErreurPDO(__FILE__, $requete);
		}

		return $entretien;
	}

	public static function getEntretiens()
	{
		$BD = connexionBD();

		$SQL = "SELECT idEntretien, dateEntretien, descriptionEntretien, prixEntretien, fkIdInstrument, fkIdClient, nom " .
			"FROM `ENTRETIEN` " .
			"JOIN `INSTRUMENT` ON `ENTRETIEN`.`fkIdInstrument` = `INSTRUMENT`.`idInstrument` " .
            "JOIN `CLIENT` ON `INSTRUMENT`.`fkIdClient` = `CLIENT`.`idClient` ";

			if (!empty($_GET["q"])) {
				$lettres = protectionDonneesFormulaire($_GET["q"]);
				$SQL .= "WHERE nom LIKE \"%".$lettres."%\";";
			}else if (!empty($_GET["r"])) {
				$lettres = protectionDonneesFormulaire($_GET["r"]);
				$SQL .= "WHERE numeroSerie LIKE \"%".$lettres."%\";";
			}

		$entretiens  = array();

		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute()) {
				while ($resultat = $requete->fetch(PDO::FETCH_ASSOC)) {
					$entretien = new Entretien($resultat["idEntretien"], $resultat["dateEntretien"], $resultat["descriptionEntretien"], $resultat["prixEntretien"], $resultat["fkIdInstrument"], $resultat["nom"]);
					array_push($entretiens, $entretien);
				}
			} else
				afficherErreurPDO(__FILE__, $requete);
		}
		return $entretiens;
	}

	public static function getEntretiensSelonClient(int $idClient)
	{
		$BD = connexionBD();

		$SQL = "SELECT idEntretien, dateEntretien, descriptionEntretien, prixEntretien, fkIdInstrument, nom " .
			"FROM `ENTRETIEN` " .
			"JOIN `INSTRUMENT` ON `ENTRETIEN`.`fkIdInstrument` = `INSTRUMENT`.`idInstrument` " .
            "JOIN `CLIENT` ON `INSTRUMENT`.`fkIdClient` = `CLIENT`.`idClient` " .
			"WHERE `ENTRETIEN`.idEntretien = :id;";

			$entretiens  = array();

		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute(array(':id' => $idClient))) {
				if ($resultat = $requete->fetch(PDO::FETCH_ASSOC)) {
					$entretien = new Entretien($resultat["idEntretien"], $resultat["dateEntretien"], $resultat["descriptionEntretien"], $resultat["prixEntretien"], $resultat["fkIdInstrument"], $resultat["nom"]);
					array_push($entretiens, $entretien);
				}
			} else
				afficherErreurPDO(__FILE__, $requete);
		}

		return $entretiens;
	}

    public static function insert(Entretien $entretien)
	{
		$BD = connexionBD();

		$data = [
			'dateEntretien' => $entretien->getDateEntretienISO(),
            'descriptionEntretien' => $entretien->getDescriptionEntretien(),
            'prixEntretien' => $entretien->getPrixEntretien(),
			'fkIdInstrument' => $entretien->getFkIdInstrument()
		];
		
		$SQL = "INSERT INTO `ENTRETIEN` (dateEntretien, descriptionEntretien, prixEntretien, fkIdInstrument) VALUES (:dateEntretien, :descriptionEntretien, :prixEntretien, :fkIdInstrument);";
		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute($data)) {
				$entretien->setIdEntretien($BD->lastInsertId());
				return true;
			} else {
				afficherErreurPDO(__FILE__, $requete);
			}
		}
		return false;
	}

	public static function update(Entretien $entretien)
	{
		$BD = connexionBD();

		$data = [
			'idEntretien' => $entretien->getIdEntretien(),
            'dateEntretien' => $entretien->getDateEntretienISO(),
            'descriptionEntretien' => $entretien->getDescriptionEntretien(),
            'prixEntretien' => $entretien->getPrixEntretien()
		];

		$SQL = "UPDATE ENTRETIEN SET dateEntretien=:dateEntretien, descriptionEntretien=:descriptionEntretien, prixEntretien=:prixEntretien WHERE idEntretien = :idEntretien;";
		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute($data)) {
				return true;
			} else
				afficherErreurPDO(__FILE__, $requete);
		}
		return false;
	}

	public static function delete(Entretien $entretien)
	{
		$BD = connexionBD();

		$data = [
			'idEntretien' => $entretien->getIdEntretien()
		];

		$SQL = "DELETE FROM ENTRETIEN WHERE idEntretien = :idEntretien;";
		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute($data)) {
				return true;
			} else
				afficherErreurPDO(__FILE__, $requete);
		}
		return false;
	}
}