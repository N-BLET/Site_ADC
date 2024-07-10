<?php
require_once("../../connexion/gestionSession.php");
require_once("../header_footer/headerAdmin.php");
require_once("../../includes/utils.php");
ob_start();

// Gestion des variables de la page
$forfait = new Forfait(0, "", 0.5);
$message = "";

if (isset($_GET["id"])) {
	$id = protectionDonneesFormulaire($_GET["id"]);
	$forfait = ForfaitRepo::getForfait($id);
	if ($forfait == null) {
		ob_end_flush();
		redirect("../../connexion/index.php?forfaitInconnu");
		exit;
	}
}

if (isset($_POST["btnEnregistrer"])) {
	if (isset($_POST["idForfait"]) && isset($_POST["duree"]) && isset($_POST["tarif"])) {
		// Récupération des données du formulaire
		$id = protectionDonneesFormulaire($_POST["idForfait"]);
		$duree = protectionDonneesFormulaire($_POST["duree"]);
		$tarif = protectionDonneesFormulaire($_POST["tarif"]);

		if ($id > 0) {
			$forfait = ForfaitRepo::getForfait($id);
			if ($forfait == null) {
				redirect("../index.php?forfaitInconnu");
				ob_end_flush();
				exit;
			}
		}

		$forfait->setDuree($duree);
		$forfait->setTarif($tarif);

		if ($id == 0) {
			if (!ForfaitRepo::insert($forfait)) {
				$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Insertion non effectuée<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
				echo $message;
			} else {
				redirect("../tableaux/tabForfaits.php?Validation1");
				exit;
			}
		} else {
			if (!ForfaitRepo::update($forfait)) {
				$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Modification non effectuée<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
				echo $message;
			} else {
				redirect("../tableaux/tabForfaits.php?Validation2");
				exit;
			}
		}
	} else {
		$message = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">Erreur : Le formulaire n'est pas complet<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
		echo $message;
	}
}

?>

<section class="page-section" id="formulaireForfait">
	<div class="container">

		<h2>Formulaire : Forfait</h2>

		<?php
		if (strlen($message) > 0) {
			echo $message;
		}
		?>

		<form action="formulaireForfait.php" method="post">
			<input type="hidden" id="idForfait" name="idForfait" value="<?php echo $forfait->getIdForfait() ?>" />

			<div class="form-group">
				<label for="duree">PÉRIODE DE LOCATION :</label>
				<input type="text" class="form-control" id="duree" name="duree" value="<?php echo $forfait->getDuree() ?>" placeholder="Veuillez insérer une durée Ex: 'Tarif annuel.'" required>
			</div>
			<div class="form-group mb-4">
				<label for="tarif">TARIF :</label>
				<input type="number" class="form-control" id="tarif" name="tarif" min="0,01" step="0.01" value="<?php echo $forfait->getTarif() ?>" required>
			</div>
			<div class="form-group">
				<div class="text-center">
					<a class="btn btn-dark col-md-1 mx-1" href='./../tableaux/tabForfaits.php'>Retour</a>
					<input type="submit" class="btn btn-success" name="btnEnregistrer" value="Enregistrer">
				</div>
			</div>
		</form>
	</div>
</section>
<?php
require_once("../header_footer/footerAdmin.php");
?>