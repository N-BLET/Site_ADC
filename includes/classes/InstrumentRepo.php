<?php
require_once(__DIR__ . '/../bdd/bd.inc.php');

class InstrumentRepo
{
	public static $BD;
	public static function getInstrument(int $idInstrument)
	{
		if(empty ($BD)){
			$BD = connexionBD();
		} 
		
		$SQL = "SELECT idInstrument, typeInstrument, marque, modele, numeroSerie, dateAchat, parcLocation, fkIdClient, fkIdLocation " .
				"FROM `INSTRUMENT` " .
				"WHERE `INSTRUMENT`.idInstrument = :id;";

		$instrument  = null;

		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute(array(':id' => $idInstrument))) {
				if ($resultat = $requete->fetch(PDO::FETCH_ASSOC)) {
					$instrument = new Instrument($resultat["idInstrument"],  $resultat["typeInstrument"], $resultat["marque"], $resultat["modele"], $resultat["numeroSerie"], $resultat["dateAchat"], $resultat["parcLocation"], $resultat["fkIdClient"], $resultat["fkIdLocation"]);
				}
			} else
				afficherErreurPDO(__FILE__, $requete);
		}

		return $instrument;
	}

		public static function getInstruments()
		{
			if(empty ($BD)){
				$BD = connexionBD();
			} 
			
			$SQL = "SELECT idInstrument, typeInstrument, marque, modele, numeroSerie, dateAchat, parcLocation, fkIdClient, fkIdLocation " .
			"FROM `INSTRUMENT` ";

			$instruments  = array();

			if ($requete = $BD->prepare($SQL)) {
				if ($requete->execute()) {
					while ($resultat = $requete->fetch(PDO::FETCH_ASSOC)) {
						$instrument = new Instrument($resultat["idInstrument"], $resultat["typeInstrument"], $resultat["marque"], $resultat["modele"], $resultat["numeroSerie"], $resultat["dateAchat"], $resultat["parcLocation"], $resultat["fkIdClient"], $resultat["fkIdLocation"]);
						array_push($instruments, $instrument);
					}
				} else
					afficherErreurPDO(__FILE__, $requete);
			}

			return $instruments;
		}

		public static function getInstrumentsClient()
		{
			if(empty ($BD)){
				$BD = connexionBD();
			} 
			
			$SQL = "SELECT idInstrument, typeInstrument, marque, modele, numeroSerie, dateAchat, parcLocation, fkIdClient, fkIdLocation " .
			"FROM `INSTRUMENT` ";
			if (empty($_GET["q"])){
				$SQL .= "WHERE `INSTRUMENT`.parcLocation = false ";
			}

			if (!empty($_GET["q"])) {
				$lettres = protectionDonneesFormulaire($_GET["q"]);
				$SQL .= "JOIN `CLIENT` ON `INSTRUMENT`.fkIdClient = `CLIENT`.idClient " .
				"WHERE nom LIKE \"".$lettres."%\";";
			}else if (!empty($_GET["r"])) {
				$lettres = protectionDonneesFormulaire($_GET["r"]);
				$SQL .= "AND numeroSerie LIKE \"".$lettres."%\";";
			}


			$instruments  = array();

			if ($requete = $BD->prepare($SQL)) {
				if ($requete->execute()) {
					while ($resultat = $requete->fetch(PDO::FETCH_ASSOC)) {
						$instrument = new Instrument($resultat["idInstrument"], $resultat["typeInstrument"], $resultat["marque"], $resultat["modele"], $resultat["numeroSerie"], $resultat["dateAchat"], $resultat["parcLocation"], $resultat["fkIdClient"], $resultat["fkIdLocation"]);
						array_push($instruments, $instrument);
					}
				} else
					afficherErreurPDO(__FILE__, $requete);
			}

			return $instruments;
		}

	public static function getInstrumentsLocation()
	{
		if(empty ($BD)){
			$BD = connexionBD();
		} 
		
        $SQL = "SELECT idInstrument, typeInstrument, marque, modele, numeroSerie, dateAchat, parcLocation, fkIdClient, fkIdLocation " .
        "FROM `INSTRUMENT` ";
		if (empty($_GET["q"])){
			$SQL .= "WHERE `INSTRUMENT`.parcLocation = true ";
		}

		if (!empty($_GET["q"])) {
			$lettres = protectionDonneesFormulaire($_GET["q"]);
			$SQL .= "JOIN `CLIENT` ON `INSTRUMENT`.fkIdClient = `CLIENT`.idClient " .
			"WHERE nom LIKE \"".$lettres."%\";";
		}else if (!empty($_GET["r"])) {
			$lettres = protectionDonneesFormulaire($_GET["r"]);
			$SQL .= "AND numeroSerie LIKE \"".$lettres."%\";";
		}


		$instruments  = array();

		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute()) {
				while ($resultat = $requete->fetch(PDO::FETCH_ASSOC)) {
					$instrument = new Instrument($resultat["idInstrument"], $resultat["typeInstrument"], $resultat["marque"], $resultat["modele"], $resultat["numeroSerie"], $resultat["dateAchat"], $resultat["parcLocation"], $resultat["fkIdClient"], $resultat["fkIdLocation"]);
					array_push($instruments, $instrument);
				}
			} else
				afficherErreurPDO(__FILE__, $requete);
		}

		return $instruments;
	}

	public static function getInstrumentsLibresLocation()
	{
		if(empty ($BD)){
			$BD = connexionBD();
		} 
		
        $SQL = "SELECT idInstrument, typeInstrument, marque, modele, numeroSerie, dateAchat, parcLocation, fkIdClient, fkIdLocation " .
        "FROM `INSTRUMENT` WHERE `INSTRUMENT`.parcLocation = true AND `INSTRUMENT`.fkIdLocation is null;";
	
		$instruments  = array();

		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute()) {
				while ($resultat = $requete->fetch(PDO::FETCH_ASSOC)) {
					$instrument = new Instrument($resultat["idInstrument"], $resultat["typeInstrument"], $resultat["marque"], $resultat["modele"], $resultat["numeroSerie"], $resultat["dateAchat"], $resultat["parcLocation"], $resultat["fkIdClient"], $resultat["fkIdLocation"]);
					array_push($instruments, $instrument);
				}
			} else
				afficherErreurPDO(__FILE__, $requete);
		}

		return $instruments;
	}

	public static function getInstrumentLocation(int $idInstruLoc)
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


	public static function getInstruSelonClient(int $idClient)
	{
		if(empty ($BD)){
			$BD = connexionBD();
		} 

        $SQL = "SELECT idInstrument, typeInstrument, marque, modele, numeroSerie, dateAchat, parcLocation, fkIdClient, fkIdLocation " .
		"FROM `INSTRUMENT` " .
		"JOIN `CLIENT` ON `INSTRUMENT`.fkIdClient = `CLIENT`.idClient " .
		"WHERE `CLIENT`.idClient = :id;";
		
		$instruments  = array();

		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute(array(':id' => $idClient))) {
				while ($resultat = $requete->fetch(PDO::FETCH_ASSOC)) {
					$instrument = new Instrument($resultat["idInstrument"],  $resultat["typeInstrument"], $resultat["marque"], $resultat["modele"], $resultat["numeroSerie"], $resultat["dateAchat"], $resultat["parcLocation"], $resultat["fkIdClient"], $resultat["fkIdLocation"]);
					array_push($instruments, $instrument);
				}
			} else
				afficherErreurPDO(__FILE__, $requete);
		}

		return $instruments;
	}

    public static function insert(Instrument $instrument)
	{
		if(empty ($BD)){
			$BD = connexionBD();
		} 

		$data = [
			'idInstrument' => $instrument->getIdInstrument(),
			'typeInstrument' => ucwords($instrument->getTypeInstrument()),
			'marque' => strtoupper($instrument->getMarque()),
			'modele' => $instrument->getModele(),
			'numeroSerie' => $instrument->getNumeroSerie(),
			'dateAchat' => $instrument->getDateAchat(),
			'fkIdClient' => $instrument->getFkIdClient() == 0 ? null : $instrument->getFkIdClient(),
			'parcLocation' => $instrument->getFkIdClient() !== null ? false : true,
			'fkIdLocation' => null
		];
		

		$SQL = "INSERT INTO `INSTRUMENT` (`idInstrument`, `typeInstrument`, `marque`, `modele`, `numeroSerie`, `dateAchat`, `parcLocation`, `fkIdClient`, `fkIdLocation`) VALUES (:idInstrument, :typeInstrument, :marque, :modele, :numeroSerie, :dateAchat, :parcLocation, :fkIdClient, :fkIdLocation);";
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
		if(empty ($BD)){
			$BD = connexionBD();
		} 

		$data = [
			'idInstrument' => $instrument->getIdInstrument(),
			'typeInstrument' => ucwords($instrument->getTypeInstrument()),
			'marque' => strtoupper ($instrument->getMarque()),
			'modele' => ucfirst(strtolower($instrument->getModele())),
            'numeroSerie' => $instrument->getNumeroSerie(),
            'dateAchat' => $instrument->getDateAchat(),
			'fkIdClient' => $instrument->getFkIdClient()
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
		if(empty ($BD)){
			$BD = connexionBD();
		} 

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
