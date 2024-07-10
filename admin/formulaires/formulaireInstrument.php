<?php
require_once("../../connexion/gestionSession.php");
require_once("../header_footer/headerAdmin.php");
require_once("../../includes/utils.php");
ob_start();

// Gestion des variables de la page
if (isset($_GET["type"]) && $_GET["type"] == "location") {
	$instrument = new Instrument(0, "", "", "", "", date('Y-m-d'), true, 0, 0);
} else {
	$instrument = new Instrument(0, "", "", "", "", date('Y-m-d'), false, 0, 0);
}

$lesClients = ClientRepo::getClients();
$message = "";

if (isset($_GET["id"])) {
	$id = protectionDonneesFormulaire($_GET["id"]);
	$instrument = InstrumentRepo::getInstrument($id);
	if ($instrument == null) {
		ob_end_flush();
		redirect("../index.php?instrumentInconnu");
		exit;
	}
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

		if ((isset($_GET["type"]) && $_GET["type"] == "location") && ($id > 0)) {
			$instrument = InstrumentRepo::getInstrumentLocation($id);
			if ($instrument == null) {
				ob_end_flush();
				redirect("../../connexion/index.php?instrument_LocationInconnu");
				exit;
			}
		} else if ($id > 0) {
			$instrument = InstrumentRepo::getInstrument($id);
			if ($instrument == null) {
				ob_end_flush();
				redirect("../../connexion/index.php?instrumentInconnu");
				exit;
			}
		}

		$instrument->setTypeInstrument($typeInstrument);
		$instrument->setMarque($marque);
		$instrument->setModele($modele);
		$instrument->setNumeroSerie($numeroSerie);
		$instrument->setDateAchat($dateAchat);
		if ($fkIdclient == "Aucun") {
			$instrument->setFkIdClient(null);
		} else {
			$instrument->setFkIdClient($fkIdclient);
		}
		if (isset($_GET["type"]) && $_GET["type"] == "location") {
			$instrument->setParcLocation(1);
		} else {
			$instrument->setParcLocation(0);
		}

		if ($id == 0) {
			if (!InstrumentRepo::insert($instrument)) {
				$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Insertion non effectuée<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
				echo $message;
			} else {
				if ((isset($_GET["type"]) && $_GET["type"] == "location")) {
					ob_end_flush();
					redirect("../tableaux/tabInstrument_Locations.php?Validation1");
					exit;
				} else {
					ob_end_flush();
					redirect("../tableaux/tabInstruments.php?Validation1");
					exit;
				}
			}
		} else {
			if (!InstrumentRepo::update($instrument)) {
				$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Modification non effectuée<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
				echo $message;
			} else {
				if ((isset($_GET["type"]) && $_GET["type"] == "location")) {
					ob_end_flush();
					redirect("../tableaux/tabInstrument_Locations.php?Validation1");
					exit;
				} else {
					ob_end_flush();
					redirect("../tableaux/tabInstruments.php?Validation1");
					exit;
				}
			}
		}
	} else {
		$message = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">Erreur : Le formulaire n'est pas complet<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
		echo $message;
	}
}
?>

<section class="page-section" id="formulaireClient">
	<div class="container">

		<h2>Formulaire : Instrument</h2>

		<?php
		if (strlen($message) > 0) {
			echo $message;
		}

		if (isset($_GET["type"]) && $_GET["type"] == "location") {
			echo "<form action=\"formulaireInstrument.php?type=location\" method=\"post\">";
		} else {
			echo "<form action=\"formulaireInstrument.php\" method=\"post\">";
		}
		?>
		<input type="hidden" id="idInstrument" name="idInstrument" value="<?php echo $instrument->getIdInstrument() ?>" />

		<div class="form-group">
			<label for="typeInstrument">TYPE :</label>
			<input type="text" class="form-control" id="typeInstrument" name="typeInstrument" value="<?php echo $instrument->getTypeInstrument() ?>" placeholder="Ex : Clarinette Sib" required>
		</div>
		<div class="form-group">
			<label for="marque">MARQUE :</label>
			<input type="text" class="form-control" id="marque" name="marque" value="<?php echo $instrument->getMarque() ?>" placeholder="Ex :BUFFET CRAMPON" required>
		</div>
		<div class="form-group">
			<label for="modele">MODÈLE :</label>
			<input type="text" class="form-control" id="modele" name="modele" value="<?php echo $instrument->getModele() ?>" placeholder="Ex : Divine" required>
		</div>
		<div class="form-group">
			<label for="numeroSerie">N° DE SÉRIE :</label>
			<input type="text" class="form-control" id="numeroSerie" name="numeroSerie" value="<?php echo $instrument->getNumeroSerie() ?>" placeholder="Veuillez insérer le numéro situé au dos du corps du haut de la clarinette." required>
		</div>
		<div class="form-group">
			<label for="dateAchat">DATE D'ACHAT :</label>
			<input type="date" class="form-control" id="dateAchat" name="dateAchat" value="<?php echo $instrument->getDateAchatForm() ?>" required>
		</div>
		<div class="form-group mb-4">
			<label for="fkIdClient">CLIENT :</label>
			<select id="fkIdClient" name="fkIdClient" class="form-control">
				<option value="0">Sélectionnez un client</option>
				<?php
				$option = "";
				$checkValue = false;
				if ($instrument->getClient() == null) {
					$option .= "<option value=\"Aucun\" selected>Aucun</option>";
					$checkValue = true;
				}
				foreach ($lesClients as $client) {
					if ($instrument->getClient() != null && $instrument->getIdInstrument() > 0 && $instrument->getClient()->getIdClient() == $client->getIdClient()) {
						$option .= "<option value=\"" . $client->getIdClient() . "\" selected>" . $client->getNom() . " " . $client->getPrenom() . "</option>";
					} else {
						$option .= "<option value=\"" . $client->getIdClient() . "\">" . $client->getNom() . " " . $client->getPrenom() . "</option>";
					}
				}
				if (isset($_GET["type"]) && $_GET["type"] == "location" && $checkValue == false) {
					$option .= "<option value=\"Aucun\">Aucun</option>";
				}
				echo $option;
				?>
			</select>
			<div class="rappel"><b>⚠ Rappel : </b><i>Si vous ne trouvez pas votre client dans la liste, pensez à l'ajouter comme nouveau client en premier.</i><br>
				<?php if (isset($_GET["type"]) && $_GET["type"] == "location") {
					echo "<i>Si votre créer un nouvel instrument de location :</i><br>
										➡️ <i>Veuillez sélectionner \"Aucun\" pour ne pas enregistrer un client si c'est instrument n'est pas tout de suite loué.</i>";
				}
				?>
			</div>
		</div>
		<div class="text-center">
			<a class="btn btn-dark col-md-1 mx-1" href='./../tableaux/tabInstruments.php'>Retour</a>
			<input type="submit" class="btn btn-success" name="btnEnregistrer" value="Enregistrer">
		</div>

		</form>

	</div>
</section>

<?php
require_once("../header_footer/footerAdmin.php");
?>