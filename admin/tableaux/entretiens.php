<?php
require_once("../../connexion/gestionSession.php"); 
require_once("../header_footer/headerAdmin.php");  

if (isset($_GET["idSuppression"])) {
	$idEntretien = protectionDonneesFormulaire($_GET["idSuppression"]);

	$entretienSuppression = EntretienRepo::getEntretien($idEntretien);
	if ($entretienSuppression != null) {
		if (!EntretienRepo::delete($entretienSuppression))
			header("location: ".RACINE_SITE."/admin/tableaux/entretiens.php?erreurSuppression");
	}
}

$lesEntretiens = EntretienRepo::getEntretiens();
?>
<section class="page-section" id="entretiens">	
	<div class="container">
		
		<h2>Gestion des entretiens</h2>

		<p><a class="btn btn-primary" href='<?php echo RACINE_SITE; ?>/admin/formulaires/formulaireEntretien.php'>Ajouter</a></p>

		<form action="entretiens.php" method="get" id="rechercheInstru">
			<div class="row">
				<div class="col-8">
					<input type="text" class="form-control" name="r" id="r" placeholder="Veuillez insérer le numéro de série de l'instrument recherché." value="<?= htmlentities($_GET['r'] ?? null)?>">
				</div>
				<div class="col-4">
					<input type="submit" class="btn btn-primary mb-4" name="btnRechercherInstru" value="Rechercher">
				</div>
			</div>
		</form>

		<form action="entretiens.php" method="get" id="rechercheClient">
			<div class="row">
				<div class="col-8">
					<input type="text" class="form-control" name="q" id="q" placeholder="Veuillez insérer les premières lettres du nom du client recherché." value="<?= htmlentities($_GET['q'] ?? null)?>">
				</div>
				<div class="col-4">
					<input type="submit" class="btn btn-primary mb-4" name="btnRechercherClient" value="Rechercher">
				</div>
			</div>
		</form>

		<div class="table-responsive">
			<table class="table table-striped bg-light text-center">
				<tr class="table-dark">
					<th>NOM DU CLIENT</th>
					<th>TYPE D'INSTRUMENT</th>
					<th>MARQUE</th>
					<th>MODÈLE</th>
					<th>N° DE SÉRIE</th>
					<th>DATE ENTRETIEN</th>
					<th>DESCRITPION ENTRETIEN</th>
					<th>MONTANT TTC</th>
					<th></th>
					<th></th>
				</tr>
				
				<?php
				if(count($lesEntretiens)>0) {
					$tr = '';
					foreach ($lesEntretiens as $entretien) {
						$tr .= "<tr>";
						$tr .= "<td>" . $entretien->getInstrument()->getClient()->getNom() . " " . $entretien->getInstrument()->getClient()->getPrenom() . "</td>";
						$tr .= "<td>" . $entretien->getInstrument()->GetTypeInstrument() . "</td>";
						$tr .= "<td>" . $entretien->getInstrument()->GetMarque() . "</td>";
						$tr .= "<td>" . $entretien->getInstrument()->GetModele() . "</td>";
						$tr .= "<td>" . $entretien->getInstrument()->GetNumeroSerie() . "</td>";
						$tr .= "<td>" . $entretien->getDateEntretienStr() . "</td>";
						$tr .= "<td>" . $entretien->GetDescriptionEntretien() . "</td>";
						$tr .= "<td>" . prix($entretien->GetPrixEntretien()) . "</td>";
						$tr .= "<td><a href=" . RACINE_SITE . "/admin/formulaires/formulaireEntretien.php?id=" . $entretien->GetIdEntretien() . "'>Modifier</a></td>";
						$tr .= "<td><a href=" . RACINE_SITE . "/admin/tableaux/entretiens.php?idSuppression=" . $entretien->GetIdEntretien() . "'>Supprimer</a></td>";
						$tr .= "</tr>";
					}
					echo $tr;
				}else {
					echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Aucun entretien n'est répertorié.<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
				}
				?>

			</table>
		</div>
	</div>
</section>
<?php
	require_once("../header_footer/footerAdmin.php");
?>