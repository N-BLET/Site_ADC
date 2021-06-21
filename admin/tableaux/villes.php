<?php
require_once("../../connexion/gestionSession.php");
require_once("../header_footer/headerAdmin.php");

if (isset($_GET["idSuppression"])) {
	$idVille = protectionDonneesFormulaire($_GET["idSuppression"]);

	$villeSuppression = VilleRepo::getVille($idVille);
	if ($villeSuppression != null) {
		if (!VilleRepo::delete($villeSuppression))
			header("location: ".RACINE_SITE."/admin/tableaux/villes.php?erreurSuppression");
	}
}

$lesVilles = VilleRepo::getVilles();
?>

<section class="page-section" id="produits">	
	<div class="container">
		
		<h2>Gestion des villes</h2>

		<p><a class="btn btn-primary mb-4" href='<?php echo RACINE_SITE; ?>/admin/formulaires/formulaireVille.php'>Ajouter</a></p>
		
		<form action="villes.php" method="get" id="recherche">
			<div class="row">
				<div class="col-8">
					<input type="text" class="form-control" name="q" id="q" placeholder="Rechercher par ville" value="<?= htmlentities($_GET['q'] ?? null)?>">
				</div>
				<div class="col-4">
					<input type="submit" class="btn btn-primary mb-4" name="btnRechercher" value="Rechercher">
				</div>
			</div>
		</form>
		
		<div class="table-responsive">
			<table class="table table-striped bg-light text-center">
				<tr class="table-dark">
					<th>VILLE</th>
					<th>CODE POSTAL</th>
					<th>DÉPARTEMENT</th>
					<th>RÉGION</th>
					<th></th>
					<th></th>
				</tr>

				<?php
				
				if(count($lesVilles)>0) {
					$tr = '';
					foreach ($lesVilles as $ville) {
						$tr .= "<tr>";
						$tr .= "<td>" . $ville->GetNomVille() . "</td>";
						$tr .= "<td>" . $ville->GetCp() . "</td>";
						$tr .= "<td>" . $ville->GetDepartement() . "</td>";
						$tr .= "<td>" . $ville->GetRegion() . "</td>";
						$tr .= "<td><a href=" . RACINE_SITE . "/admin/formulaires/formulaireVille.php?id=" . $ville->GetIdVille() . "'>Modifier</a></td>";
						$tr .= "<td><a href=" . RACINE_SITE . "/admin/tableaux/villes.php?idSuppression=" . $ville->GetIdVille() . "'>Supprimer</a></td>";
						$tr .= "</tr>";
					}
					echo $tr;
				}else {
					echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Aucune ville n'est répertoriée.<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
				}
				?>

			</table>
		</div>
	</div>
</section>

<?php
require_once("../header_footer/footerAdmin.php");
?>

