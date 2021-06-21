<?php
require_once("../../connexion/gestionSession.php");
require_once("../header_footer/headerAdmin.php");

if (isset($_GET["idSuppression"])) {
	$idLocation = protectionDonneesFormulaire($_GET["idSuppression"]);

	$locationSuppression = LocationRepo::getLocation($idLocation);
	if ($locationSuppression != null) {
		if (!LocationRepo::delete($locationSuppression))
			header("location: ".RACINE_SITE."/admin/tableaux/locations.php?erreurSuppression");
	}
}

$lesLocations = LocationRepo::getLocations();
?>

<section class="page-section" id="locations">	
	<div class="container">

		<h2>Gestion des locations</h2>

		<p><a class="btn btn-primary" href='<?php echo RACINE_SITE; ?>/admin/formulaires/formulaireLocation.php'>Ajouter</a></p>

		<form action="locations.php" method="get" id="recherche">
			<div class="row">
				<div class="col-8">
					<input type="text" class="form-control" name="q" id="q" placeholder="Veuillez insérer les premières lettres du nom du client recherché.">
				</div>
				<div class="col-4">
					<input type="submit" class="btn btn-primary mb-4" name="btnRechercher" value="Rechercher">
				</div>
			</div>
		</form>

		<div class="table-responsive">
			<table class="table table-striped bg-light text-center">
				<tr class="table-dark">
					<th>N° DE CONTRAT</th>
					<th>NOM DU CLIENT</th>
					<th>N° DE SÉRIE</th>
					<th>FORFAIT</th>
					<th>DÉBUT LOCATION</th>
					<th>FIN LOCATION</th>
					<th></th>
					<th></th>
				</tr>

				<?php
				if(count($lesLocations)>0) {
					
					$tr = '';
					foreach ($lesLocations as $location) {
						$tr .= "<tr>";
						$tr .= "<td>" . $location->getIdLocation() . "</td>";
						$tr .= "<td>" . $location->getClient()->getNom() . " " . $location->getClient()->getPrenom() . "</td>";
						$tr .= "<td>" . $location->getInstrument_Location()->getNumeroSerie() . "</td>";
						$tr .= "<td>" . $location->getForfait()->getDuree() . "</td>";
						$tr .= "<td>" . $location->getDateLocation() . "</td>";
						$tr .= "<td>" . $location->getFinLocation() . "</td>";
						$tr .= "<td><a href=" . RACINE_SITE . "/admin/formulaires/formulaireLocation.php?id=" . $location->GetIdLocation() . "'>Modifier</a></td>";
						$tr .= "<td><a href=" . RACINE_SITE . "/admin/tableaux/locations.php?idSuppression=" . $location->GetIdLocation() . "'>Supprimer</a></td>";
					echo $tr;
					}
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