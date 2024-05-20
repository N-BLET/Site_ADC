<?php
require_once(dirname(__FILE__) . '/../includes/page.inc.php');

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