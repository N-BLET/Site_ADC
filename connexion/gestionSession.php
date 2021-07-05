<?php
require_once('C:/Program Files/UwAmp/www/NFA021_ADC/includes/page.inc.php');

session_start();

if ($_SESSION["Client"] == null) {
	header("location: ".RACINE_SITE."/connexion/index.php?pasAutorise");
	exit();
}

$clientConnecte = $_SESSION["Client"];

if (!$clientConnecte->getEstValide()) {
	header("location: ".RACINE_SITE."/connexion/index.php?pasClient");
	exit();
}