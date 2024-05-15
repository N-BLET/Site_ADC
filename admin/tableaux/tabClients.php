<?php
require_once("./../../includes/page.inc.php");
require_once("../header_footer/headerAdmin.php");

if (isset($_GET["suppressionId"])) {
	$id = protectionDonneesFormulaire($_GET["suppressionId"]);

	$clientSuppression = ClientRepo::getClient($id);
	if ($clientSuppression != null) {
		if (!ClientRepo::delete($clientSuppression))
			header("location: /admin/tableaux/clients.php?erreurSuppression");
	}
}

$lesClients = ClientRepo::getClients();
$message = "";

if (isset($_GET["suppressionId"])){
	$message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Votre client a bien été supprimé !<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
	echo $message;
}

if (isset($_GET["validation1"])){
	$message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Votre nouveau client a bien été enregistré !<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
	echo $message;
}

if (isset($_GET["validation2"])){
	$message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Les informations de votre client ont bien été modifiées !<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
	echo $message;
}

?>

<section class="page-section">	
	<div class="container">

		
		<h2>Gestion des clients</h2>

		<p><a class="btn btn-success" href='/admin/formulaires/formulaireClient.php'>Ajouter</a></p>

		<form action="clients.php" method="get" id="recherche">
			<div class="row">
				<div class="col-8">
					<input type="text" class="form-control" name="q" id="q" placeholder="Veuillez insérer les premières lettres du nom du client recherché." value="<?= htmlentities($_GET['q'] ?? null)?>">
				</div>
				<div class="col-4">
					<input type="submit" class="btn btn-info custom-btn-info mb-4" name="btnRechercher" value="Rechercher">
				</div>
			</div>
		</form>

		<div class="table-responsive">
			<table id="clients" class="table table-striped bg-light text-center" data-toggle="table" data-search="true">
				<tr class="table-dark">
					<th data-sortable="true">NOM</th>
					<th data-sortable="true">PRÉNOM</th>
					<th data-sortable="true">ADRESSE</th>
					<th data-sortable="true">CODE POSTAL</th>
					<th data-sortable="true">VILLE</th>
					<th data-sortable="true">TÉLÉPHONE</th>
					<th data-sortable="true">EMAIL</th>
					<th data-sortable="true">PROFIL ADMIN</th>
					<th data-sortable="true">INSCRIPTION VALIDÉE</th>
					<th data-sortable="true">JETON VALIDATION</th>
					<th colspan="2">ACTIONS</th>
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
					
						$tr .= "<td><a href='/admin/formulaires/formulaireClient.php?id=" . $client->GetIdClient() . "'><i class=\"far fa-edit\"></a></td>";
						$tr .= "<td><a href='/admin/tableaux/tabClients.php?suppressionId=" . $client->GetIdClient() . "'><i class=\"far fa-trash-alt text-danger\"></a></td>";
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