<?php
require_once("../../connexion/gestionSession.php");
require_once("../header_footer/headerAdmin.php");  

if (isset($_GET["idSuppression"])) {
	$id = protectionDonneesFormulaire($_GET["idSuppression"]);

	$instruLocSuppression = Instrument_LocationRepo::getInstrument_Location($id);
	if ($instruLocSuppression != null) {
		if (!Instrument_LocationRepo::delete($instruLocSuppression))
			header("location: ".RACINE_SITE."/admin/tableaux/instrument_Locations.php?erreurSuppression");
	}
}

$lesinstruLocs = Instrument_LocationRepo::getInstruments_Location();
?>
<section class="page-section" id="instruments">	
	<div class="container">
		
		<h2>Gestion des instruments de location</h2>

		<p><a class="btn btn-primary" href='<?php echo RACINE_SITE; ?>/admin/formulaires/formulaireInstrument_Location.php'>Ajouter</a></p>

		<form action="instrument_Locations.php" method="get" id="rechercheType">
			<div class="row">
				<div class="col-8">
					<input type="text" class="form-control" name="s" id="s" placeholder="Veuillez insérer le type d'instruments recherché." value="<?= htmlentities($_GET['s'] ?? null)?>">
				</div>
				<div class="col-4">
					<input type="submit" class="btn btn-primary mb-4" name="btnRechercher" value="Rechercher">
				</div>
			</div>
		</form>

		<form action="instrument_Locations.php" method="get" id="rechercheModele">
			<div class="row">
				<div class="col-8">
					<input type="text" class="form-control" name="q" id="q" placeholder="Veuillez insérer le modèle d'instruments recherché." value="<?= htmlentities($_GET['q'] ?? null)?>">
				</div>
				<div class="col-4">
					<input type="submit" class="btn btn-primary mb-4" name="btnRechercherClient" value="Rechercher">
				</div>
			</div>
		</form>

		<form action="instrument_Locations.php" method="get" id="rechercheInstru">
			<div class="row">
				<div class="col-8">
					<input type="text" class="form-control" name="r" id="r" placeholder="Veuillez insérer le numéro de série de l'instrument recherché." value="<?= htmlentities($_GET['r'] ?? null)?>">
				</div>
				<div class="col-4">
					<input type="submit" class="btn btn-primary mb-4" name="btnRechercherClient" value="Rechercher">
				</div>
			</div>
		</form>

		<div class="table-responsive">
			<table class="table table-striped bg-light text-center">
				<tr class="table-dark">
					<th>TYPE INSTRUMENT</th>
					<th>MARQUE</th>
					<th>MODÈLE</th>
					<th>N° DE SÉRIE</th>
					<th>DATE D'ACHAT</th>
					<th>LOUÉ</th>
					<th></th>
					<th></th>
				</tr>
				<?php
				$tr ="";
				if (count($lesinstruLocs)>0) {
					foreach ($lesinstruLocs as $instruLoc) {
						$tr .= "<tr>";
						$tr .= "<td>" . $instruLoc->GetTypeInstrument() . "</td>";
						$tr .= "<td>" . $instruLoc->GetMarque() . "</td>";
						$tr .= "<td>" . $instruLoc->GetModele() . "</td>";
						$tr .= "<td>" . $instruLoc->GetNumeroSerie() . "</td>";
						$tr .= "<td>" . $instruLoc->GetDateAchatStr() . "</td>";
						$tr .= "<td>" .  $instruLoc->GetStatus() . "</td>";
						$tr .= "<td><a href=" . RACINE_SITE . "/admin/formulaires/formulaireInstrument_Location.php?id=" . $instruLoc->GetIdInstrument() . "'>Modifier</a></td>";
						$tr .= "<td><a href=" . RACINE_SITE . "/admin/tableaux/instrument_Locations.php?idSuppression=" . $instruLoc->GetIdInstrument() . "'>Supprimer</a></td>";
						$tr .= "</tr>";
					}
					echo $tr;				
				}else {
					echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Aucun instrument n'est répertorié.<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
				}
				?>
			</table>
		</div>
	</div>
</section>

<?php
	require_once("../header_footer/footerAdmin.php");
?>