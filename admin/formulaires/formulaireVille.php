<?php
require_once("../../connexion/gestionSession.php");
require_once("../header_footer/headerAdmin.php");
require_once("../../includes/utils.php");
ob_start();

// Gestion des variables de la page
$ville = new Ville(0, "", "", "", "");
$message = "";

if (isset($_GET["id"])) {
	$id = protectionDonneesFormulaire($_GET["id"]);
	$ville = VilleRepo::getVille($id);
	if ($ville == null) {
		ob_end_flush();
		redirect("../../connexion/index.php?villeInconnue");
		exit;
	}
}

if (isset($_POST["btnEnregistrer"])) {
	if (isset($_POST["idVille"]) && isset($_POST["nomVille"]) && isset($_POST["cp"]) && isset($_POST["departement"]) && isset($_POST["region"])) {
		// Récupération des données du formulaire
		$id = protectionDonneesFormulaire($_POST["idVille"]);
		$nomVille = strtoupper(protectionDonneesFormulaire($_POST["nomVille"]));
		$cp = protectionDonneesFormulaire($_POST["cp"]);
		$departement = strtoupper(protectionDonneesFormulaire($_POST["departement"]));
		$region = strtoupper(protectionDonneesFormulaire($_POST["region"]));

		if ($id > 0) {
			$ville = VilleRepo::getVille($id);
			if ($ville == null) {
				ob_end_flush();
				redirect("../tableaux/tabVilles.php?villeInconnue");
				exit;
			}
		}

		$ville->setCp($cp);
		$ville->setNomVille($nomVille);
		$ville->setDepartement($departement);
		$ville->setRegion($region);

		if ($id == 0) {
			if (!VilleRepo::insert($ville))
				$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Insertion non effectuée<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
			else {
				ob_end_flush();
				redirect("../tableaux/tabVilles.php?Validation1");
				exit;
			}
		} else {
			if (!VilleRepo::update($ville))
				$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Modification non effectuée<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
			else {
				ob_end_flush();
				redirect("../tableaux/tabVilles.php?Validation2");
				exit;
			}
		}
	} else
		$message = "<div class=\"alert alert-warning\" role=\"alert\">Erreur : Le formulaire n'est pas complet<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
}

?>

<section class="page-section" id="villes">
	<div class="container">

		<h2>Formulaire : Ville</h2>

		<?php
		if (strlen($message) > 0) {
			echo $message;
		}
		?>

		<form action="formulaireVille.php" method="post">
			<input type="hidden" id="idVille" name="idVille" value="<?php echo $ville->getIdVille() ?>" />

			<div class="form-group">
				<label for="nomVille">VILLE :</label>
				<input type="text" class="form-control" id="nomVille" name="nomVille" value="<?php echo $ville->getNomVille() ?>" required>
			</div>
			<div class="form-group">
				<label for="cp">CODE POSTAL :</label>
				<input type="number" class="form-control" id="cp" name="cp" pattern="[0-9]{5}" minlength="5" maxlength="5" value="<?php echo $ville->getCp() ?>" placeholder="Veuillez insérer un nombre à 5 chiffres" pattern=[0-9]{5} minlength="5" maxlength="5" oninput="limitInput(this, 5)" onkeypress="return isNumberKey(event)" required>
			</div>
			<div class="form-group">
				<label for="departement">DÉPARTEMENT :</label>
				<input type="text" class="form-control" id="departement" name="departement" value="<?php echo $ville->getDepartement() ?>" placeholder="Veuillez insérer un département sous ce format ex: RHÔNE (69)" required>
			</div>
			<div class="form-group mb-4">
				<label for="region">RÉGION :</label>
				<input type="text" class="form-control" id="region" name="region" value="<?php echo $ville->getRegion() ?>" required>
			</div>

			<div class="text-center">
				<a class="btn btn-dark col-md-1 mx-1" href='./../tableaux/tabVilles.php'>Retour</a>
				<input type="submit" class="btn btn-success" name="btnEnregistrer" value="Enregistrer">
			</div>
		</form>
	</div>
</section>
<script>
	function limitInput(element, maxLength) {
		if (element.value.length > maxLength) {
			element.value = element.value.slice(0, maxLength);
		}
	}

	function isNumberKey(evt) {
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
	}
</script>
<?php
require_once("../header_footer/footerAdmin.php");
?>