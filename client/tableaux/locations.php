<?php
require_once("./../../connexion/gestionSession.php");
require_once("../header_footer/header.php");

// Gestion des variables de la page
/*echo "<pre>";
echo $_SESSION;
echo "</pre>";*/

$client = $_SESSION["Client"];
$idClient = $client->getIdClient();
echo $idClient . " TOTO !!!";
$lesLocations = LocationRepo::getLocationSelonClient($idClient);
require_once("../header_footer/header.php");
?>

<section class="container">
    <div class="card-header bg-warning rounded border border-dark">
        <h2>Vos contrats de locations</h2>
    </div>
    <?php if(count($lesLocations)>0) {
        $data = '';
        foreach ($lesLocations as $location) {
            $data .= "<div class=\"col\">
                        <div class=\"card-body border border-dark rounded my-3\">
                            <div class=\"row\">
                                <div class=\"col-md-3\">
                                    <h6>N° DE CONTRAT :</h6>
                                </div>
                                <div class=\"col-md-9\">
                                    <p>" . $location->GetIdLocation() . "</p>
                                </div>
                            </div>";
            $data .= "<div class=\"row\">
                        <div class=\"col-md-3\">
                            <h6>TYPE DU CONTRAT :</h6>
                        </div>
                        <div class=\"col-md-9\">
                            <p>" . $location->GetForfait()->getDuree() . "</p>
                        </div>
                    </div>";
            $data .= "<div class=\"row\">
                        <div class=\"col-md-3\">
                            <h6>MONTANT DU CONTRAT :</h6>
                        </div>
                        <div class=\"col-md-9\">
                            <p>" . prix($location->GetForfait()->GetTarif()) . "</p>
                        </div>
                    </div>";
            $data .= "<div class=\"row\">
                        <div class=\"col-md-3\">
                            <h6>DATE DU CONTRAT :</h6>
                        </div>
                        <div class=\"col-md-9\">
                            <p>" . $location->GetDateLocation() . "</p>
                        </div>
                    </div>";
            $data .= "<div class=\"row\">
                        <div class=\"col-md-3\">
                            <h6>DATE DE FIN DE CONTRAT :</h6>
                        </div>
                        <div class=\"col-md-9\">
                            <p>" . $location->GetFinLocation() ."</p>
                        </div>
                    </div>
                    </div>
                </div>";
			}
			echo $data;
			}else {
				echo "<div class=\"container text-center my-4\">
						<div class=\"alert alert-warning text-dark\" role=\"alert\">Aucun contrat de location n'est en cours.</div>
					</div>";
			}
		?>
		<div class="text-center mb-3">
			<a class="btn btn-dark" href='/client/accueil.php'>Retour</a>
		</div>
	</div>
</div>

<?php
	require_once("../header_footer/footer.php");
?>