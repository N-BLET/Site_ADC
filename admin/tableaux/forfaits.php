<?php
require_once("../../connexion/gestionSession.php");
require_once("../header_footer/headerAdmin.php");

if (isset($_GET["idSuppression"])) {
	$idForfait = protectionDonneesFormulaire($_GET["idSuppression"]);

	$forfaitSuppression = ForfaitRepo::getForfait($idForfait);
	if ($forfaitSuppression != null) {
		if (!ForfaitRepo::delete($forfaitSuppression))
			header("location: ".RACINE_SITE."/admin/tableaux/forfaits.php?erreurSuppression");
	}
}

$lesForfaits = ForfaitRepo::getForfaits();
?>

<section class="page-section" id="forfaits">	
	<div class="container">
		<h2>Gestion des forfaits</h2>

		<p><a class="btn btn-primary" href='<?php echo RACINE_SITE; ?>/admin/formulaires/formulaireForfait.php'>Ajouter</a></p>

		<div class="table-responsive">
			<table class="table table-striped bg-light text-center">
				<tr class="table-dark">
					<th>DURÉE</th>
					<th>TARIF</th>
					<th></th>
					<th></th>
				</tr>
				<?php
				if(count($lesForfaits)>0) {
					$tr = '';
					foreach ($lesForfaits as $forfait) {
						$tr .= "<tr>";
						$tr .= "<td>" . $forfait->GetDuree() . "</td>";
						$tr .= "<td>" . prix($forfait->GetTarif()) . "</td>";
						$tr .= "<td><a href=" . RACINE_SITE . "/admin/formulaires/formulaireForfait.php?id=" . $forfait->GetIdForfait() . "'>Modifier</a></td>";
						$tr .= "<td><a href=" . RACINE_SITE . "/admin/tableaux/forfaits.php?idSuppression=" . $forfait->GetIdForfait() . "'>Supprimer</a></td>";
						$tr .= "</tr>";	
					}
					echo $tr;
				}else {
					echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Aucun forfait n'est répertorié.<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
				}
				?>
			</table>
		</div>
	</div>
</section>
<?php
	require_once("../header_footer/footerAdmin.php");
?>		