<?php
require_once("../connexion/gestionSession.php");
require_once("./header_footer/header.php");
?>

<section class="container mt-5">
	<div class="container-header bg-success text-light text-center rounded">
		<h2>Bienvenue</h2> <span><?php echo $clientConnecte->getPrenom() . " " . $clientConnecte->getNom() ?></span>
	</div>

	<div class="container">
		<div class="row text-center">
			<div class="col-md-3 mt-5">
				<a href="./tableaux/infosClient.php" class="fa-stack fa-4x">
						<i class="fas fa-circle fa-stack-2x text-primary"></i>
						<i class="fas fa-user fa-stack-1x fa-inverse"></i>
				</a>
				<h4 class="my-3">Coordonnées</h4>
			</div>
			<div class="col-md-3 mt-5">
				<a href="./tableaux/instruments.php" class="fa-stack fa-4x">
					<i class="fas fa-circle fa-stack-2x text-primary"></i>
					<i class="fas fa-guitar fa-stack-1x fa-inverse"></i>
				</a>
				<h4 class="my-3">Instrument(s)</h4>
			</div>
			<div class="col-md-3 mt-5">
				<a href="./tableaux/entretiens.php" class="fa-stack fa-4x">
					<i class="fas fa-circle fa-stack-2x text-primary"></i>
					<i class="fas fa-cogs fa-stack-1x fa-inverse"></i>
				</a>
				<h4 class="my-3">Entretien(s)</h4>
			</div>
			<div class="col-md-3 mt-5">
				<a href="./tableaux/locations.php" class="fa-stack fa-4x">
					<i class="fas fa-circle fa-stack-2x text-primary"></i>
					<i class="fas fa-handshake fa-stack-1x fa-inverse"></i>
				</a>
				<h4 class="my-3">Location(s)</h4>
			</div>
		</div>
	</div>	
</section>

<?php
	require_once("./header_footer/footer.php");
?>