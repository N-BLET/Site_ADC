<?php
require_once("../../connexion/gestionSession.php");
require_once("../header_footer/headerAdmin.php");

// Gestion des variables de la page
$entretien = new Entretien(0, date('Y-m-d'), "", 0.5, 0);
$lesInstruments = Instrument_LocationRepo::getInstruments_Location();
$message = "";

if (isset($_GET["id"])) {
	$id = protectionDonneesFormulaire($_GET["id"]);
	$entretien = EntretienRepo::getEntretien($id);
	if ($entretien == null)
		header("location: ".RACINE_SITE."/admin/index.php?entretienInconnu");
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
			if ($entretien == null)
				header("location: ".RACINE_SITE."/admin/index.php?entretienInconnu");
		}

		$entretien->setDateEntretien($dateEntretien);
        $entretien->setDescriptionEntretien($descriptionEntretien);
        $entretien->setPrixEntretien($prixEntretien);
		$entretien->setFkIdInstrument($fkIdInstrument);


		if ($id == 0) {
			if (!EntretienRepo::insert($entretien))
				$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Insertion non effectuée<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
			else
				$message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Votre entretien a bien été enregistré !<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
				header("location: ".RACINE_SITE."/admin/formulaires/formulaireEntretien.php?entretienOk");
		} else {
			if (!EntretienRepo::update($entretien))
				$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Modification non effectuée<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
			else
				$message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Votre entretien a bien été modifié !<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
				header("location: ".RACINE_SITE."/admin/formulaires/formulaireEntretien.php?id=" . $entretien->GetIdEntretien());
		}
	} else
		$message = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">Erreur : Le formulaire n'est pas complet<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
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

		<form action="<?php echo RACINE_SITE; ?>/admin/formulaires/formulaireEntretien.php" method="post">
			<input type="hidden" id="idEntretien" name="idEntretien" value="<?php echo $entretien->getIdEntretien() ?>" />

			<div class="form-group">
				<label for="dateEntretien">DATE DE L'ENTRETIEN :</label>
				<input type="date" class="form-control" id="dateEntretien" name="dateEntretien" value="<?php echo $entretien->getDateEntretienISO() ?>">
			</div>
			<div class="form-group">
				<label for="descriptionEntretien">DESCRIPTION DE L'ENTRETIEN :</label>
				<textarea class="form-control" id="descriptionEntretien" name="descriptionEntretien" value="<?php echo $entretien->getDescriptionEntretien() ?>" placeholder="Veuillez saisir les différentes interventions faites lors de cet entretien."><?php echo $entretien->getDescriptionEntretien() ?></textarea>
			</div>
			<div class="form-group">
				<label for="prixEntretien">PRIX DE L'ENTRETIEN :</label>
				<input type="number" class="form-control" id="prixEntretien" name="prixEntretien" min="0.01" step="0.01" value="<?php 
				if($entretien->GetPrixEntretien() == 0.5){
					echo "Veuillez saisir un montant au format Ex : 195.56";
				}
					echo $entretien->GetPrixEntretien() ?>">
			</div>
			<div class="form-group mb-4">
				<label for="fkIdInstrument">INSTRUMENT RÉPARÉ :</label>
					<select class="form-select" id="fkIdInstrument" name="fkIdInstrument">
					<option value="0">Choisissez un instrument</option>
						<?php
						$option = "";
						foreach ($lesInstruments as $instrument) {
							$option .= "<option value= \"" . $instrument->getIdInstrument() . "\"";
							if($entretien->getIdEntretien()>0 && $entretien->getFkIdInstrument() == $instrument->getIdInstrument()){
								$option .= "selected";
							}
							$option .= 	">" . $instrument->getNumeroSerie() . "</option>";	
						}
						echo $option;		
						?>
					</select>
			</div>
			<div class="text-center mt-5">
				<input type="submit" class="btn btn-primary" name="btnEnregistrer" value="Enregistrer">
			</div>
		</form>
	</div>
</section>

<?php
	require_once("../header_footer/footerAdmin.php");
?>
