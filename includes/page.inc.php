<?php
// Racine du site
define("pathGetSession", "/NFA021-ADC");

// PHP Mailer
use PHPMailer\PHPMailer\PHPMailer;

require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

/* Utilisation de spl_autoload_registrer */
function charge($nomClasse)
{
	include __DIR__ . '/classes/' . $nomClasse . '.php';
}
spl_autoload_register('charge');

function afficherErreurPDO(string $cheminFichier, $requete)
{
	echo "\nERREUR PDO sur le fichier '" . $cheminFichier . "':\n";
	echo "<pre>";
	print_r($requete->errorInfo());
	echo "</pre>";
	exit();
}

function getRepertoireImage(): string
{
	return $_SERVER['DOCUMENT_ROOT'] . "assets/img/portfolio/";
}

function protectionDonneesFormulaire(string $variable): string
{
	$variable = htmlspecialchars($variable);
	$variable = stripslashes($variable);
	$variable = strip_tags($variable);
	$variable = trim($variable);
	return $variable;
}

function verifEmail(string $mail)
{
	/* Validation d'adresses email avec filter_var () */
	if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
	echo "L'adresse mail '$mail' est valide.";
	} else {
		echo "<div class=\"alert alert-error\" role=\>Erreur L'adresse email '$mail' est invalide.</div>";
		header("location: /my-app/PROJET/Site/client/inscription.php?emailNonConforme1");
	}

	/* Validation d'adresses email avec un regex */
	$masque = "/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,4}$/";

	if(preg_match($masque, $mail))  {
	echo "L'adresse email '$mail' est valide.";
	} else {
		echo "<div class=\"alert alert-error\" role=\"alert\">Erreur : L'adresse email '$mail' est invalide.</div>";
		header("location: /my-app/PROJET/Site/client/inscription.php?emailNonConforme2");
	}
	return $mail;
}

function verifUniqEmail(string $email)
	{
		$BD = connexionBD();

		$SQL = "SELECT idClient, nom, prenom, adresse, telephone, email, profilAdmin, estValide, jetonValidation, fkIdVille " .
				"FROM `CLIENT` " .
				"WHERE `CLIENT`.email = :email;";

		$client  = null;

		if ($requete = $BD->prepare($SQL)) {
			if ($requete->execute(array(':email' => $email))) {
				if ($resultat = $requete->fetch(PDO::FETCH_ASSOC)) {
					$client = new Client($resultat["idClient"], $resultat["nom"], $resultat["prenom"], $resultat["adresse"],  $resultat["telephone"], $resultat["email"], "", $resultat["profilAdmin"], $resultat["estValide"], $resultat["jetonValidation"], $resultat["fkIdVille"]);
				}
			} else
				afficherErreurPDO(__FILE__, $requete);
		}

		return $client;
	}


function testpassword($mdp)	{ 
 	
	$longueur = strlen($mdp);
	$point =0;
	 
	for($i = 0; $i < $longueur; $i++) 	{

		$lettre = $mdp[$i];
	 
		if ($lettre>='a' && $lettre<='z'){
			// On ajoute 1 point pour une minuscule
			$point = $point + 1;
	 
			// On rajoute le bonus pour une minuscule
			$point_min = 1;
		}
		else if ($lettre>='A' && $lettre <='Z'){
			// On ajoute 2 points pour une majuscule
			$point = $point + 2;
	 
			// On rajoute le bonus pour une majuscule
			$point_maj = 2;
		}
		else if ($lettre>='0' && $lettre<='9'){
			// On ajoute 3 points pour un chiffre
			$point = $point + 3;
	 
			// On rajoute le bonus pour un chiffre
			$point_chiffre = 3;
		}
		else {
			// On ajoute 5 points pour un caractère autre
			$point = $point + 5;
	 
			// On rajoute le bonus pour un caractère autre
			$point_caracteres = 5;
		}
	}
	 
	// Calcul du coefficient points/longueur
	$etape1 = $point / $longueur;
	 
	// Calcul du coefficient de la diversité des types de caractères...
	$etape2 = $point_min + $point_maj + $point_chiffre + $point_caracteres;
	 
	// Multiplication du coefficient de diversité avec celui de la longueur
	$resultat = $etape1 * $etape2;
	 
	// Multiplication du résultat par la longueur de la chaîne
	$final = $resultat * $longueur;
	 
	return $final;
}


function prix(float $number, string $sigle = "€"): string
    {
        return number_format($number, 2, ',', ' '). ' ' . $sigle;
    }

function envoyerMail($destinataire, $sujet, $contenu)
{
	$mail = new PHPMailer();

	$mail->IsSMTP();
	$mail->SMTPDebug = 2;
	$mail->SMTPAuth = true;
	$mail->Host = 'smtp.mailtrap.io';
	$mail->SMTPSecure = 'tls';
	$mail->Port = 2525;
	$mail->Username = "3e581e81004779";
	$mail->Password = "899c9dca184c81";
	$mail->SetFrom("contact@atelierdesclarinettes.fr", "Atelier Des Clarinettes");
	$mail->Subject = $sujet;
	$mail->Body = $contenu;
	$mail->AddAddress($destinataire);
	if (!$mail->Send()) {
		return false;
	} else
		return true;
}

function recevoirMail($expediteur, $sujet, $contenu)
{
	$mail = new PHPMailer();
	$adresse = "contact@atelierdesclarinettes.fr";

	$mail->IsSMTP();
	$mail->SMTPDebug = 2;
	$mail->SMTPAuth = true;
	$mail->Host = 'smtp.mailtrap.io';
	$mail->SMTPSecure = 'tls';
	$mail->Port = 2525;
	$mail->Username = "3e581e81004779";
	$mail->Password = "899c9dca184c81";
	$mail->SetFrom($expediteur);
	$mail->Subject = $sujet;
	$mail->Body = $contenu;
	$mail->AddAddress($adresse, "Atelier Des Clarinettes");
	if (!$mail->Send()) {
		return false;
	} else
		return true;
}
