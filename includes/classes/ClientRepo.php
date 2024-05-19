<?php
require_once(__DIR__ . '/../bdd/bd.inc.php');

class ClientRepo
{
	public static $BD;
	public static function getClient(int $idClient)
	{
		if(empty ($BD)){
			$BD = connexionBD();
		} 

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
		if(empty ($BD)){
			$BD = connexionBD();
		} 

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
		if(empty ($BD)){
			$BD = connexionBD();
		} 

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
		if(empty ($BD)){
			$BD = connexionBD();
		} 

		$SQL = "SELECT idClient, nom, prenom, adresse, telephone, email, password, profilAdmin, estValide, jetonValidation, fkIdVille " .
				"FROM `CLIENT` ";
		
		if (!empty($_GET["q"])) {
			$lettres = protectionDonneesFormulaire($_GET["q"]);
			$SQL .= "WHERE nom LIKE \"".$lettres."%\";";
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
		
		if(empty ($BD)){
			$BD = connexionBD();
		} 
		
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
		if(empty ($BD)){
			$BD = connexionBD();
		} 

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
		if(empty ($BD)){
			$BD = connexionBD();
		} 

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
    if (empty($BD)) {
        $BD = connexionBD();
    } 

    try {
        // Démarrer une transaction
        $BD->beginTransaction();

        // Supprimer d'abord les locations associées au client
        $SQL_delete_locations = "DELETE FROM LOCATION WHERE fkIdClient = :idClient;";
        $data_delete_locations = [
            'idClient' => $client->getIdClient()
        ];

        $requete_delete_locations = $BD->prepare($SQL_delete_locations);
        $requete_delete_locations->execute($data_delete_locations);

        // Ensuite, supprimer les instruments associés au client
        $SQL_delete_instruments = "DELETE FROM INSTRUMENT WHERE fkIdClient = :idClient;";
        $data_delete_instruments = [
            'idClient' => $client->getIdClient()
        ];

        $requete_delete_instruments = $BD->prepare($SQL_delete_instruments);
        $requete_delete_instruments->execute($data_delete_instruments);

        // Enfin, supprimer le client lui-même
        $SQL_delete_client = "DELETE FROM CLIENT WHERE idClient = :idClient;";
        $data_delete_client = [
            'idClient' => $client->getIdClient()
        ];

        $requete_delete_client = $BD->prepare($SQL_delete_client);
        $requete_delete_client->execute($data_delete_client);

        // Valider la transaction
        $BD->commit();

        return true;
    } catch (PDOException $e) {
        // En cas d'erreur, annuler la transaction
        $BD->rollback();
        afficherErreurPDO(__FILE__, $e);
        return false;
    }
}

}
