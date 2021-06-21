<?php
require_once(__DIR__ . '/../bdd/bd.inc.php');

class ClientRepo
{
	public static function getClient(int $idClient)
	{
		$BD = connexionBD();

		$SQL = "SELECT idClient, nom, prenom, adresse, telephone, email, password, profilAdmin, estValide, jetonValidation, fkIdVille " .
				"FROM `CLIENT` " .
				"WHERE `CLIENT`.idClient = :id;";

		$client  = null;

		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute(array(':id' => $idClient))) {
				if ($resultat = $requete->fetch(PDO::FETCH_ASSOC)) {
					$client = new Client($resultat["idClient"], $resultat["nom"], $resultat["prenom"], $resultat["adresse"],  $resultat["telephone"], $resultat["email"], $resultat["password"], $resultat["profilAdmin"], $resultat["estValide"], $resultat["jetonValidation"], $resultat["fkIdVille"]);
				}
			} else
				afficherErreurPDO(__FILE__, $requete);
		}

		return $client;
	}

	public static function getAdmin($profilAdmin)
	{
		$BD = connexionBD();

		$SQL = "SELECT idClient, nom, prenom, adresse, telephone, email, password, profilAdmin, estValide, jetonValidation, fkIdVille " .
				"FROM `CLIENT` ";

		if(isset($profilAdmin))
		{
			$SQL = $SQL."WHERE profilAdmin = :profilAdmin;";
		}
		
		$clients  = array();

		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute(array(':profilAdmin' => $profilAdmin))) {
				while ($resultat = $requete->fetch(PDO::FETCH_ASSOC)) {
					$client = new Client($resultat["idClient"], $resultat["nom"], $resultat["prenom"], $resultat["adresse"], $resultat["telephone"], $resultat["email"], "", $resultat["profilAdmin"], $resultat["estValide"], $resultat["jetonValidation"],$resultat["fkIdVille"]);
					array_push($clients, $client);
				}
			} else
				afficherErreurPDO(__FILE__, $requete);
		}

		return $clients;
	}
	

	public static function getClientSelonJeton(string $jeton)
	{
		$BD = connexionBD();

		$SQL = "SELECT idClient, nom, prenom, adresse, telephone, email, password, profilAdmin, estValide, jetonValidation, fkIdVille " .
			"FROM `CLIENT` " .
			"WHERE `CLIENT`.jetonValidation= :jeton;";

		$client  = null;

		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute(array(':jeton' => $jeton))) {
				if ($resultat = $requete->fetch(PDO::FETCH_ASSOC)) {
					$client = new Client($resultat["idClient"], $resultat["nom"], $resultat["prenom"], $resultat["adresse"], $resultat["telephone"], $resultat["email"], $resultat["password"], $resultat["profilAdmin"], $resultat["estValide"], $resultat["jetonValidation"], $resultat["fkIdVille"]);
				}
			} else
				afficherErreurPDO(__FILE__, $requete);
		}

		return $client;
	}


	public static function getClients()
	{
		$BD = connexionBD();

		$SQL = "SELECT idClient, nom, prenom, adresse, telephone, email, password, profilAdmin, estValide, jetonValidation, fkIdVille " .
				"FROM `CLIENT` ";
		
		if (!empty($_GET["q"])) {
			$lettres = protectionDonneesFormulaire($_GET["q"]);
			$SQL .= "WHERE nom LIKE \"%".$lettres."%\";";
		}

		$clients  = array();

		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute()) {
				while ($resultat = $requete->fetch(PDO::FETCH_ASSOC)) {
					$client = new Client($resultat["idClient"], $resultat["nom"], $resultat["prenom"], $resultat["adresse"], $resultat["telephone"], $resultat["email"], "", $resultat["profilAdmin"], $resultat["estValide"], $resultat["jetonValidation"], $resultat["fkIdVille"]);
					array_push($clients, $client);
				}
			} else
				afficherErreurPDO(__FILE__, $requete);
		}
		return $clients;
	}



	public static function authentification(string $email, string $password)
	{
		
		$BD = connexionBD();
		
		$SQL = "SELECT idClient, nom, prenom, adresse, telephone, email, password, profilAdmin, estValide, jetonValidation, fkIdVille " .
		"FROM `CLIENT` " .
		"WHERE `CLIENT`.email = :email;";

		$client  = null;

		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute(array(':email' => $email))) {
				if ($resultat = $requete->fetch(PDO::FETCH_ASSOC)) {
					$client = new Client($resultat["idClient"], $resultat["nom"], $resultat["prenom"], $resultat["adresse"], $resultat["telephone"], $resultat["email"], $resultat["password"], $resultat["profilAdmin"], $resultat["estValide"], $resultat["jetonValidation"], $resultat["fkIdVille"]);
					if (!$client->getEstValide() || !password_verify($password, $client->getPassword()))
						return null;
				}
			} else
				afficherErreurPDO(__FILE__, $requete);
		}
		return $client;
	}

	public static function insert(Client $client)
	{
		$BD = connexionBD();

		$data = [
			'nom' => strtoupper ($client->getNom()),
            'prenom' => ucfirst(strtolower($client->getPrenom())),
            'adresse' => $client->getAdresse(),
            'telephone' => $client->getTelephone(),
			'email' => strtolower ($client->getEmail()),
			'password' => $client->getPassword(),
			'profilAdmin' => ($client->getProfilAdmin()) ? 1 : 0,
			'estValide' => ($client->getEstValide()) ? 1 : 0,
			'jetonValidation' => $client->getJetonValidation(),
			'fkIdVille' => $client->getFkIdVille()
		];

		$SQL = "INSERT INTO CLIENT (nom, prenom, adresse, telephone, email, password, profilAdmin, estValide, jetonValidation, fkIdVille) VALUES (:nom, :prenom, :adresse, :telephone, :email, :password, :profilAdmin, :estValide, :jetonValidation, :fkIdVille);";
		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute($data)) {
				$client->setIdClient($BD->lastInsertId());
				return true;
			} else
				afficherErreurPDO(__FILE__, $requete);
		}
		return false;
	}

	public static function update(Client $client)
	{
		$BD = connexionBD();

		$data = [
			'id' => $client->getIdClient(),
			'nom' => strtoupper ($client->getNom()),
            'prenom' => ucfirst(strtolower($client->getPrenom())),
            'adresse' => $client->getAdresse(),
			'fkIdVille' => $client->getFkIdVille(),
            'telephone' => $client->getTelephone(),
			'email' => strtolower ($client->getEmail()),
			'password' =>$client->getPassword(),
			'profilAdmin' =>($client->getProfilAdmin()) ? 1 : 0,
			'estValide' => ($client->getEstValide()) ? 1 : 0
		];

		$SQL = "UPDATE CLIENT SET nom=:nom, prenom=:prenom, adresse=:adresse, telephone=:telephone, email=:email, password=:password, profilAdmin=:profilAdmin, estValide=:estValide, fkIdVille=:fkIdVille WHERE idClient = :id;";
		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute($data)) {
				return true;
			} else
				afficherErreurPDO(__FILE__, $requete);
		}
		return false;
	}

	public static function delete(Client $client)
	{
		$BD = connexionBD();

		$data = [
			'idClient' => $client->getIdClient()
		];

		$SQL = "DELETE FROM CLIENT WHERE idClient = :idClient;";
		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute($data)) {
				return true;
			} else
				afficherErreurPDO(__FILE__, $requete);
		}
		return false;
	}
}
