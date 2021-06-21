<?php
require_once('../includes/page.inc.php');

session_start();
session_destroy();
header("location: ". RACINE_SITE ."/index.php");