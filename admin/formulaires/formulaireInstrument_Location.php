<?php
require_once("../../connexion/gestionSession.php");
require_once("../header_footer/headerAdmin.php");

// Gestion des variables de la page
$instruLoc = new Instrument_Location(0, "", "", "", "", date('Y-m-d'));
$message = "";

if (isset($_GET["id"])) {
	$id = protectionDonneesFormulaire($_GET["id"]);
	$instruLoc = Instrument_LocationRepo::getInstrument_Location($id);
	if ($instruLoc == null)
		header("location: ".RACINE_SITE."/admin/formulaires/formulaireInstrument_Location.php?instrument_LocationInconnu");
}

if (isset($_POST["btnEnregistrer"])) {
	if (isset($_POST["idInstruLoc"]) && isset($_POST["typeInstruLoc"]) && isset($_POST["marqueInstruLoc"]) && isset($_POST["modeleInstruLoc"]) && isset($_POST["numeroSerieInstruLoc"]) && isset($_POST["dateAchatInstruLoc"])) {
		// Récupération des données du formulaire
		$id = protectionDonneesFormulaire($_POST["idInstruLoc"]);
        $typeInstruLoc = protectionDonneesFormulaire($_POST["typeInstruLoc"]);
		$marqueInstruLoc = protectionDonneesFormulaire($_POST["marqueInstruLoc"]);
		$modeleInstruLoc = protectionDonneesFormulaire($_POST["modeleInstruLoc"]);
        $numeroSerieInstruLoc = protectionDonneesFormulaire($_POST["numeroSerieInstruLoc"]);
        $dateAchatInstruLoc = protectionDonneesFormulaire($_POST["dateAchatInstruLoc"]);

		if ($id > 0) {
			$instruLoc = Instrument_LocationRepo::getInstrument_Location($id);
			if ($instruLoc == null)
				header("location: ".RACINE_SITE."/admin/formulaires/formulaireInstrument_Location.php?instrument_LocationInconnu");
		}

		$instruLoc->setMarque($marqueInstruLoc);
        $instruLoc->setTypeInstrument($typeInstruLoc);
		$instruLoc->setModele($modeleInstruLoc);
        $instruLoc->setNumeroSerie($numeroSerieInstruLoc);
        $instruLoc->setDateAchat($dateAchatInstruLoc);

		if ($id == 0) {
			if (!Instrument_LocationRepo::insert($instruLoc))
				$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Insertion non effectuée<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
			else
				$message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Votre nouvel instrument de location a bien été enregistré !<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
				header("location: ".RACINE_SITE."/admin/formulaires/formulaireInstrument_Location.php?id=" . $instruLoc->GetIdInstrument());
		} else {
			if (!Instrument_LocationRepo::update($instruLoc))
				$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Modification non effectuée !<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
			else
				header("location: ".RACINE_SITE."/admin/formulaires/formulaireInstrument_Location.php?id=" . $instruLoc->GetIdInstrument());
		}
	} else
		$message = "<div class=\"alert alert-warning  alert-dismissible fade show\" role=\"alert\">Erreur : Le formulaire n'est pas complet<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button><button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
}

?>

<section class="page-section" id="formulaireClient">	
    <div class="container">

		<h2>Formulaire : Instrument Location</h2>

		<?php
		if (strlen($message) > 0) {
			echo $message;
		}
		?>

		<form action="<?php echo RACINE_SITE; ?>/admin/formulaires/formulaireInstrument_Location.php" method="post">
			<input type="hidden" id="idInstruLoc" name="idInstruLoc" value="<?php echo $instruLoc->getIdInstrument() ?>" />

			<div class="form-group">
				<label for="typeInstruLoc">TYPE :</label>
				<input type="text" class="form-control" id="typeInstruLoc" name="typeInstruLoc"
				value="<?php echo $instruLoc->getTypeInstrument() ?>" placeholder="Ex : Clarinette Sib" required>
			</div>
			<div class="form-group">
				<label for="marqueInstruLoc">MARQUE :</label>
				<input type="text" class="form-control" id="marqueInstruLoc" name="marqueInstruLoc"
				value="<?php echo $instruLoc->getMarque() ?>" placeholder="Ex :BUFFET CRAMPON" required>
			</div>
			<div class="form-group">
				<label for="modeleInstruLoc">MODÈLE :</label>
				<input type="text" class="form-control" id="modeleInstruLoc" name="modeleInstruLoc"
				value="<?php echo $instruLoc->getModele() ?>" placeholder="Ex : Divine" required>
			</div>
			<div class="form-group">
				<label for="numeroSerieInstruLoc">N° DE SÉRIE :</label>
				<input type="text" class="form-control" id="numeroSerieInstruLoc" name="numeroSerieInstruLoc"
				value="<?php echo $instruLoc->getNumeroSerie() ?>"
				placeholder="Veuillez insérer le numéro situé au dos du corps du haut de la clarinette." required>
			</div>
			<div class="form-group mb-4">
				<label for="dateAchatInstruLoc">DATE D'ACHAT :</label>
				<input type="date" class="form-control" id="dateAchatInstruLoc" name="dateAchatInstruLoc"
				value="<?php echo $instruLoc->getDateAchatISO() ?>" required>
			</div>
			<div class="form-group">
			<div class="text-center">
				<input type="submit" class="btn btn-primary" name="btnEnregistrer" value="Enregistrer">
			</div>
		</form>

	</div>
</section>

<?php
	require_once("../header_footer/footerAdmin.php");
?>