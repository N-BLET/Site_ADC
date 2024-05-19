<?php
require_once("./../../includes/page.inc.php");
require_once("../header_footer/headerAdmin.php");

if (isset($_GET["idSuppression"])) {
	$id = protectionDonneesFormulaire($_GET["idSuppression"]);

	$instrumentSuppression = InstrumentRepo::getInstrument($id);
	if ($instrumentSuppression != null) {
		if (!InstrumentRepo::delete($instrumentSuppression))
			header("location: /admin/tableaux/instruments.php?erreurSuppression");
	}
}

$lesInstruments = InstrumentRepo::getInstrumentsClient();
$message = "";

if (isset($_GET["idSuppression"])){
	$message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">L'instrument a bien été supprimé !<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
	echo $message;
}

if (isset($_GET["Validation1"])){
	$message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">L'instrument de votre client a bien été enregistré !<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
	echo $message;
}

if (isset($_GET["Validation2"])){
	$message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Les informations de l'instrument ont bien été modifiées !<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
	echo $message;
}
?>

<section class="page-section" id="instruments">	
	<div class="container">
		
		<h2>Gestion des instruments</h2>

		<p><a class="btn btn-success" href='/admin/formulaires/formulaireInstrument.php'>Ajouter</a></p>

		<form action="tabInstruments.php" method="get" id="rechercheInstru">
			<div class="row">
				<div class="col-8">
					<input type="text" class="form-control" name="r" id="r" placeholder="Veuillez insérer le numéro de série de l'instrument recherché." value="<?= htmlentities($_GET['r'] ?? null)?>">
				</div>
				<div class="col-4">
					<input type="submit" class="btn custom-btn-info mb-4" name="btnRechercher" value="Rechercher">
				</div>
			</div>
		</form>

		<form action="tabInstruments.php" method="get" id="rechercheClient">
			<div class="row">
				<div class="col-8">
					<input type="text" class="form-control" name="q" id="q" placeholder="Veuillez insérer les premières lettres du nom du client recherché." value="<?= htmlentities($_GET['q'] ?? null)?>">
				</div>
				<div class="col-4">
					<input type="submit" class="btn custom-btn-info mb-4" name="btnRechercher" value="Rechercher">
				</div>
			</div>
		</form>

		<div class="table-responsive">
			<table class="table table-striped bg-light text-center">
				<tr class="table-dark">
					<th>NOM DU CLIENT</th>
					<th>TYPE INSTRUMENT</th>
					<th>MARQUE</th>
					<th>MODÈLE</th>
					<th>N° DE SÉRIE</th>
					<th>DATE D'ACHAT</th>
					<th colspan="3">ACTIONS</th>
				</tr>
				<?php
				$tr ="";
				if (count($lesInstruments)>0) {
					foreach ($lesInstruments as $instrument) {
						$tr .= "<tr>";
						$tr .= "<td>" . $instrument->getClient()->getNom() . " " . $instrument->getClient()->getPrenom() .'</td>';
						$tr .= "<td>" . $instrument->GetTypeInstrument() . "</td>";
						$tr .= "<td>" . $instrument->GetMarque() . "</td>";
						$tr .= "<td>" . $instrument->GetModele() . "</td>";
						$tr .= "<td>" . $instrument->GetNumeroSerie() . "</td>";
						$tr .= "<td>" . $instrument->getDateAchatTab() . "</td>";
						$tr .= "<td><a href='/admin/tableaux/tabEntretiens.php?idInstrument=" . $instrument->GetIdInstrument() . "'><i class=\"fas fa-cog text-black-50\"></a></td>";
						$tr .= "<td><a href='/admin/formulaires/formulaireInstrument.php?id=" . $instrument->GetIdInstrument() . "'><i class=\"far fa-edit text-blue\"></a></td>";					
						$tr .= "<td><a href='/admin/tableaux/tabInstruments.php?idSuppression=" . $instrument->GetIdInstrument() . "'><i class=\"far fa-trash-alt text-danger\"></a></td>";
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