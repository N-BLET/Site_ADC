<?php
require_once(__DIR__ .'/includes/utils.php');

// Charger les variables d'environnement depuis le fichier .env
loadEnv(__DIR__ . '/.env');

define("pathGetSession", "../..");
define("SITE_PATH", $_ENV['SITE_PATH']);

