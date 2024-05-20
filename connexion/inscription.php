<?php
require_once("../includes/page.inc.php");
ob_start();

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

if (isset($_GET["inscriptionOK"]))
	//Popup de confirmation
	$message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Votre demande d'inscription a bien été prise en compte.<br/>
	Vous venez de recevoir un mail afin de confirmer votre adresse mail.<br/>
	Merci de cliquez sur le lien de ce mail afin de valider votre insription.
	<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";


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
		if ($indice < 100) {
			header("location: /connexion/inscription.php?motDePasseNonConforme5");
		}

		$mdpClient = password_hash($password, PASSWORD_DEFAULT);
		$client->setPassword($mdpClient);

		if (!ClientRepo::insert($client)) {
			$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Insertion non effectuée<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
		} else {
			// Envoi du mail
			$contenu = "Merci de valider votre mail en cliquant sur le lien suivant : http://localhost/nfa021-adc/connexion/validation.php?jeton=" . $client->getJetonValidation();

			if (envoyerMail($client->getEmail(), "Valider votre inscription", $contenu)) {
				header("location: /connexion/inscription.php?inscriptionOK");
			}
		}
	} else {
		$message = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">Erreur : Le formulaire n'est pas complet<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
	}
}
require_once("../client/header_footer/header.php"); ?>

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
				<input type="text" class="form-control" id="nom" name="nom" value="<?php echo $client->getNom() ?>" placeholder="Veuillez saisir votre nom." required>
			</div>
			<div class="form-group">
				<label for="prenom">Prénom :</label>
				<input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $client->getPrenom() ?>" placeholder="Veuillez saisir votre prénom." required>
			</div>
			<div class="form-group">
				<label for="adresse">Adresse :</label>
				<input type="text" class="form-control" id="adresse" name="adresse" value="<?php echo $client->getAdresse() ?>" placeholder="Veuillez saisir votre adresse - Ex: 7 rue des Lilas." required>
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
				<label for="telephone">Téléphone :</label>
				<input type="tel" class="form-control" id="telephone" name="telephone" value="<?php echo $client->getTelephone() ?>" minlength="10" maxlength="10" placeholder="Veuillez entrer votre numéro de téléphone - Ex: 0612345678" required>
				<div id="telephone-error" class="text-danger" style="display:none;"></div>
			</div>
			<div class="form-group">
				<label for="email">Email :</label>
				<input type="email" class="form-control" id="email" name="email" value="<?php echo $client->getEmail() ?>" placeholder="Veuillez entrer votre email - Ex: nom@operateur.fr" required>
				<div id="email-error" class="text-danger" style="display: none;"></div>
			</div>
			<div class="form-group mb-4">
				<label for="password">Password :</label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Veuillez saisir un mot de passe d'au moins 8 caractères et comprenant 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial.">
				<div id="password-error" class="text-danger" style="display:none;"></div>
			</div>

			<input type="submit" class="btn btn-primary" name="btnInscription" value="Envoyer" />
		</form>
	</div>
	<div class="text-center mt-5 mb-3">
		<a class="btn btn-dark" href="/connexion/index.php">Retour connexion</a>
	</div>
</div>

<?php require_once("../client/header_footer/footer.php"); ?>|
</body>

<script>
	// Vérification de l'email, son format et son unicité
	document.addEventListener("DOMContentLoaded", function() {
		const emailInput = document.getElementById("email");
		const emailError = document.getElementById("email-error");

		emailInput.addEventListener("blur", function() {
			const email = emailInput.value;
			emailError.style.display = "none";

			if (!validateEmail(email)) {
				showEmailError("L'adresse email est invalide.");
			}
		});

		emailInput.addEventListener("input", function() {
			emailError.style.display = "none";
		});

		function validateEmail(email) {
			const re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
			return re.test(email);
		}

		function showEmailError(message) {
			emailError.textContent = message;
			emailError.style.display = "block";
		}

		function hideEmailError() {
			emailError.style.display = "none";
		}
	});

	// Vérification du numéro de téléphone
	document.addEventListener("DOMContentLoaded", function() {
		const telephoneInput = document.getElementById("telephone");
		const telephoneError = document.getElementById("telephone-error");

		telephoneInput.addEventListener("blur", function() {
			validateTelephoneInput();
		});

		telephoneInput.addEventListener("input", function() {
			validateTelephoneInput();
		});

		function validateTelephoneInput() {
			const telephone = telephoneInput.value;
			telephoneError.style.display = "none";

			if (!validateTelephone(telephone)) {
				showTelephoneError("Le numéro de téléphone est invalide.");
			} else {
				hideTelephoneError();
			}
		}

		function validateTelephone(telephone) {
			const re = /^0[1-9]\d{8}$/; // Regex pour valider les numéros de téléphone français au format 0XXXXXXXXX
			return re.test(telephone);
		}

		function showTelephoneError(message) {
			telephoneError.textContent = message;
			telephoneError.style.display = "block";
		}

		function hideTelephoneError() {
			telephoneError.style.display = "none";
		}
	});

	// Vérification du format de mot de passe
	document.addEventListener("DOMContentLoaded", function() {
		const passwordInput = document.getElementById("password");
		const passwordError = document.getElementById("password-error");

		passwordInput.addEventListener("blur", validatePasswordInput);
		passwordInput.addEventListener("input", validatePasswordInput);

		function validatePasswordInput() {
			const password = passwordInput.value;
			passwordError.style.display = "none";

			if (!validatePassword(password)) {
				showPasswordError("Le mot de passe doit contenir au moins 8 caractères, avec au moins une majuscule, une minuscule, un chiffre et un caractère spécial.");
			} else {
				hidePasswordError();
			}
		}

		function validatePassword(password) {
			const re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
			return re.test(password);
		}

		function showPasswordError(message) {
			passwordError.textContent = message;
			passwordError.style.display = "block";
		}

		function hidePasswordError() {
			passwordError.style.display = "none";
		}
	});

	// Vérification que tous les champs du formulaire soient remplis
	document.addEventListener("DOMContentLoaded", function() {
		const form = document.querySelector("form");

		// form.addEventListener("submit", function(event) {
		// 	event.preventDefault();

		// 	const inputs = form.querySelectorAll("input, select");
		// 	let isValid = true;

		// 	inputs.forEach(function(input) {
		// 		if (input.required && !input.value.trim()) {
		// 			isValid = false;
		// 			showFieldError(input, "Ce champ est requis.");
		// 		} else {
		// 			hideFieldError(input);
		// 		}
		// 	});

		// 	if (isValid) {
		// 		// Si le formulaire est valide, vous pouvez maintenant soumettre le formulaire
		// 		form.submit();

		// 		// Ajoutez ici le code pour ajouter la classe "success" au bouton de soumission si nécessaire
		// 		const submitButton = document.querySelector("input[type=submit]");
		// 		submitButton.className("btn btn-success");
		// 	}else{
		// 		submitButton.className("btn btn-primary");
		// 	}
		// });

		function showFieldError(input, message) {
			const errorElement = input.nextElementSibling;
			if (errorElement && errorElement.classList.contains("error-message")) {
				errorElement.textContent = message;
				errorElement.style.display = "block";
			} else {
				const newErrorElement = document.createElement("div");
				newErrorElement.textContent = message;
				newErrorElement.classList.add("error-message");
				newErrorElement.style.color = "red";
				input.parentNode.insertBefore(newErrorElement, input.nextSibling);
			}
		}

		function hideFieldError(input) {
			const errorElement = input.nextElementSibling;
			if (errorElement && errorElement.classList.contains("error-message")) {
				errorElement.textContent = "";
				errorElement.style.display = "none";
			}
		}
	});
</script>