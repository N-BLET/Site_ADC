<?php
require_once(__DIR__ . '/../bdd/bd.inc.php');

class VilleRepo
{
    public static function getVille(int $id)
	{
		$BD = connexionBD();

		$SQL = "SELECT  idVille, cp, nomVille, departement, region " .
			"FROM `VILLE` " .
			"WHERE `VILLE`.idVille = :id;";

		$ville  = null;

		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute(array(':id' => $id))) {
				if ($resultat = $requete->fetch(PDO::FETCH_ASSOC)) {
                    $ville = new Ville($resultat["idVille"], $resultat["cp"], $resultat["nomVille"], $resultat["departement"], $resultat["region"]);
				}
			} else
				afficherErreurPDO(__FILE__, $requete);
		}

		return $ville;
	}

	public static function getVilles()
	{
		$BD = connexionBD();

		$SQL = "SELECT  idVille, cp, nomVille, departement, region " .
			"FROM `VILLE` ";

			if (!empty($_GET["q"])) {
				
				$lettres = protectionDonneesFormulaire($_GET["q"]);
				$SQL .= "WHERE nomVille LIKE \"".$lettres."%\";";
				}

		$villes  = array();

		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute()) {
				while ($resultat = $requete->fetch(PDO::FETCH_ASSOC)) {
					$ville = new Ville($resultat["idVille"], $resultat["cp"], $resultat["nomVille"], $resultat["departement"], $resultat["region"]);
					array_push($villes, $ville);
				}
			} else
				afficherErreurPDO(__FILE__, $requete);
		}
		return $villes;
	}

    public static function verifDoublon(string $nomVille)
    {

        $BD = connexionBD();

        $SQL = "SELECT idVille, cp, nomVille, departement, region " .
            "FROM `VILLE` " .
            "WHERE `VILLE`.nomVille = :nomVille;";
		
			
		$ville  = null;

		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute(array(':nomVille' => $nomVille))) {
				if ($resultat = $requete->fetch(PDO::FETCH_ASSOC)) {
                    $ville = new Ville($resultat["idVille"], $resultat["cp"], $resultat["nomVille"], $resultat["departement"], $resultat["region"]);
				}
			} else
				afficherErreurPDO(__FILE__, $requete);
		}

		return $ville;
	}

    public static function insert(Ville $ville)
	{
		$BD = connexionBD();

		$data = [
            'nomVille' => strtoupper ($ville->getNomVille()),
			'cp' => $ville->getCp(),
            'departement' => strtoupper ($ville->getDepartement()),
            'region' => strtoupper ($ville->getRegion())
		];
	
		$verifDoublonVille = VilleRepo::verifDoublon($ville->getNomVille());
		if($verifDoublonVille != null)
			return false;

		$SQL = "INSERT INTO VILLE (cp, nomVille, departement, region) VALUES (:cp, :nomVille, :departement, :region);";
		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute($data)) {
				$ville->setIdVille($BD->lastInsertId());
				return true;
			} else {
				afficherErreurPDO(__FILE__, $requete);
			}
		}
		return false;
	}

	public static function update(Ville $ville)
	{
		$BD = connexionBD();

		$data = [
			'id' => $ville->getIdVille(),
            'cp' => $ville->getCp(),
            'nomVille' => $ville->getNomVille(),
            'departement' => $ville->getDepartement(),
            'region' => $ville->getRegion()
		];

		$SQL = "UPDATE VILLE SET cp=:cp, nomVille=:nomVille, departement=:departement, region=:region WHERE idVille = :id;";
		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute($data)) {
				return true;
			} else
				afficherErreurPDO(__FILE__, $requete);
		}
		return false;
	}

	public static function delete(Ville $ville)
	{
		$BD = connexionBD();

		$data = [
			'id' => $ville->getIdVille()
		];

		$SQL = "DELETE FROM VILLE WHERE idVille = :id;";
		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute($data)) {
				return true;
			} else
				afficherErreurPDO(__FILE__, $requete);
		}
		return false;
	}
}