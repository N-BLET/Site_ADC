<?php
require_once("../includes/page.inc.php");

// Gestion des variables de la page
$client = new Client(0, "", "", "", "", "", "", false, false, "", 0);
$lesVilles = VilleRepo::getVilles();
$message = "";


if (isset($_GET["emailNonConforme1"]))
	$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Votre adresse mail n'est pas conforme au format d'un email<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";

if (isset($_GET["emailNonConforme2"]))
	$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Votre adresse mail n'est pas conforme car des caractères non adaptés y figurent.<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";


if (isset($_GET["emailNonConforme3"]))
	$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Votre adresse mail n'est pas conforme.<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";


if (isset($_GET["emailNonConforme4"]))
	$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Votre adresse mail ne peut être enregistrée, merci d'en saisir une autre.<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";


if (isset($_GET["motDePasseNonConforme5"]))
	$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Votre mot de passe n'est pas assez sécurisé. Veuillez créer un mot de passe d'au moins 8 caractères et comprenant :<ul><li>1 minuscule</li><li>1 Majuscule</li><li>1 chiffre</li> <li>et 1 caractère spécial</li></ul>C'est pour la sécurité de vos données, merci de votre compréhension.<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";


if (isset($_POST["btnInscription"])) {
	if (isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["adresse"]) && isset($_POST["telephone"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["fkIdVille"])) {
		// Récupération des données du formulaire
		$nom = protectionDonneesFormulaire($_POST["nom"]);
		$prenom = protectionDonneesFormulaire($_POST["prenom"]);
		$adresse = protectionDonneesFormulaire($_POST["adresse"]);
		$telephone = protectionDonneesFormulaire($_POST["telephone"]);
		$email = protectionDonneesFormulaire($_POST["email"]);
		$password = protectionDonneesFormulaire($_POST["password"]);
		$fkIdVille = protectionDonneesFormulaire($_POST["fkIdVille"]);

		$client->setJetonValidation(uniqid());

		$client->setNom($nom);
		$client->setPrenom($prenom);
		$client->setAdresse($adresse);
		$client->setTelephone($telephone);
		$client->setFkIdVille($fkIdVille);

		if (!verifEmail($email)) {
			header("location: /connexion/inscription.php?emailNonConforme3");
		}

		if (verifUniqEmail($email)) {
			header("location: /connexion/inscription.php?emailNonConforme4");
			exit;
		}
		$client->setEmail($email);

		$indice = testpassword($password);
		if ($indice<100) {
			header("location: /connexion/inscription.php?motDePasseNonConforme5");
		}
		
		$mdpClient = password_hash($password, PASSWORD_DEFAULT);
		$client->setPassword($mdpClient);

		if (!ClientRepo::insert($client)) {
			$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Insertion non effectuée<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
		}else {
			// Envoi du mail
			$contenu = "Merci de valider votre mail en cliquant sur le lien suivant : http://localhost/nfa021-adc/connexion/validation.php?jeton=" . $client->getJetonValidation();

			if (envoyerMail($client->getEmail(), "Valider votre inscription", $contenu)) {
				header("location: /connexion/inscription.php?inscriptionOK");
			}
		}

	}else{
		$message = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">Erreur : Le formulaire n'est pas complet<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
	}
	
}
?>
<!doctype html>
<html lang="fr">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
    <title>Atelier des clarinettes</title>
	<!-- Favicon-->
	<link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
	<!-- Font Awesome icons (free version)-->
	<script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
	<!-- Google fonts-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
	<!-- Core theme CSS (includes Bootstrap)-->
	<link href="../css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">
	<!-- Navigation-->
	<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark" id="mainNav">
		<div class="container">
			<a class="navbar-brand" href="#page-top"><img src="../assets/img/logo.jpg" alt="Logo Atelier Des Clarinettes" /></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				Menu
				<i class="fas fa-bars ms-1"></i>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
					<li class="nav-item"><a class="nav-link text-ligth" href="/index.php#services">Services</a></li>
					<li class="nav-item"><a class="nav-link text-light" href="/index.php#entretien">Entretien</a></li>
					<li class="nav-item"><a class="nav-link text-light" href="/index.php#location">Location</a></li>
					<li class="nav-item"><a class="nav-link text-light" href="/index.php#portfolio">Vente</a></li>
					<li class="nav-item"><a class="nav-link text-light" href="/index.php#equipe">L'équipe</a></li>
					<li class="nav-item"><a class="nav-link text-light" href="/index.php#contact">Contact</a></li>
				</ul>
				<a class="btn btn-primary btn-social mx-2" href="https://www.facebook.com/latelierdesclarinettes"><i class="fab fa-facebook-f"></i></a>
			</div>
		</div>
	</nav>

	<div class="container" style="height:25px;">
		<p></p>
	</div>
	<div class="container mt-5">

		<div class="card-header bg-warning text-dark">
			<h2>Inscription</h2>
		</div>
		<div class="card-body bg-dark text-light rounded-bottom">
			<?php
			if (strlen($message) > 0) {
				echo $message;
			}
			?>

			<form action="inscription.php" method="post">
			<div class="form-group">
				<label for="nom">Nom :</label>
				<input type="text" class="form-control" id="nom" name="nom"
				value="<?php echo $client->getNom() ?>" placeholder="Veuillez saisir votre nom." required>
				</div>
			<div class="form-group">
				<label for="prenom">Prénom :</label>
				<input type="text" class="form-control" id="prenom" name="prenom"
				value="<?php echo $client->getPrenom() ?>" placeholder="Veuillez saisir votre prénom." required>
			</div>
			<div class="form-group">
				<label for="adresse">Adresse :</label>
				<input type="text" class="form-control" id="adresse" name="adresse"
				value="<?php echo $client->getAdresse() ?>" placeholder="Veuillez saisir votre adresse - Ex: 7 rue des Lilas." required>
			</div>
			<div class="form-group">
				<label for="fkIdVille">Ville :</label>
				<select class="form-select" id="fkIdVille" name="fkIdVille" required>
						<option value="0">Choisissez une ville</option>
						<?php
						foreach ($lesVilles as $ville) {
							echo "<option value=\"" . $ville->getIdVille() . "\">" . $ville->getNomVille() . "</option>";
						}
						?>
					</select>
			</div>
			<div class="form-group">
				<label for="ville">Téléphone :</label>
				<input type="tel" class="form-control" id="telephone" name="telephone"
				value="<?php echo $client->getTelephone() ?>" maxlength="10"
				placeholder="Veuillez entrer votre numéro de téléphone - Ex: 0612345678" required>
			</div>
			<div class="form-group">
				<label for="email">Email :</label>
				<input type="email" class="form-control" id="email" name="email"
				value="<?php echo $client->getEmail() ?>"
				placeholder="Veuillez entrer votre email - Ex: nom@operateur.fr" required>
			</div>
			<div class="form-group mb-4">
				<label for="password">Password :</label>
				<input type="password" class="form-control" id="password" name="password"
				value="" placeholder="Veuillez saisir un mot de passe d'au moins 8 caractères et comprenant 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial.">
			</div>

			<input type="submit" class="btn btn-primary" name="btnInscription" value="Envoyer" />
		</form>

		<div class="text-center">
			<a href="/connexion/index.php">Retour connexion</a>
		</div>
	</div>
		
	<footer class="footer py-4">
		<div class="container-fluid card-footer">
			<h4>Atelier des clarinettes</h4>
			<p>Le Bourg<br>42460 JARNOSSE</br></p>
			<p>Tél : 06.12.41.63.47</p>
			<p><a href="/index.php">Retour sur le site</a></p>
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-12 my-3 my-lg-0">
						Copyright &copy; Atelier des Clarinettes
						<!-- This script automatically adds the current year to your website footer-->
						<!-- (credit: https://updateyourfooter.com/)-->
						<script>
							document.write(new Date().getFullYear());
						</script>
					</div>
					<div class="col-lg-12 my-3 my-lg-0 mt-2">
						<a class="btn btn-dark btn-social mx-2" href="https://www.facebook.com/latelierdesclarinettes"><i class="fab fa-facebook-f"></i></a>
					</div>
				</div>
			</div>     
		</div>
	</footer>
</body>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="../js/scripts.js"></script>
