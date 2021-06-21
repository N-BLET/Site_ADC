<?php
require_once("../../connexion/gestionSession.php");
require_once("../header_footer/headerAdmin.php");

if (isset($_GET["idSuppression"])) {
	$id = protectionDonneesFormulaire($_GET["idSuppression"]);

	$instrumentSuppression = InstrumentRepo::getInstrument($id);
	if ($instrumentSuppression != null) {
		if (!InstrumentRepo::delete($instrumentSuppression))
			header("location: ".RACINE_SITE."/admin/tableaux/instruments.php?erreurSuppression");
	}
}

$lesInstruments = InstrumentRepo::getInstruments();
?>

<section class="page-section" id="instruments">	
	<div class="container">
		
		<h2>Gestion des instruments</h2>

		<p><a class="btn btn-primary" href='<?php echo RACINE_SITE; ?>/admin/formulaires/formulaireInstrument.php'>Ajouter</a></p>

		<form action="instruments.php" method="get" id="rechercheInstru">
			<div class="row">
				<div class="col-8">
					<input type="text" class="form-control" name="r" id="r" placeholder="Veuillez insérer le numéro de série de l'instrument recherché." value="<?= htmlentities($_GET['r'] ?? null)?>">
				</div>
				<div class="col-4">
					<input type="submit" class="btn btn-primary mb-4" name="btnRechercher" value="Rechercher">
				</div>
			</div>
		</form>

		<form action="instruments.php" method="get" id="rechercheClient">
			<div class="row">
				<div class="col-8">
					<input type="text" class="form-control" name="q" id="q" placeholder="Veuillez insérer les premières lettres du nom du client recherché." value="<?= htmlentities($_GET['q'] ?? null)?>">
				</div>
				<div class="col-4">
					<input type="submit" class="btn btn-primary mb-4" name="btnRechercher" value="Rechercher">
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
					<th></th>
					<th></th>
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
						$tr .= "<td>" . $instrument->getDateAchatStr() . "</td>";
						$tr .= "<td><a href=" . RACINE_SITE . "/admin/formulaires/formulaireInstrument.php?id=" . $instrument->GetIdInstrument() . "'>Modifier</a></td>";
						$tr .= "<td><a href=" . RACINE_SITE . "/admin/tableaux/instruments.php?idSuppression=" . $instrument->GetIdInstrument() . "'>Supprimer</a></td>";
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