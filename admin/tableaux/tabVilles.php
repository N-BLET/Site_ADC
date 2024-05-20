<?php
require_once("./../../includes/page.inc.php");
require_once("../header_footer/headerAdmin.php");

if (isset($_GET["idSuppression"])) {
	$idVille = protectionDonneesFormulaire($_GET["idSuppression"]);

	$villeSuppression = VilleRepo::getVille($idVille);
	if ($villeSuppression != null) {
		if (!VilleRepo::delete($villeSuppression))
			header("location: /admin/tableaux/villes.php?erreurSuppression");
	}
}

$lesVilles = VilleRepo::getVilles();
$message = "";

if (isset($_GET["idSuppression"])){
	$message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">La ville a bien été supprimée !<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
	echo $message;
}

if (isset($_GET["Validation1"])){
	$message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Une ville a bien été rajoutée !<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
	echo $message;
}

if (isset($_GET["Validation2"])){
	$message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Les informations de la ville ont bien été modifiées !<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
	echo $message;
}


?>

<section class="page-section" id="produits">	
	<div class="container">
		
		<h2>Gestion des villes</h2>

		<p><a class="btn btn-success mb-4" href='/admin/formulaires/formulaireVille.php'>Ajouter</a></p>
		
		<form action="tabVilles.php" method="get" id="recherche">
			<div class="row">
				<div class="col-8">
					<input type="text" class="form-control" name="q" id="q" placeholder="Rechercher par ville" value="<?= htmlentities($_GET['q'] ?? '')?>">
				</div>
				<div class="col-4">
					<input type="submit" class="btn custom-btn-info mb-4" name="btnRechercher" value="Rechercher">
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
					<th colspan="2">ACTIONS</th>
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
						$tr .= "<td><a href='/admin/formulaires/formulaireVille.php?id=" . $ville->GetIdVille() . "'><i class=\"far fa-edit text-blue\"></a></td>";
						$tr .= "<td><a href='/admin/tableaux/tabVilles.php?idSuppression=" . $ville->GetIdVille() . "'><i class=\"far fa-trash-alt text-danger\"></a></td>";
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

