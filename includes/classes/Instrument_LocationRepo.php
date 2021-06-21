<?php
require_once(__DIR__ . '/../bdd/bd.inc.php');

class Instrument_LocationRepo
{
	public static function getInstrument_Location(int $idInstruLoc)
	{
		$BD = connexionBD();

		$SQL = "SELECT idInstruLoc, typeInstruLoc, marqueInstruLoc, modeleInstruLoc, numeroSerieInstruLoc, dateAchatInstruLoc " .
				"FROM `INSTRUMENT_LOCATION` " .
				"WHERE `INSTRUMENT_LOCATION`.idInstruLoc = :id;";

		$instruLoc  = null;

		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute(array(':id' => $idInstruLoc))) {
				if ($resultat = $requete->fetch(PDO::FETCH_ASSOC)) {
					$instruLoc = new Instrument_Location($resultat["idInstruLoc"],  $resultat["typeInstruLoc"], $resultat["marqueInstruLoc"], $resultat["modeleInstruLoc"], $resultat["numeroSerieInstruLoc"], $resultat["dateAchatInstruLoc"]);
				}
			} else
				afficherErreurPDO(__FILE__, $requete);
		}

		return $instruLoc;
	}

	

	public static function getInstruments_Location()
	{
		$BD = connexionBD();

        $SQL = "SELECT idInstruLoc, typeInstruLoc, marqueInstruLoc, modeleInstruLoc, numeroSerieInstruLoc, dateAchatInstruLoc " .
        "FROM `INSTRUMENT_LOCATION` ";

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
					$instruLoc = new Instrument_Location($resultat["idInstruLoc"],  $resultat["typeInstruLoc"], $resultat["marqueInstruLoc"], $resultat["modeleInstruLoc"], $resultat["numeroSerieInstruLoc"], $resultat["dateAchatInstruLoc"]);
					array_push($instruLocs, $instruLoc);
				}
			} else
				afficherErreurPDO(__FILE__, $requete);
		}

		return $instruLocs;
	}

    public static function insert(Instrument_Location $instruLoc)
	{
		$BD = connexionBD();

		$data = [
			'idInstruLoc' => $instruLoc->getIdInstrument(),
			'typeInstruLoc' => ucwords($instruLoc->getTypeInstrument()),
			'marqueInstruLoc' => strtoupper ($instruLoc->getMarque()),
			'modeleInstruLoc' => ucfirst(strtolower($instruLoc->getModele())),
            'numeroSerieInstruLoc' => $instruLoc->getNumeroSerie(),
            'dateAchatInstruLoc' => $instruLoc->getDateAchatISO()
		];

		$SQL = "INSERT INTO `INSTRUMENT_LOCATION` (`idInstruLoc`, `typeInstruLoc`, `marqueInstruLoc`, `modeleInstruLoc`, `numeroSerieInstruLoc`, `dateAchatInstruLoc`) VALUES (:idInstruLoc, :typeInstruLoc, :marqueInstruLoc, :modeleInstruLoc, :numeroSerieInstruLoc, :dateAchatInstruLoc);";
		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute($data)) {
				$instruLoc->setIdInstrument($BD->lastInsertId());
				return true;
			} else
				afficherErreurPDO(__FILE__, $requete);
		}
		return false;
	}
	
    public static function update(Instrument_Location $instruLoc)
	{
		$BD = connexionBD();

		$data = [
			'idInstruLoc' => $instruLoc->getIdInstrument(),
			'typeInstruLoc' => ucwords($instruLoc->getTypeInstrument()),
			'marqueInstruLoc' => strtoupper ($instruLoc->getMarque()),
			'modeleInstruLoc' => ucfirst(strtolower($instruLoc->getModele())),
            'numeroSerieInstruLoc' => $instruLoc->getNumeroSerie(),
            'dateAchatInstruLoc' => $instruLoc->getDateAchatISO()
		];

		$SQL = "UPDATE `INSTRUMENT_LOCATION` SET idInstruLoc=:idInstruLoc, typeInstruLoc=:typeInstruLoc, marqueInstruLoc=:marqueInstruLoc, modeleInstruLoc=:modeleInstruLoc, numeroSerieInstruLoc=:numeroSerieInstruLoc, dateAchatInstruLoc=:dateAchatInstruLoc WHERE idInstruLoc = :idInstruLoc;";
		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute($data)) {
				return true;
			} else
				afficherErreurPDO(__FILE__, $requete);
		}
		return false;
	}

    public static function delete(Instrument_Location $instruLoc)
	{
		$BD = connexionBD();

		$data = [
			'idInstruLoc' => $instruLoc->getIdInstrument()
		];

		$SQL = "DELETE FROM `INSTRUMENT_LOCATION` WHERE idInstruLoc = :idInstruLoc;";
		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute($data)) {
				return true;
			} else
				afficherErreurPDO(__FILE__, $requete);
		}
		return false;
	}


}
