<?php
require('../includes/page.inc.php');

if (isset($_GET["jeton"])) {
	$jeton = protectionDonneesFormulaire($_GET["jeton"]);

	// On recherche le client lié à ce jeton
	$client = ClientRepo::getClientSelonJeton($jeton);
	var_dump($client);
	if ($client != null) {
		// Si le client n'est pas valide, on le valide
		if (!$client->getEstValide()) {
			$client->setEstValide(true);
			
			ClientRepo::update($client);
			header("location: /connexion/index.php?validationOK");
		} else
			header("location: /connexion/index.php?validationDejaOK");
	} else
		header("location: /connexion/index.php?validationNOK");
}
