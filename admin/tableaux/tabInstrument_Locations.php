<?php
require_once("./../../includes/page.inc.php");
require_once("../header_footer/headerAdmin.php");

if (isset($_GET["idSuppression"])) {
	$id = protectionDonneesFormulaire($_GET["idSuppression"]);

	$instruLocSuppression = InstrumentRepo::getInstrument($id);
	if ($instruLocSuppression != null) {
		if (!InstrumentRepo::delete($instruLocSuppression))
			header("location: /admin/tableaux/instrument_Locations.php?erreurSuppression");
	}
}

$lesinstruLocs = InstrumentRepo::getInstrumentsLocation();
$message = "";


if (isset($_GET["idSuppression"])){
	$message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">L'instrument a bien été supprimé !<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
	echo $message;
}
if (isset($_GET["Validation1"])){
	$message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Votre nouvel instrument de location a bien été enregistré !<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
	echo $message;
}

if (isset($_GET["Validation2"])){
	$message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Le changement d'informations sur votre instrument ont bien été pris en compte.<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
	echo $message;
}


?>
<section class="page-section" id="instruments">	
	<div class="container">
		
		<h2>Gestion des instruments de location</h2>

		<p><a class="btn btn-success" href='/admin/formulaires/formulaireInstrument.php?type=location'>Ajouter</a></p>

		<form action="tabInstrument_Locations.php" method="get" id="rechercheType">
			<div class="row">
				<div class="col-8">
					<input type="text" class="form-control" name="s" id="s" placeholder="Veuillez insérer le type d'instruments recherchés." value="<?= htmlentities($_GET['s'] ?? '')?>">
				</div>
				<div class="col-4">
					<input type="submit" class="btn custom-btn-info mb-4" name="btnRechercher" value="Rechercher">
				</div>
			</div>
		</form>

		<form action="tabInstrument_Locations.php" method="get" id="rechercheModele">
			<div class="row">
				<div class="col-8">
					<input type="text" class="form-control" name="q" id="q" placeholder="Veuillez insérer le modèle d'instruments recherchés." value="<?= htmlentities($_GET['q'] ?? '')?>">
				</div>
				<div class="col-4">
					<input type="submit" class="btn custom-btn-info mb-4" name="btnRechercherClient" value="Rechercher">
				</div>
			</div>
		</form>

		<form action="tabInstrument_Locations.php" method="get" id="rechercheInstru">
			<div class="row">
				<div class="col-8">
					<input type="text" class="form-control" name="r" id="r" placeholder="Veuillez insérer le numéro de série de l'instrument recherché." value="<?= htmlentities($_GET['r'] ?? '')?>">
				</div>
				<div class="col-4">
					<input type="submit" class="btn custom-btn-info mb-4" name="btnRechercherClient" value="Rechercher">
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
					<th>CLIENT</th>
					<th colspan="3">ACTIONS</th>
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
						$tr .= "<td>" . $instruLoc->GetDateAchatTab() . "</td>";
						$tr .= "<td>" . $instruLoc->isStatutLocation() . "</td>";
						if($instruLoc->getClient() != null){
							$tr .= "<td>" . $instruLoc->getClient()->getNom() . "</td>";
						}else{
							$tr .= "<td>aucun</td>";
						}
						$tr .= "<td><a href='/admin/tableaux/tabEntretiens.php?idInstrument=" . $instruLoc->GetIdInstrument() . "'><i class=\"fas fa-cog text-black-50\"></a></td>";
						$tr .= "<td><a href='/admin/formulaires/formulaireInstrument.php?id=" . $instruLoc->GetIdInstrument() . "&type=location'><i class=\"far fa-edit text-blue\"></a></td>";
						$tr .= "<td><a href='/admin/tableaux/tabInstrument_Locations.php?idSuppression=" . $instruLoc->GetIdInstrument() . "'><i class=\"far fa-trash-alt text-danger\"></a></td>";
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