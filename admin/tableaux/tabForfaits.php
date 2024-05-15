<?php
require_once("./../../includes/page.inc.php");
require_once("../header_footer/headerAdmin.php");

if (isset($_GET["idSuppression"])) {
	$idForfait = protectionDonneesFormulaire($_GET["idSuppression"]);

	$forfaitSuppression = ForfaitRepo::getForfait($idForfait);
	if ($forfaitSuppression != null) {
		if (!ForfaitRepo::delete($forfaitSuppression))
			header("location: /admin/tableaux/forfaits.php?erreurSuppression");
	}
}

$lesForfaits = ForfaitRepo::getForfaits();
$message = "";

if (isset($_GET["idSuppression"])){
    $message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Le forfait a bien été supprimé !<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
    echo $message;
}

if (isset($_GET["Validation1"])){
	$message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\"><strong>Votre nouveau forfait a bien été enregistré !</strong><button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
	echo $message;
}

if (isset($_GET["Validation2"])){
	$message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\"><strong>Votre forfait a bien été modifié !</strong><button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
	echo $message;
}
?>

<section class="page-section" id="forfaits">	
	<div class="container">
		<h2>Gestion des forfaits</h2>

		<p><a class="btn btn-success" href='/admin/formulaires/formulaireForfait.php'>Ajouter</a></p>

		<div class="table-responsive">
			<table class="table table-striped bg-light text-center">
				<tr class="table-dark">
					<th>DURÉE</th>
					<th>TARIF</th>
					<th colspan="2">ACTIONS</th>
				</tr>
				<?php
				if(count($lesForfaits)>0) {
					$tr = '';
					foreach ($lesForfaits as $forfait) {
						$tr .= "<tr>";
						$tr .= "<td>" . $forfait->GetDuree() . "</td>";
						$tr .= "<td>" . prix($forfait->GetTarif()) . "</td>";
						$tr .= "<td><a href='/admin/formulaires/formulaireForfait.php?id=" . $forfait->GetIdForfait() . "'><i class=\"far fa-edit\"></a></td>";
						$tr .= "<td><a href='/admin/tableaux/tabForfaits.php?idSuppression=" . $forfait->GetIdForfait() . "'><i class=\"far fa-trash-alt text-danger\"></a></td>";
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