<?php
require_once("../../connexion/gestionSession.php");
require_once("../header_footer/headerAdmin.php");

// Gestion des variables de la page
$ville = new Ville(0, "", "", "", "");
$message = "";

if (isset($_GET["id"])) {
	$id = protectionDonneesFormulaire($_GET["id"]);
	$ville = VilleRepo::getVille($id);
	if ($ville == null)
		header("location: ".RACINE_SITE."/admin/index.php?villeInconnue");
}

if (isset($_POST["btnEnregistrer"])) {
	if (isset($_POST["idVille"]) && isset($_POST["nomVille"]) && isset($_POST["cp"]) && isset($_POST["departement"]) && isset($_POST["region"])) {
		// Récupération des données du formulaire
		$id = protectionDonneesFormulaire($_POST["idVille"]);
        $nomVille = strtoupper (protectionDonneesFormulaire($_POST["nomVille"]));
		$cp = protectionDonneesFormulaire($_POST["cp"]);
        $departement = strtoupper (protectionDonneesFormulaire($_POST["departement"]));
        $region = strtoupper (protectionDonneesFormulaire($_POST["region"]));
       
		if ($id > 0) {
			$ville = VilleRepo::getVille($id);
			if ($ville == null)
				header("location: ".RACINE_SITE."/admin/villes.php?villeInconnue");
		}

		$ville->setCp($cp);
		$ville->setNomVille($nomVille);
        $ville->setDepartement($departement);
        $ville->setRegion($region);
        
		if ($id == 0) {
			if (!VilleRepo::insert($ville))
				$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Insertion non effectuée<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
			else
				header("location: ".RACINE_SITE."/admin/tableaux/villes.php?Validation1");
		} else {
			if (!VilleRepo::update($ville))
				$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Modification non effectuée<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
			else
				header("location: ".RACINE_SITE."/admin/tableaux/villes.php?Validation2");
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
				<input type="text" class="form-control" id="cp" name="cp" value="<?php echo $ville->getCp() ?>"
				placeholder="Veuillez insérer un nombre à 5 chiffres" pattern=[0-9]{5} required>
			</div>
			<div class="form-group">
				<label for="departement">DÉPARTEMENT :</label>
				<input type="text" class="form-control" id="departement" name="departement" value="<?php echo $ville->getDepartement() ?>"
				placeholder="Veuillez insérer un département sous ce format ex: RHÔNE (69)" required>
			</div>
			<div class="form-group mb-4">
				<label for="region">RÉGION :</label>
				<input type="text" class="form-control" id="region" name="region" value="<?php echo $ville->getRegion() ?>" required>
			</div>
			
			<div class="text-center">
				<input type="submit" class="btn btn-primary" name="btnEnregistrer" value="Enregistrer">
			</div>
		</form>
	</div>
</section>
<?php
	require_once("../header_footer/footerAdmin.php");
?>