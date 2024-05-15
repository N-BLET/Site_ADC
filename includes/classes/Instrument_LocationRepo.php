<?php
require_once(__DIR__ . '/../bdd/bd.inc.php');

class Instrument_LocationRepo
{
	public static function getInstrument_Location(int $idInstruLoc)
	{
		$BD = connexionBD();

		$SQL = "SELECT idInstrument, typeInstrument, marque, modele, numeroSerie, dateAchat, parcLocation, fkIdClient, fkIdLocation " .
				"FROM `INSTRUMENT` " .
				"WHERE `INSTRUMENT`.idInstrument = :id;";

		$instruLoc  = null;

		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute(array(':id' => $idInstruLoc))) {
				if ($resultat = $requete->fetch(PDO::FETCH_ASSOC)) {
					$instruLoc = new Instrument($resultat["idInstrument"], $resultat["typeInstrument"], $resultat["marque"], $resultat["modele"], $resultat["numeroSerie"], $resultat["dateAchat"], $resultat["parcLocation"], $resultat["fkIdClient"], $resultat["fkIdLocation"]);
				}
			} else
				afficherErreurPDO(__FILE__, $requete);
		}

		return $instruLoc;
	}

	

	public static function getInstruments_Location()
	{
		$BD = connexionBD();
        $SQL = "SELECT idInstrument, typeInstrument, marque, modele, numeroSerie, dateAchat, statutLocation " .
        "FROM `INSTRUMENT` ";
		
		if (!empty($_GET["s"])) {
			$lettres = protectionDonneesFormulaire($_GET["s"]);
			$SQL .= "WHERE typeInstruLoc LIKE \"%".$lettres."%\";";
		}else if (!empty($_GET["q"])) {
			$lettres = protectionDonneesFormulaire($_GET["q"]);
			$SQL .= "WHERE modeleInstruLoc LIKE \"%".$lettres."%\";";
		}else if (!empty($_GET["r"])) {
			$lettres = protectionDonneesFormulaire($_GET["r"]);
			$SQL .= "WHERE numeroSerieInstruLoc LIKE \"%".$lettres."%\";";
		}
		
		$instruLocs  = array();
		
		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute()) {
				while ($resultat = $requete->fetch(PDO::FETCH_ASSOC)) {
					$instruLoc = new Instrument($resultat["idInstrument"], $resultat["typeInstrument"], $resultat["marque"], $resultat["modele"], $resultat["numeroSerie"], $resultat["dateAchat"], $resultat["parcLocation"], $resultat["fkIdClient"], $resultat["fkIdLocation"]);
					array_push($instruLocs, $instruLoc);
				}
			} else {
				afficherErreurPDO(__FILE__, $requete);
			}
		}

		return $instruLocs;
	}

    public static function insert(Instrument $instruLoc)
	{
		$BD = connexionBD();

		$data = [
			'idInstrument' => $instruLoc->getIdInstrument(),
			'typeInstrument' => ucwords($instruLoc->getTypeInstrument()),
			'marque' => strtoupper ($instruLoc->getMarque()),
			'modele' => ucfirst(strtolower($instruLoc->getModele())),
            'numeroSerie' => $instruLoc->getNumeroSerie(),
            'dateAchat' => $instruLoc->getDateAchatISO(),
			'parcLocation' => $instruLoc->isParcLocation(),
			'fkIdClient' => $instruLoc->getClient()->getIdClient(),
			'fkIdLocation' => $instruLoc->getLocation()->getIdLocation()
		];

		$SQL = "INSERT INTO `INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `parcLocation`, `fkIdClient`, `fkIdLocation`) VALUES (:idInstrument, :typeInstrument, :marque, :modele, :numeroSerie, :dateAchat, :parcLocation, :fkIdClient, :fkIdLocation);";
		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute($data)) {
				$instruLoc->setIdInstrument($BD->lastInsertId());
				return true;
			} else
				afficherErreurPDO(__FILE__, $requete);
		}
		return false;
	}
	
    public static function update(Instrument $instruLoc)
	{
		$BD = connexionBD();

		$data = [
			'idInstruLoc' => $instruLoc->getIdInstrument(),
			'typeInstruLoc' => ucwords($instruLoc->getTypeInstrument()),
			'marqueInstruLoc' => strtoupper ($instruLoc->getMarque()),
			'modeleInstruLoc' => ucfirst(strtolower($instruLoc->getModele())),
            'numeroSerieInstruLoc' => $instruLoc->getNumeroSerie(),
            'dateAchatInstruLoc' => $instruLoc->getDateAchatISO(),
			'parc'
		];

		$SQL = "UPDATE `INSTRUMENT` SET idInstrument=:idInstruLoc, typeInstrument=:typeInstruLoc, marque=:marqueInstruLoc, modele=:modeleInstruLoc, numeroSerie=:numeroSerieInstruLoc, dateAchatInstruLoc=:dateAchatInstruLoc WHERE idInstruLoc = :idInstruLoc;";
		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute($data)) {
				return true;
			} else
				afficherErreurPDO(__FILE__, $requete);
		}
		return false;
	}

    public static function delete(Instrument $instruLoc)
	{
		$BD = connexionBD();

		$data = [
			'idInstruLoc' => $instruLoc->getIdInstrument()
		];

		$SQL = "DELETE FROM `INSTRUMENT` WHERE idInstrument = :idInstruLoc;";
		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute($data)) {
				return true;
			} else
				afficherErreurPDO(__FILE__, $requete);
		}
		return false;
	}


}
