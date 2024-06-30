<?php
require_once("../../connexion/gestionSession.php");
require_once("../header_footer/headerAdmin.php");
ob_start();

// Gestion des variables de la page
$entretien = new Entretien(0, date('Y-m-d'), "", null, 0, 0);
$lesInstruments = InstrumentRepo::getInstruments();
$message = "";

if (isset($_GET["id"])) {
	$id = protectionDonneesFormulaire($_GET["id"]);
	$entretien = EntretienRepo::getEntretien($id);
	if ($entretien == null) {
		ob_end_flush();
		header("location: /admin/index.php?entretienInconnu");
		exit;
	}
}

if (isset($_POST["btnEnregistrer"])) {
	if (isset($_POST["idEntretien"]) && isset($_POST["dateEntretien"]) && isset($_POST["descriptionEntretien"]) && isset($_POST["prixEntretien"]) && isset($_POST["fkIdInstrument"])) {
		// Récupération des données du formulaire
		$id = protectionDonneesFormulaire($_POST["idEntretien"]);
		$dateEntretien = protectionDonneesFormulaire($_POST["dateEntretien"]);
		$descriptionEntretien = protectionDonneesFormulaire($_POST["descriptionEntretien"]);
		$prixEntretien = protectionDonneesFormulaire($_POST["prixEntretien"]);
		$fkIdInstrument = protectionDonneesFormulaire($_POST["fkIdInstrument"]);

		if ($id > 0) {
			$entretien = EntretienRepo::getEntretien($id);
			if ($entretien == null) {
				ob_end_flush();
				header("location: /admin/index.php?entretienInconnu");
				exit;
			}
		}

		$entretien->setDateEntretien($dateEntretien);
		$entretien->setDescriptionEntretien($descriptionEntretien);
		$entretien->setPrixEntretien($prixEntretien);
		$entretien->setInstrument(InstrumentRepo::getInstrument($fkIdInstrument));


		if ($id == 0) {
			if (!EntretienRepo::insert($entretien)) {
				$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Insertion non effectuée<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
				echo $message;
			} else {
				ob_end_flush();
				header("location: /admin/tableaux/tabEntretiens.php?Validation1");
				exit;
			}
		} else {
			if (!EntretienRepo::update($entretien)) {
				$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Modification non effectuée<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
				echo $message;
			} else {
				ob_end_flush();
				header("location: /admin/tableaux/tabEntretiens.php?Validation2");
				exit;
			}
		}
	} else {
		$message = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">Erreur : Le formulaire n'est pas complet<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
		echo $message;
	}
}

?>
<section class="page-section" id="formulaireEntretien">
	<div class="container">
		<h2>Formulaire : Entretien</h2>

		<?php
		if (strlen($message) > 0) {
			echo $message;
		}
		?>

		<form action="/admin/formulaires/formulaireEntretien.php" method="post">
			<input type="hidden" id="idEntretien" name="idEntretien" value="<?php echo $entretien->getIdEntretien() ?>" />

			<div class="form-group">
				<label for="dateEntretien">DATE DE L'ENTRETIEN :</label>
				<input type="date" class="form-control" id="dateEntretien" name="dateEntretien" value="<?php echo $entretien->getDateEntretienForm() ?>">
			</div>
			<div class="form-group">
				<label for="descriptionEntretien">DESCRIPTION DE L'ENTRETIEN :</label>
				<textarea class="form-control" id="descriptionEntretien" name="descriptionEntretien" value="<?php echo $entretien->getDescriptionEntretien() ?>" placeholder="Veuillez saisir les différentes interventions faites lors de cet entretien."><?php echo $entretien->getDescriptionEntretien() ?></textarea>
			</div>
			<div class="form-group">
				<label for="prixEntretien">PRIX DE L'ENTRETIEN :</label>
				<input type="number" class="form-control" id="prixEntretien" name="prixEntretien" min="0.01" step="0.01" value="<?php echo ($entretien->getPrixEntretien() === null) ? '' : $entretien->getPrixEntretien(); ?>" <?php if ($entretien->getPrixEntretien() === null) : ?> placeholder="Veuillez saisir un montant au format Ex : 195.56" <?php endif; ?>>
			</div>
			<div class="form-group mb-4">
				<label for="fkIdInstrument">INSTRUMENT RÉPARÉ :</label>
				<select class="form-select" id="fkIdInstrument" name="fkIdInstrument">
					<option value="0">Choisissez un instrument</option>
					<?php
					$optionSelection = ""; // Initialisez la variable pour l'option sélectionnée
					$optionListe = ""; // Initialisez la variable pour la liste des options sélectionnées

					foreach ($lesInstruments as $instrument) {
						$optionListe .= "<option value=\"" . $instrument->getIdInstrument() . "\"";
						if ($entretien->getIdEntretien() > 0 && $entretien->getInstrument()->getIdInstrument() == $instrument->getIdInstrument()) {
							$optionSelection = "<option value=\"" . $instrument->getIdInstrument() . "\"";
							$optionSelection  .= " selected>"; // Ajoutez l'attribut "selected" si l'instrument correspond à celui sélectionné pour l'entretien
							$optionSelection  .= $instrument->getTypeInstrument() . " | n° : " . $instrument->getNumeroSerie() . "</option>"; // Ajoutez le contenu de l'option sélectionnée
							break;
						} else {
							$optionListe .= ">" . $instrument->getTypeInstrument() . " | n° : " . $instrument->getNumeroSerie() . "</option>"; // Ajoutez le contenu de toutes les options non sélectionnées
						}
					}

					// Affichez l'option sélectionnée s'il y en a une, sinon affichez toutes les options non sélectionnées
					echo $optionSelection !== "" ? $optionSelection : $optionListe;
					?>
				</select>
			</div>
			<div class="text-center mt-5">
				<a class="btn btn-dark col-md-1 mx-1" href='./../tableaux/tabEntretiens.php'>Retour</a>
				<input type="submit" class="btn btn-success" name="btnEnregistrer" value="Enregistrer">
			</div>
		</form>
	</div>
</section>

<?php
require_once("../header_footer/footerAdmin.php");
?>