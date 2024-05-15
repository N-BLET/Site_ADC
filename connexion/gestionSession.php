<?php
require_once('C:/wamp64/www/NFA021-ADC/includes/page.inc.php');

session_start();

if ($_SESSION["Client"] == null) {
	header("location: /connexion/index.php?pasAutorise");
	exit();
}

$clientConnecte = $_SESSION["Client"];

if (!$clientConnecte->getEstValide()) {
	header("location: /connexion/index.php?pasClient");
	exit();
}