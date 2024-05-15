<?php
require_once("./../../connexion/gestionSession.php");
require_once("../header_footer/header.php");

// Gestion des variables de la page
$client = $_SESSION["Client"];
$idClient = $client->getIdClient();
//echo $idClient;
$lesInstruments = InstrumentRepo::getInstruSelonClient($idClient);
?>

<section class="container">
	<div class="card-header bg-warning rounded border border-dark">
		<h2>Vos instruments</h2>
	</div>
	<?php if(count($lesInstruments)>0) {
		$data = '';
		foreach ($lesInstruments as $instrument) {
			$data .= "<div class=\"col\">
						<div class=\"card-body border border-dark rounded my-3\">
							<div class=\"row\">
								<div class=\"col-md-2\">
									<h6>TYPE :</h6>
								</div>
								<div class=\"col-md-10\">
									<p>" . $instrument->GetTypeInstrument() . "</p>
								</div>
							</div>";
				$data .= "<div class=\"row\">
							<div class=\"col-md-2\">
								<h6>MARQUE :</h6>
							</div>
							<div class=\"col-md-10\">
								<p>" . $instrument->GetMarque() . "</p>
							</div>
						</div>";
				$data .= "<div class=\"row\">
							<div class=\"col-md-2\">
								<h6>MODÈLE :</h6>
							</div>
							<div class=\"col-md-10\">
								<p>" . $instrument->GetModele() . "</p>
							</div>
						</div>";
				$data .= "<div class=\"row\">
							<div class=\"col-md-2\">
								<h6>N° DE SÉRIE :</h6>
							</div>
							<div class=\"col-md-10\">
								<p>" . $instrument->GetNumeroSerie() . "</p>
							</div>
						</div>";
				$data .= "<div class=\"row\">
							<div class=\"col-md-2\">
								<h6>DATE D'ACHAT :</h6>
							</div>
							<div class=\"col-md-10\">
								<p>" . $instrument->getDateAchatTab() . "</p>
							</div>
						</div>
					</div>";
		}
		echo $data;
		}else {
			echo "<div class=\"container text-center my-4\">
				<div class=\"alert alert-warning text-dark alert-dismissible fade show\" role=\"alert\">Aucun instrument n'est répertorié.<button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div></div>";
		}
	?>
	<div class="text-center">
		<a class="btn btn-dark" href='/client/accueil.php'>Retour</a>
	</div>
	</div>
</section>

<?php
	require_once("../header_footer/footer.php");
?>