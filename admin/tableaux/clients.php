<?php
require("./../../constante.php");
require_once(pathGetSession . "/connexion/gestionSession.php");
require_once("../header_footer/headerAdmin.php");

if (isset($_GET["idSuppression"])) {
	$id = protectionDonneesFormulaire($_GET["idSuppression"]);

	$clientSuppression = ClientRepo::getClient($id);
	if ($clientSuppression != null) {
		if (!ClientRepo::delete($clientSuppression))
			header("location: ".RACINE_SITE."/admin/tableaux/clients.php?erreurSuppression");
	}
}

$lesClients = ClientRepo::getClients();
$message = "";
?>

<section class="page-section" id="clients">	
	<div class="container">
		
		<h2>Gestion des clients</h2>

		<p><a class="btn btn-primary" href='<?php echo RACINE_SITE; ?>/admin/formulaires/formulaireClient.php'>Ajouter</a></p>

		<form action="clients.php" method="get" id="recherche">
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
					<th>NOM</th>
					<th>PRÉNOM</th>
					<th>ADRESSE</th>
					<th>CODE POSTAL</th>
					<th>VILLE</th>
					<th>TÉLÉPHONE</th>
					<th>EMAIL</th>
					<th>PROFIL ADMIN</th>
					<th>INSCRIPTION VALIDÉE</th>
					<th>JETON VALIDATION</th>
					<th></th>
					<th></th>
				</tr>

				<?php
				if(count($lesClients)>0) {
					$tr = '';
					foreach ($lesClients as $client) {
						$tr .= "<tr>";
						$tr .= "<td>" . $client->GetNom() . "</td>";
						$tr .= "<td>" . $client->GetPrenom() . "</td>";
						$tr .= "<td>" . $client->GetAdresse() . "</td>";
						$tr .= "<td>" . $client->GetVille()->GetCp() . "</td>";
						$tr .= "<td>" . $client->GetVille()->GetNomVille() . "</td>";
						$tr .= "<td>" . $client->GetTelephone() . "</td>";
						$tr .= "<td>" . $client->GetEmail() . "</td>";
						$tr .= "<td>" . $client->GetStatus() . "</td>";
						$tr .= "<td>" . $client->getValidationStatus() . "</td>";
						$tr .= "<td>" . $client->GetJetonValidation() . "</td>";
					
						$tr .= "<td><a href=" . RACINE_SITE . "/admin/formulaires/formulaireClient.php?id=" . $client->GetIdClient() . "'>Modifier</a></td>";
						$tr .= "<td><a href=" . RACINE_SITE . "/admin/tableaux/clients.php?idSuppression=" . $client->GetIdClient() . "'>Supprimer</a></td>";
						$tr .= "</tr>";
				}
				echo $tr;
				}else {
					echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Aucun client n'est répertorié.<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
					
				}	
				?>

			</table>
		</div>
	</div>
</section>
<?php
	require_once("../header_footer/footerAdmin.php");
?>