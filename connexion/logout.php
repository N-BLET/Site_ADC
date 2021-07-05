<?php
require_once('../includes/page.inc.php');

session_start();
$_SESSION["client"] = NULL;
session_destroy($client);
header("location: ". RACINE_SITE ."/index.php");