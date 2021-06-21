<?php
require_once("../../connexion/gestionSession.php");
require_once("../header_footer/headerAdmin.php");

// Gestion des variables de la page
$instrument = new Instrument(0, "", "", "", "", date('Y-m-d'), 0);
$lesClients = ClientRepo::getClients();
$message = "";

if (isset($_GET["id"])) {
	$id = protectionDonneesFormulaire($_GET["id"]);
	$instrument = InstrumentRepo::getInstrument($id);
	if ($instrument == null)
		header("location: ".RACINE_SITE."/admin/index.php?instrumentInconnu");
}

if (isset($_POST["btnEnregistrer"])) {
	if (isset($_POST["idInstrument"]) && isset($_POST["typeInstrument"]) && isset($_POST["marque"]) && isset($_POST["modele"]) && isset($_POST["numeroSerie"]) && isset($_POST["dateAchat"]) && isset($_POST["fkIdClient"])) {
		// Récupération des données du formulaire
		$id = protectionDonneesFormulaire($_POST["idInstrument"]);
        $typeInstrument = protectionDonneesFormulaire($_POST["typeInstrument"]);
		$marque = protectionDonneesFormulaire($_POST["marque"]);
		$modele = protectionDonneesFormulaire($_POST["modele"]);
        $numeroSerie = protectionDonneesFormulaire($_POST["numeroSerie"]);
        $dateAchat = protectionDonneesFormulaire($_POST["dateAchat"]);
		$fkIdclient = protectionDonneesFormulaire($_POST["fkIdClient"]);

		if ($id > 0) {
			$instrument = InstrumentRepo::getInstrument($id);
			if ($instrument == null)
				header("location: ".RACINE_SITE."/admin/index.php?instrumentInconnu");
		}

		$instrument->setTypeInstrument($typeInstrument);
		$instrument->setMarque($marque);
		$instrument->setModele($modele);
        $instrument->setNumeroSerie($numeroSerie);
        $instrument->setDateAchat($dateAchat);
		$instrument->setFkIdClient($fkIdclient);

		var_dump($instrument);
		var_dump($instrument->getModele());
		if ($id == 0) {
			if (!InstrumentRepo::insert($instrument))
				$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Insertion non effectuée<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
			else
				$message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">L'instrument de votre client a bien été enregistré !<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
				header("location: ".RACINE_SITE."/admin/formulaires/formulaireInstrument.php?id=" . $instrument->GetIdInstrument());
		} else {
			if (!InstrumentRepo::update($instrument))
				$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Modification non effectuée<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
			else
				$message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Les informations de l'instrument ont bien été modifiées !<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
				header("location: ".RACINE_SITE."/admin/formulaires/formulaireInstrument.php?id=" . $instrument->GetIdInstrument());
		}
	} else
		$message = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">Erreur : Le formulaire n'est pas complet<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
}

?>

<section class="page-section" id="formulaireClient">	
    <div class="container">

		<h2>Formulaire : Instrument</h2>

		<?php
		if (strlen($message) > 0) {
			echo $message;
		}
		?>

		<form action="formulaireInstrument.php" method="post">
			<input type="hidden" id="idInstrument" name="idInstrument" value="<?php echo $instrument->getIdInstrument() ?>" />

			<div class="form-group">
				<label for="typeInstrument">TYPE :</label>
				<input type="text" class="form-control" id="typeInstrument" name="typeInstrument"
				value="<?php echo $instrument->getTypeInstrument() ?>" placeholder="Ex : Clarinette Sib" required>
			</div>
			<div class="form-group">
				<label for="marque">MARQUE :</label>
				<input type="text" class="form-control" id="marque" name="marque"
				value="<?php echo $instrument->getMarque() ?>" placeholder="Ex :BUFFET CRAMPON" required>
			</div>
			<div class="form-group">
				<label for="modele">MODÈLE :</label>
				<input type="text" class="form-control" id="modele" name="modele"
				value="<?php echo $instrument->getModele() ?>" placeholder="Ex : Divine" required>
			</div>
			<div class="form-group">
				<label for="numeroSerie">N° DE SÉRIE :</label>
				<input type="text" class="form-control" id="numeroSerie" name="numeroSerie"
				value="<?php echo $instrument->getNumeroSerie() ?>"
				placeholder="Veuillez insérer le numéro situé au dos du corps du haut de la clarinette." required>
			</div>
			<div class="form-group">
				<label for="dateAchat">DATE D'ACHAT :</label>
				<input type="date" class="form-control" id="dateAchat" name="dateAchat"
				value="<?php echo $instrument->getDateAchatISO() ?>" required>
			</div>
			<div class="form-group mb-4">
			<label for="fkIdClient">CLIENT :</label>
				<select id="fkIdClient" name="fkIdClient" class="form-control">
					<option value="0">Sélectionnez un client</option>
					<?php
						$option = "";
						foreach ($lesClients as $client) {
							$option .= "<option value= \"" . 
							$client->getIdClient() . "\"";
							if($instrument->getIdInstrument()>0 && $instrument->getClient()->getIdClient() == $client->getIdClient()) {
								$option .= "selected"; 
							}
							$option .= 	">" . $client->getNom() .  " " . $client->getPrenom() . "</option>";	
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