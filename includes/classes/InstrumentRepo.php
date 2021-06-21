<?php
require_once(__DIR__ . '/../bdd/bd.inc.php');

class InstrumentRepo
{
	public static function getInstrument(int $idInstrument)
	{
		$BD = connexionBD();

		$SQL = "SELECT idInstrument, typeInstrument, marque, modele, numeroSerie, dateAchat, fkIdClient " .
				"FROM `INSTRUMENT` " .
				"WHERE `INSTRUMENT`.idInstrument = :id;";

		$instrument  = null;

		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute(array(':id' => $idInstrument))) {
				if ($resultat = $requete->fetch(PDO::FETCH_ASSOC)) {
					$instrument = new Instrument($resultat["idInstrument"],  $resultat["typeInstrument"], $resultat["marque"], $resultat["modele"], $resultat["numeroSerie"], $resultat["dateAchat"], $resultat["fkIdClient"]);
				}
			} else
				afficherErreurPDO(__FILE__, $requete);
		}

		return $instrument;
	}

	public static function getInstruments()
	{
		$BD = connexionBD();

        $SQL = "SELECT idInstrument, typeInstrument, marque, modele, numeroSerie, dateAchat, fkIdClient " .
        "FROM `INSTRUMENT` ";

		if (!empty($_GET["q"])) {
			$lettres = protectionDonneesFormulaire($_GET["q"]);
			$SQL .= "JOIN `CLIENT` ON `INSTRUMENT`.fkIdClient = `CLIENT`.idClient " .
			"WHERE nom LIKE \"%".$lettres."%\";";
		}else if (!empty($_GET["r"])) {
			$lettres = protectionDonneesFormulaire($_GET["r"]);
			$SQL .= "WHERE numeroSerie LIKE \"%".$lettres."%\";";
		}


		$instruments  = array();

		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute()) {
				while ($resultat = $requete->fetch(PDO::FETCH_ASSOC)) {
					$instrument = new Instrument($resultat["idInstrument"],  $resultat["typeInstrument"], $resultat["marque"], $resultat["modele"], $resultat["numeroSerie"], $resultat["dateAchat"], $resultat["fkIdClient"]);
					array_push($instruments, $instrument);
				}
			} else
				afficherErreurPDO(__FILE__, $requete);
		}

		return $instruments;
	}

	public static function getInstruSelonClient(int $idClient)
	{
		$BD = connexionBD();

        $SQL = "SELECT idInstrument, typeInstrument, marque, modele, numeroSerie, dateAchat, fkIdClient " .
		"FROM `INSTRUMENT` " .
		"JOIN `CLIENT` ON `INSTRUMENT`.fkIdClient = `CLIENT`.idClient " .
		"WHERE `CLIENT`.idClient = :id;";

		echo $idClient;
		$instruments  = array();

		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute(array(':id' => $idClient))) {
				while ($resultat = $requete->fetch(PDO::FETCH_ASSOC)) {
					$instrument = new Instrument($resultat["idInstrument"],  $resultat["typeInstrument"], $resultat["marque"], $resultat["modele"], $resultat["numeroSerie"], $resultat["dateAchat"], $resultat["fkIdClient"]);
					array_push($instruments, $instrument);
				}
			} else
				afficherErreurPDO(__FILE__, $requete);
		}

		return $instruments;
	}

    public static function insert(Instrument $instrument)
	{
		$BD = connexionBD();

		$data = [
			'idInstrument' => $instrument->getIdInstrument(),
			'typeInstrument' => ucwords($instrument->getTypeInstrument()),
			'marque' => strtoupper ($instrument->getMarque()),
			'modele' => $instrument->getModele(),
            'numeroSerie' => $instrument->getNumeroSerie(),
            'dateAchat' => $instrument->getDateAchatISO(),
			'fkIdClient' => $instrument->getFkIdClient()
		];

		$SQL = "INSERT INTO `INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `fkIdClient`) VALUES (:idInstrument, :typeInstrument, :marque, :modele, :numeroSerie, :dateAchat, :fkIdClient);";
		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute($data)) {
				$instrument->setIdInstrument($BD->lastInsertId());
				return true;
			} else
				afficherErreurPDO(__FILE__, $requete);
		}
		return false;
	}
	
    public static function update(Instrument $instrument)
	{
		$BD = connexionBD();

		$data = [
			'idInstrument' => $instrument->getIdInstrument(),
			'typeInstrument' => ucwords($instrument->getTypeInstrument()),
			'marque' => strtoupper ($instrument->getMarque()),
			'modele' => ucfirst(strtolower($instrument->getModele())),
            'numeroSerie' => $instrument->getNumeroSerie(),
            'dateAchat' => $instrument->getDateAchatISO(),
			'fkIdClient' => $instrument->getClient()->getIdClient()
		];

		$SQL = "UPDATE `INSTRUMENT` SET idInstrument=:idInstrument, typeInstrument=:typeInstrument, marque=:marque, modele=:modele, numeroSerie=:numeroSerie, dateAchat=:dateAchat, fkIdClient=:fkIdClient WHERE idInstrument = :idInstrument;";
		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute($data)) {
				return true;
			} else
				afficherErreurPDO(__FILE__, $requete);
		}
		return false;
	}

    public static function delete(Instrument $instrument)
	{
		$BD = connexionBD();

		$data = [
			'idInstrument' => $instrument->getIdInstrument()
		];

		$SQL = "DELETE FROM `INSTRUMENT` WHERE idInstrument = :idInstrument;";
		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute($data)) {
				return true;
			} else
				afficherErreurPDO(__FILE__, $requete);
		}
		return false;
	}

}
