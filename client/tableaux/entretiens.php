<?php
require_once("./../../connexion/gestionSession.php");
require_once("../header_footer/header.php");

// Gestion des variables de la page
$client = $_SESSION["Client"];
$idClient = $client->getIdClient();
$lesInstruments = InstrumentRepo::getInstruSelonClient($idClient);
$lesEntretiens = EntretienRepo::getEntretiensSelonClient($idClient);
?>

<section class="container">
    <div class="card-header bg-warning rounded border border-dark">
			<h2>Vos entretiens par instrument</h2>
		</div>
		<?php 
       
                if(count($lesEntretiens)>0) {
                    foreach ($lesEntretiens as $entretien) {
                        if(count($lesInstruments)>0) {
                            foreach($lesInstruments as $instrument) {
                                $data = '';
                                $data = "<div class=\"col\">
                                        <div class=\"card-body border border-dark rounded my-3\">
                                            <div class=\"row\">
                                                <h5 class=\"text-danger mb-3\">Instrument : " . $instrument->GetTypeInstrument() . " | " .  $instrument->GetModele() . " | N° : " . $instrument->GetNumeroSerie() . "</h5>";
                        $data .= "<div class=\"row\">
                                    <div class=\"col-md-3\">
                                        <h6>DATE DE L'ENTRETIEN :</h6>
                                    </div>
                                    <div class=\"col-md-9\">
                                        <p>" . $entretien->getDateEntretienStr() . "</p>
                                    </div>
                                </div>";
                        $data .= "<div class=\"row\">
                                    <div class=\"col-md-3\">
                                        <h6>DESCRIPTION DE L'ENTRETIEN :</h6>
                                    </div>
                                    <div class=\"col-md-9\">
                                        <p>" . $entretien->GetDescriptionEntretien() . "</p>
                                    </div>
                                </div>";
                        $data .= "<div class=\"row\">
                                    <div class=\"col-md-3\">
                                        <h6>PRIX DE L'ENTRETIEN :</h6>
                                    </div>
                                    <div class=\"col-md-9\">
                                        <p>" . prix($entretien->GetPrixEntretien()) . "</p>
                                    </div>
                                </div>
                                </div>
                            </div>";
                    }
                    echo $data;
                }else {
                    echo "<div class=\"container text-center my-4\">
                            <div class=\"alert alert-warning text-dark\" role=\"alert\">Aucun entretien n'a été effectué sur vos instrument.</div>
                        </div>";
                
                }  
            }
        }else {
            echo "<div class=\"container text-center my-4\">
                    <div class=\"alert alert-warning text-dark\" role=\"alert\">Aucun instrument n'est répertorié.</div>
                </div>";
        }
		?>
		<div class="text-center mb-3">
			<a class="btn btn-primary" href='/client/accueil.php'>Retour</a>
		</div>
	</div>
</section>

<?php
	require_once("../header_footer/footer.php");
?>