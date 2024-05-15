<?php
require_once("./../../connexion/gestionSession.php");
require_once("../header_footer/header.php");

// Gestion des variables de la page
$client = $_SESSION["Client"];
$message = "";
?>

<section class="container">
		<div class="card-header bg-warning rounded-top border-top border-start border-end border-dark">
			<h2>Vos coordonnées</h2>
		</div>
		<div class="card-body border border-dark rounded-bottom">
			<div class="row">
				<div class="col-md-2">
					<h6>NOM :</h6>
				</div>
				<div class="col-md-10">
					<p><?php echo $client->GetNom()?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<h6>PRÉNOM :</h6>
				</div>
				<div class="col-md-10">
					<p><?php echo $client->GetPrenom()?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<h6>ADRESSE :</h6>
				</div>
				<div class="col-md-10">
					<p><?php echo $client->GetAdresse()?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<h6>VILLE :</h6>
				</div>
				<div class="col-md-10">
					<p><?php echo $client->GetVille()->getNomVille()?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<h6>EMAIL :</h6>
				</div>
				<div class="col-md-10">
					<p><?php echo $client->GetEmail()?></p>
				</div>
			</div>
			<div class="container">
				<div class="row g-2">
					<a class="btn btn-primary col-md-2 mx-2" href='/client/accueil.php'>Retour</a>
					<a class="btn btn-primary col-md-2 mr-2" href='/client/tableaux/formulaireInfosClient.php?id= <?php echo $client->GetIdClient() ?>'>Modifier</a>
					
				</div>
			</div>
		</div>
	</div>
</section>

<?php
	require_once("../header_footer/footer.php");
?>