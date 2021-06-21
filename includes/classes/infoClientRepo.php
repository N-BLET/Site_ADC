<?php
require_once(__DIR__ . '/../bdd/bd.inc.php');

class InfoClientRepo
{
	public static function getClient(int $idClient)
	{
		$BD = connexionBD();

		$SQL = "SELECT idClient, nom, prenom, adresse, telephone, email, profilAdmin, estValide, jetonValidation, fkIdVille " .
				"FROM `CLIENT` " .
				"WHERE `CLIENT`.idClient = :id;";

		$client  = null;

		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute(array(':id' => $idClient))) {
				if ($resultat = $requete->fetch(PDO::FETCH_ASSOC)) {
					$client = new Client($resultat["idClient"], $resultat["nom"], $resultat["prenom"], $resultat["adresse"],  $resultat["telephone"], $resultat["email"], "", $resultat["profilAdmin"], $resultat["estValide"], $resultat["jetonValidation"], $resultat["fkIdVille"]);
				}
			} else
				afficherErreurPDO(__FILE__, $requete);
		}

		return $client;
	}

}
