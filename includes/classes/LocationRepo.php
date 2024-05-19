<?php
require_once(__DIR__ . '/../bdd/bd.inc.php');

class LocationRepo
{
	public static $BD;
    public static function getLocation(int $idLocation)
    {
        if(empty($BD)){
			$BD = connexionBD();
		}

        $SQL = "SELECT idLocation, dateLocation, finLocation, fkIdForfait, fkIdClient, fkIdInstrument ".
				"FROM `LOCATION` " .
                "WHERE `LOCATION`.idLocation = :id;";

        $location  = null;

        if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute(array(':id' => $idLocation))) {
                while ($resultat = $requete->fetch(PDO::FETCH_ASSOC)) {
					$location = new Location($resultat["idLocation"], $resultat["dateLocation"], $resultat["finLocation"], $resultat["fkIdForfait"], $resultat["fkIdClient"], $resultat["fkIdInstrument"]);
                }
            } else
                afficherErreurPDO(__FILE__, $requete);
        }

        return $location;
    }

    public static function getLocations()
    {
       if(empty($BD)){
			$BD = connexionBD();
		}

        $SQL = "SELECT idLocation, DATE_FORMAT (dateLocation, '%d/%m/%Y') AS dateLocation, DATE_FORMAT (finLocation, '%d/%m/%Y') AS finLocation, fkIdForfait, fkIdClient, fkIdInstrument ".
				"FROM `LOCATION`;";
		
		if (!empty($_GET["q"])) {
			$lettres = protectionDonneesFormulaire($_GET["q"]);
			$SQL .= "JOIN `CLIENT` ON `LOCATION`.fkIdClient = `CLIENT`.idClient " .
			"WHERE nom LIKE \"".$lettres."%\";";
		}

        $locations  = array();

        if ($requete = $BD->prepare($SQL)) {
            if ($requete->execute()) {
                while ($resultat = $requete->fetch(PDO::FETCH_ASSOC)) {
                    $location = new Location($resultat["idLocation"], $resultat["dateLocation"], $resultat["finLocation"], $resultat["fkIdForfait"], $resultat["fkIdClient"], $resultat["fkIdInstrument"]);
                    array_push($locations, $location);
                }
            } else{
                afficherErreurPDO(__FILE__, $requete);
			}
        }

        return $locations;
    }

	public static function getLocationSelonClient(int $idClient)
    {
		
		if(empty($BD)){
			$BD = connexionBD();
		}

		echo $idClient;

        $SQL = "SELECT idLocation, DATE_FORMAT (dateLocation, '%d/%m/%Y') AS dateLocation, DATE_FORMAT (finLocation, '%d/%m/%Y') AS finLocation, fkIdInstruLoc, fkIdForfait, fkIdClient, duree, tarif " .
			"FROM `LOCATION` " .
			"JOIN `CLIENT` ON `LOCATION`.fkIdClient = `CLIENT`.idClient " .
			"JOIN `FORFAIT` ON `LOCATION`.fkIdForfait = `FORFAIT`.idForfait " .
			"WHERE `CLIENT`.idClient= :id;";

        $locations  = array();
		echo $SQL;
        if ($requete = $BD->prepare($SQL)) {
            if ($requete->execute(array(':id' => $idClient))) {
                while ($resultat = $requete->fetch(PDO::FETCH_ASSOC)) {
                    $location = new Location($resultat["idLocation"], $resultat["dateLocation"], $resultat["finLocation"], $resultat["fkIdInstruLoc"], $resultat["fkIdForfait"], $resultat["fkIdClient"], $resultat["duree"], $resultat["tarif"]);
                    array_push($locations, $location);
                }
            } else {
                afficherErreurPDO(__FILE__, $requete);
			}
        }
		
        return $locations;
    }

    public static function insert(Location $location)
	{
		if(empty($BD)){
			$BD = connexionBD();
		}

		$data = [
			'dateLocation' => $location->getDateLocation(),
			'finLocation' => $location->getFinLocation(),
			'fkIdForfait' => $location->getFkIdForfait(),
			'fkIdClient' => $location->getFkIdClient(),
			'fkIdInstrument' => $location->getFkIdInstrument()
		];

		$SQL = "INSERT INTO `LOCATION` (dateLocation, finLocation, fkIdForfait, fkIdClient, fkIdInstrument) VALUES (:dateLocation, :finLocation, :fkIdForfait, :fkIdClient, :fkIdInstrument);";

		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute($data)) {
				$location->setIdLocation($BD->lastInsertId());
				return true;
			} else
				afficherErreurPDO(__FILE__, $requete);
		}
		return false;
	}
	
    public static function update(location $location)
	{
		if(empty($BD)){
			$BD = connexionBD();
		}

		$data = [
			'idLocation' => $location->getIdLocation(),
			'dateLocation' => $location->getDateLocation(),
			'finLocation' => $location->getFinLocation(),
			'fkIdInstruLoc' => $location->getInstrument()->getIdInstrument(),
			'fkIdForfait' => $location->getFkIdForfait(),
			'fkIdClient' => $location->getFkIdClient()
		];

		$SQL = "UPDATE `LOCATION` SET dateLocation=:dateLocation, finLocation=:finLocation, fkIdInstruLoc=:fkIdInstruLoc, fkIdForfait=:fkIdForfait, fkIdClient=:fkIdClient WHERE idLocation = :idLocation;";
		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute($data)) {
				return true;
			} else
				afficherErreurPDO(__FILE__, $requete);
		}
		return false;
	}

    public static function delete(location $location)
	{
		if(empty($BD)){
			$BD = connexionBD();
		}

		$data = [
			'idLocation' => $location->getIdLocation()
		];

		$SQL = "DELETE FROM `LOCATION` WHERE idLocation = :idLocation;";
		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute($data)) {
				return true;
			} else
				afficherErreurPDO(__FILE__, $requete);
		}
		return false;
	}
}