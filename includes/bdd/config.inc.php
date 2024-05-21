<?php
require_once(__DIR__ .'/../utils.php');

// Charger les variables d'environnement depuis le fichier .env
loadEnv(__DIR__ . '/../../.env');

// Utilisation des variables d'environnement
define("BD_HOST", $_ENV['BD_HOST']);
define("BD_BASE", $_ENV['BD_BASE']);
define("BD_USER", $_ENV['BD_USER']);
define("BD_PASSWORD", $_ENV['BD_PASSWORD']);
define("DEBUG", filter_var($_ENV['DEBUG'], FILTER_VALIDATE_BOOLEAN));
