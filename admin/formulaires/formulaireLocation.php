<?php
require_once("../../connexion/gestionSession.php");
require_once("../header_footer/headerAdmin.php");

// Gestion des variables de la page
$location = new Location(0, date('Y-m-d'), date('Y-m-d'), 0, 0, 0);
$lesInstruments = Instrument_LocationRepo::getInstruments_Location();
$lesForfaits = ForfaitRepo::getForfaits();
$lesClients = ClientRepo::getClients();
$message = "";

if (isset($_GET["id"])) {
	$id = protectionDonneesFormulaire($_GET["id"]);
	$location = LocationRepo::getLocation($id);
	if ($location == null)
		header("location: ".RACINE_SITE."/admin/index.php?locationInconnue");

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
			if ($location == null)
				header("location: ".RACINE_SITE."/admin/index.php?locationInconnue");
		}

		$date1 = date($dateLocation);
		$location->setDateLocation($date1);

		$date2 = date($finLocation);
        $location->setFinLocation($date2);

		$location->setFkIdInstruLoc($fkIdInstruLoc);
		$location->setFkIdForfait($fkIdForfait);
		$location->setFkIdClient($fkIdClient);



		if ($id == 0) {
			if (!LocationRepo::insert($location))
				$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Insertion non effectuée<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
			else
				$message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Votre nouveau contrat de loaction a bien été enregistré !<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
				header("location: ".RACINE_SITE."/admin/formulaires/formulaireLocation.php?idLocation=" . $location->GetIdLocation());
		} else {
			if (!LocationRepo::update($location))
				$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Modification non effectuée<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
			else
				$message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Les informations de votre contrat de location ont bien été modifiées !<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
				header("location: ".RACINE_SITE."/admin/formulaires/formulaireLocation.php?idLocation=" . $location->GetIdLocation());
		}
	} else
		$message = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">Erreur : Le formulaire n'est pas complet<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
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
				<input type="date" class="form-control" id="dateLocation" name="dateLocation" value="<?php echo $location->getDateLocation() ?>">
			</div>
			<div class="form-group">
				<label for="finLocation">DATE DE FIN DE LOCATION :</label>
				<input type="date" class="form-control" id="finLocation" name="finLocation" value="<?php echo $location->getFinLocation() ?>">
			</div>
			<div class="form-group">
			<label for="fkIdInstruLoc">INSTRUMENT LOUÉ :</label>
				<select class="form-select" id="fkIdInstruLoc" name="fkIdInstruLoc" class="form-control">
					<option value="0">Sélectionnez le numéro de série de votre instrument</option>
					<?php
					$option = "";
					foreach ($lesInstruments as $instrument) {
						$option .=  "<option value=\"" . $instrument->getIdInstrument() . "\"";
							if($location->getIdLocation()>0 && $location->getInstrument_Location()->getIdInstrument() == $instrument->getIdInstrument()){
								$option .= "selected";
							}
							$option .= 	">" . $instrument->getNumeroSerie() . "</option>";	
					}
					echo $option;		
					?>
				</select>
			</div>
			<div class="form-group">
			<label for="fkIdForfait">TYPE DE FORFAIT :</label>
				<select class="form-select" id="fkIdForfait" name="fkIdForfait" class="form-control">
					<option value="0">Sélectionnez le forfait</option>
					<?php
					$option = "";
					foreach ($lesForfaits as $forfait) {
						$option .= "<option value= \"" . $forfait->getIdForfait() . "\"";
						if($location->getIdLocation()>0 && $location->getForfait()->getIdForfait() == $forfait->getIdForfait()) {
							$option .= "selected";
						} 
						$option .= ">" . $forfait->getDuree() . "</option>";
					}
					echo $option;
					?>
				</select>
			</div>
			<div class="form-group mb-4">
			<label for="fkIdClient">CLIENT DU CONTRAT :</label>
				<select id="fkIdClient" name="fkIdClient" class="form-control">
					<option value="0">Sélectionnez le client</option>
					<?php
					$option .= "";
					foreach ($lesClients as $client) {
						$option .= "<option value=\"" . $client->getIdClient() . "\"";
						if($location->getIdLocation()>0 && $location->getClient()->getIdClient() == $client->getIdClient()){
							$option .= "selected";
						}
						$option .= ">" . $client->getNom() . " " . $client->getPrenom() . "</option>";
					}
					echo $option;	
					?>
				</select>
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