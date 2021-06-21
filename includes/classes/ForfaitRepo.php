<?php
require_once(__DIR__ . '/../bdd/bd.inc.php');

class ForfaitRepo
{
    public static function getForfait(int $id)
	{
		$BD = connexionBD();

		$SQL = "SELECT idForfait, duree, tarif " .
			"FROM `FORFAIT` " .
			"WHERE `FORFAIT`.idForfait = :id;";

		$forfait  = null;

		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute(array(':id' => $id))) {
				if ($resultat = $requete->fetch(PDO::FETCH_ASSOC)) {
					$forfait = new Forfait($resultat["idForfait"], $resultat["duree"], $resultat["tarif"]);
				}
			} else
				afficherErreurPDO(__FILE__, $requete);
		}

		return $forfait;
	}

	public static function getForfaits()
	{
		$BD = connexionBD();

		$SQL = "SELECT idForfait, duree, tarif " .
			"FROM `FORFAIT`;";

		$forfaits  = array();

		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute()) {
				while ($resultat = $requete->fetch(PDO::FETCH_ASSOC)) {
					$forfait = new Forfait($resultat["idForfait"], $resultat["duree"], $resultat["tarif"]);
					array_push($forfaits, $forfait);
				}
			} else
				afficherErreurPDO(__FILE__, $requete);
		}
		return $forfaits;
	}

    public static function insert(Forfait $forfait)
	{
		$BD = connexionBD();

		$data = [
			'duree' => $forfait->getDuree(),
			'tarif' => ucfirst(strtolower($forfait->getTarif()))
		];

		$SQL = "INSERT INTO FORFAIT (duree, tarif) VALUES (:duree, :tarif);";
		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute($data)) {
				$forfait->setIdForfait($BD->lastInsertId());
				return true;
			} else
				afficherErreurPDO(__FILE__, $requete);
		}
		return false;
	}

	public static function update(Forfait $forfait)
	{
		$BD = connexionBD();

		$data = [
			'id' => $forfait->getIdForfait(),
			'duree' => $forfait->getDuree(),
			'tarif' =>ucfirst(strtolower($forfait->getTarif()))
		];

		$SQL = "UPDATE FORFAIT SET duree=:duree, tarif = :tarif WHERE idForfait = :id;";
		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute($data)) {
				return true;
			} else
				afficherErreurPDO(__FILE__, $requete);
		}
		return false;
	}

	public static function delete(Forfait $forfait)
	{
		$BD = connexionBD();

		$data = [
			'idForfait' => $forfait->getIdForfait()
		];

		$SQL = "DELETE FROM FORFAIT WHERE idForfait = :idForfait;";
		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute($data)) {
				return true;
			} else
				afficherErreurPDO(__FILE__, $requete);
		}
		return false;
	}
}