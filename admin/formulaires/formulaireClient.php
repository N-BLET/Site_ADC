<?php
require_once("../../connexion/gestionSession.php");
require_once("../header_footer/headerAdmin.php");
require_once("../../includes/utils.php");
ob_start();

// Gestion des variables de la page
$client = new Client(0, "", "", "", "", "", "", false, false, "", 0);
$message = "";
$lesVilles = VilleRepo::getVilles();

if (isset($_GET["id"])) {
	$id = protectionDonneesFormulaire($_GET["id"]);
	$client = ClientRepo::getClient($id);
	if ($client == null) {
		ob_end_flush();
		redirect("../index.php?clientInconnu");
		exit;
	}
}

if (isset($_POST["btnEnregistrer"])) {
	if (isset($_POST["id"]) && isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["adresse"]) && isset($_POST["telephone"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["fkIdVille"])) {
		// Récupération des données du formulaire
		$id = protectionDonneesFormulaire($_POST["id"]);
		$nom = protectionDonneesFormulaire($_POST["nom"]);
		$prenom = protectionDonneesFormulaire($_POST["prenom"]);
		$adresse = protectionDonneesFormulaire($_POST["adresse"]);
		$telephone = protectionDonneesFormulaire($_POST["telephone"]);
		$email = protectionDonneesFormulaire($_POST["email"]);
		$password = protectionDonneesFormulaire($_POST["password"]);
		$fkIdVille = protectionDonneesFormulaire($_POST["fkIdVille"]);

		if ($id > 0) {
			$client = ClientRepo::getClient($id);
			if ($client == null) {
				ob_end_flush();
				redirect("../../connexion/index.php?clientInconnu");
				exit;
			} else {
				$client->setJetonValidation(uniqid());
			}
		}
		$client->setNom($nom);
		$client->setPrenom($prenom);
		$client->setAdresse($adresse);
		$client->setTelephone($telephone);
		$client->setEmail($email);
		$client->setFkIdVille($fkIdVille);

		if (isset($_POST["profilAdmin"])) {
			$profilAdmin = 1;
			$client->setProfilAdmin($profilAdmin);
		} else {
			$profilAdmin = 0;
			$client->setProfilAdmin($profilAdmin);
		}

		if (isset($_POST["estValide"])) {
			$estValide = 1;
			$client->setEstValide($estValide);
		} else {
			$estValide = 0;
			$client->setEstValide($estValide);
		}

		if (isset($_POST["password"]) && !empty($_POST["password"])) {
			$password = protectionDonneesFormulaire($_POST["password"]);
			if (strlen($password) > 0) {
				$mdpClient = password_hash($password, PASSWORD_DEFAULT);
				$client->setPassword($mdpClient);
			}
		}

		if ($id == 0) {
			if (!ClientRepo::insert($client)) {
				$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Insertion non effectuée<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
				echo $message;
			} else {
				ob_end_flush();
				redirect("../tableaux/tabClients.php?validation1");
				exit;
			}
		} else {
			if (!ClientRepo::update($client)) {
				$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Modification non effectuée<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
				echo $message;
			} else {
				ob_end_flush();
				redirect("../tableaux/tabClients.php?validation2");
				exit;
			}
		}
	} else {
		$message = "<div class=\"alert alert-warning  alert-dismissible fade show\" role=\"alert\">Erreur : Le formulaire n'est pas complet<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
		echo $message;
	}
}
?>

<section class="page-section" id="formulaireClient">
	<div class="container">

		<h2>Formulaire : Client</h2>

		<?php
		if (strlen($message) > 0) {
			echo $message;
		}
		?>

		<form action="/admin/formulaires/formulaireClient.php" method="post">
			<input type="hidden" id="id" name="id" value="<?php echo $client->getIdClient() ?>" />

			<div class="form-group">
				<label for="nom">NOM :</label>
				<input type="text" class="form-control" id="nom" name="nom" value="<?php echo $client->getNom() ?>" required>
			</div>
			<div class="form-group">
				<label for="prenom">PRÉNOM :</label>
				<input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $client->getPrenom() ?>" required>
			</div>
			<div class="form-group">
				<label for="adresse">ADRESSE :</label>
				<input type="text" class="form-control" id="adresse" name="adresse" value="<?php echo $client->getAdresse() ?>" required>
			</div>
			<div class="form-group">
				<label for="fkIdVille">VILLE :</label>
				<select class="form-select" id="fkIdVille" name="fkIdVille" class="form-control">
					<option value="0">Choisissez une ville</option>
					<?php
					$option = "";
					foreach ($lesVilles as $ville) {
						$option .= "<option value= '" . $ville->getIdVille() . "'";
						if ($client->getIdClient() > 0 && $client->getVille()->getIdVille() == $ville->getIdVille()) {
							$option .= "selected";
						}
						$option .= 	">" . $ville->getNomVille() . "</option>";
					}
					echo $option;
					?>

				</select>
			</div>
			<div class="form-group">
				<label for="ville">TÉLÉPHONE :</label>
				<input type="tel" class="form-control" id="telephone" name="telephone" value="<?php echo $client->getTelephone() ?>" maxlength="10" placeholder="Veuillez entrer votre numéro 0612345678" required>
			</div>
			<div class="form-group">
				<label for="email">EMAIL :</label>
				<input type="email" class="form-control" id="email" name="email" value="<?php echo $client->getEmail() ?>" placeholder="Veuillez entrer votre email ex: nom@operateur.fr" required>
			</div>
			<div class="form-group mb-4">
				<label for="password">MOT DE PASSE :</label>
				<input type="password" class="form-control" id="password" name="password" value="<?php $client->getPassword() ?>">
			</div>
			<div class="form-check mb-4">
				<label for="profilAdmin" class="form-check-label">PROFIL ADMINISTRATEUR</label>
				<input type="checkbox" class="form-check-input" id="profilAdmin" name="profilAdmin" <?php if ($client->getProfilAdmin()) {
																										echo "checked";
																									} ?> />
			</div>
			<div class="form-check mb-4">
				<label for="estValide">EST VALIDÉ</label>
				<input type="checkbox" class="form-check-input" id="estValide" name="estValide" <?php if ($client->getEstValide()) {
																									echo "checked";
																								} ?> />
			</div>
			<div class="row g-2">
				<div class="text-center">
					<a class="btn btn-dark col-md-1 mx-1" href='./../tableaux/tabInstruments.php'>Retour</a>
					<input type="submit" class="btn btn-success" name="btnEnregistrer" value="Enregistrer">
				</div>
			</div>
		</form>
	</div>
</section>
<?php
require_once("../header_footer/footerAdmin.php");
?>