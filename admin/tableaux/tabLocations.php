<?php
require_once("./../../includes/page.inc.php");
require_once("../header_footer/headerAdmin.php");

if (isset($_GET["idSuppression"])) {
	$idLocation = protectionDonneesFormulaire($_GET["idSuppression"]);

	$locationSuppression = LocationRepo::getLocation($idLocation);
	if ($locationSuppression != null) {
		if (!LocationRepo::delete($locationSuppression))
			header("location: /admin/tableaux/locations.php?erreurSuppression");
	}
}

if (isset($_GET["idSuppression"])){
	$message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">La location a bien été supprimée !<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
	echo $message;
}

if (isset($_GET["Validation1"])){
	$message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Cette nouvelle location a bien été enregistrée !<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
	echo $message;
}

if (isset($_GET["Validation2"])){
	$message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Cette location a bien été modifiée !<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
	echo $message;
}

$lesLocations = LocationRepo::getLocations();
?>

<section class="page-section" id="locations">	
	<div class="container">

		<h2>Gestion des locations</h2>

		<p><a class="btn btn-success" href='/admin/formulaires/formulaireLocation.php'>Ajouter</a></p>

		<form action="locations.php" method="get" id="recherche">
			<div class="row">
				<div class="col-8">
					<input type="text" class="form-control" name="q" id="q" placeholder="Veuillez insérer les premières lettres du nom du client recherché.">
				</div>
				<div class="col-4">
					<input type="submit" class="btn btn-info mb-4" name="btnRechercher" value="Rechercher">
				</div>
			</div>
		</form>

		<div class="table-responsive">
			<table class="table table-striped bg-light text-center">
				<tr class="table-dark">
					<th>N° DE CONTRAT</th>
					<th>NOM DU CLIENT</th>
					<th>TYPE</th>
					<th>MODÈLE</th>
					<th>N° SÉRIE</th>
					<th>FORFAIT</th>
					<th>DÉBUT LOCATION</th>
					<th>FIN LOCATION</th>
					<th colspan="3">ACTIONS</th>
				</tr>

				<?php
				if(count($lesLocations)>0) {
					
					$tr = '';
					foreach ($lesLocations as $location) {
						$tr .= "<tr>";
						$tr .= "<td>" . $location->getIdLocation() . "</td>";
						$tr .= "<td>" . $location->getClient()->getNom() . " " . $location->getClient()->getPrenom() . "</td>";
						$tr .= "<td>" . $location->getInstrument()->getTypeInstrument() . "</td>";
						$tr .= "<td>" . $location->getInstrument()->getModele() . "</td>";
						$tr .= "<td>" . $location->getInstrument()->getNumeroSerie() . "</td>";
						$tr .= "<td>" . $location->getForfait()->getDuree() . "</td>";	
						$tr .= "<td>" . $location->getDateLocationTab() . "</td>";
						$tr .= "<td>" . $location->getFinLocationTab() . "</td>";
						$tr .= "<td><a href='/admin/formulaires/formulaireLocation.php?id=" . $location->GetIdLocation() . "'><i class=\"far fa-edit\"></a></td>";
						$tr .= "<td><a href='/admin/tableaux/tabLocations.php?idSuppression=" . $location->GetIdLocation() . "'><i class=\"far fa-trash-alt text-danger\"></a></td>";
						$tr .= "</tr>";
					}
					echo $tr;
				}else {
					echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Aucune location n'est répertoriée.<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
				}	
				?>

			</table>
		</div>
	</div>
</section>

<?php
	require_once("../header_footer/footerAdmin.php");
?>