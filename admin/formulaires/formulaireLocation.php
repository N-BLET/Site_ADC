<?php
require_once("../../connexion/gestionSession.php");
require_once("../header_footer/headerAdmin.php");
ob_start();

// Gestion des variables de la page
$location = new Location(0, date('Y-m-d'), date('Y-m-d'), 0, 0, 0);
$lesInstruments = InstrumentRepo::getInstrumentsLibresLocation();
$lesForfaits = ForfaitRepo::getForfaits();
$lesClients = ClientRepo::getClients();
$message = "";

if (isset($_GET["id"])) {
	$id = protectionDonneesFormulaire($_GET["id"]);
	$lesInstruments = InstrumentRepo::getInstrumentsLocation();
	$location = LocationRepo::getLocation($id);
	if ($location == null) {
		ob_end_flush();
		header("location: /admin/index.php?locationInconnue");
		exit;
	}
}

if (isset($_POST["btnEnregistrer"])) {
	if (isset($_POST["idLocation"]) && isset($_POST["dateLocation"]) && isset($_POST["finLocation"]) && isset($_POST["fkIdInstruLoc"])  && isset($_POST["fkIdClient"])) {
		// Récupération des données du formulaire
		$id = protectionDonneesFormulaire($_POST["idLocation"]);
		$dateLocation = protectionDonneesFormulaire($_POST["dateLocation"]);
		$finLocation = protectionDonneesFormulaire($_POST["finLocation"]);
		$fkIdInstruLoc = protectionDonneesFormulaire($_POST["fkIdInstruLoc"]);
		$fkIdForfait = protectionDonneesFormulaire($_POST["fkIdForfait"]);
		$fkIdClient = protectionDonneesFormulaire($_POST["fkIdClient"]);

		if ($id > 0) {
			$location = LocationRepo::getLocation($id);
			if ($location == null) {
				ob_end_flush();
				header("location: /admin/index.php?locationInconnue");
				exit;
			}
		}

		$date1 = date($dateLocation);
		$location->setDateLocation($date1);

		$date2 = date($finLocation);
		$location->setFinLocation($date2);

		$location->setFkIdInstrument($fkIdInstruLoc);
		$location->setFkIdForfait($fkIdForfait);
		$location->setFkIdClient($fkIdClient);



		if ($id == 0) {
			if (!LocationRepo::insert($location)) {
				$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Insertion non effectuée<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
			} else {
				ob_end_flush();
				header("location: /admin/tableaux/tabLocations.php?Validation1");
				exit;
			}
		} else {
			if (!LocationRepo::update($location)) {
				$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Modification non effectuée<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
			} else {
				ob_end_flush();
				header("location: /admin/tableaux/tabLocations.php?Validation2");
				exit;
			}
		}
	} else {
		$message = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">Erreur : Le formulaire n'est pas complet<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
		echo $message;
	}
}

?>
<section class="page-section" id="formulaireLocation">
	<div class="container">

		<h2>Formulaire : Location</h2>

		<?php
		if (strlen($message) > 0) {
			echo $message;
		}
		?>

		<form action="formulaireLocation.php" method="post">
			<input type="hidden" idLocation="idLocation" name="idLocation" value="<?php echo $location->getIdLocation() ?>" />

			<div class="form-group">
				<label for="dateLocation">DATE DE DÉBUT DE LOCATION :</label>
				<input type="date" class="form-control" id="dateLocation" name="dateLocation" value="<?php echo $location->getDateLocationForm() ?>">
			</div>
			<div class="form-group">
				<label for="finLocation">DATE DE FIN DE LOCATION :</label>
				<input type="date" class="form-control" id="finLocation" name="finLocation" value="<?php echo $location->getFinLocationForm() ?>">
			</div>
			<div class="form-group">
				<label for="fkIdInstruLoc">INSTRUMENT LOUÉ :</label>
				<select class="form-select" id="fkIdInstruLoc" name="fkIdInstruLoc" class="form-control">
					<option value="0">Sélectionnez le numéro de série de votre instrument</option>
					<?php
					$optionSelection = ""; // Initialisez la variable pour l'option sélectionnée
					$optionListe = ""; // Initialisez la variable pour la liste des options sélectionnées

					foreach ($lesInstruments as $instrument) {
						$optionListe .= "<option value=\"" . $instrument->getIdInstrument() . "\"";
						if ($location->getIdLocation() > 0 && $location->getFkIdInstrument() == $instrument->getIdInstrument()) {
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
			<div class="form-group">
				<label for="fkIdForfait">TYPE DE FORFAIT :</label>
				<select class="form-select" id="fkIdForfait" name="fkIdForfait" class="form-control">
					<option value="0">Sélectionnez le forfait</option>
					<?php
					$option2 = "";
					foreach ($lesForfaits as $forfait) {
						$option2 .= "<option value= \"" . $forfait->getIdForfait() . "\"";
						if ($location->getIdLocation() > 0 && $location->getForfait()->getIdForfait() == $forfait->getIdForfait()) {
							$option2 .= "selected";
						}
						$option2 .= ">" . $forfait->getDuree() . "</option>";
					}
					echo $option2;
					?>
				</select>
			</div>
			<div class="form-group mb-4">
				<label for="fkIdClient">CLIENT DU CONTRAT :</label>
				<select id="fkIdClient" name="fkIdClient" class="form-control">
					<option value="0">Sélectionnez le client</option>
					<?php
					$option3 .= "";
					foreach ($lesClients as $client) {
						$option3 .= "<option value=\"" . $client->getIdClient() . "\"";
						if ($location->getIdLocation() > 0 && $location->getClient()->getIdClient() == $client->getIdClient()) {
							$option3 .= "selected";
						}
						$option3 .= ">" . $client->getNom() . " " . $client->getPrenom() . "</option>";
					}
					echo $option3;
					?>
				</select>
			</div>
			<div class="text-center">
				<a class="btn btn-dark col-md-1 mx-1" href='./../tableaux/tabLocations.php'>Retour</a>
				<input type="submit" class="btn btn-success" name="btnEnregistrer" value="Enregistrer">
			</div>
		</form>
	</div>
</section>

<?php
require_once("../header_footer/footerAdmin.php");
?>