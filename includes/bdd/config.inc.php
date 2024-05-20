<?php

function loadEnv($path)
{
    if (!file_exists($path)) {
        throw new Exception('Le fichier .env n\'existe pas.');
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Ignorer les commentaires
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        // Diviser la ligne en clé et valeur
        list($key, $value) = explode('=', $line, 2);

        // Supprimer les espaces et les guillemets
        $key = trim($key);
        $value = trim($value, " \t\n\r\0\x0B\"");

        // Définir la variable d'environnement
        $_ENV[$key] = $value;
    }
}

// Charger les variables d'environnement depuis le fichier .env
loadEnv(__DIR__ . '/../../.env');

// Utilisation des variables d'environnement
define("BD_HOST", $_ENV['BD_HOST']);
define("BD_BASE", $_ENV['BD_BASE']);
define("BD_USER", $_ENV['BD_USER']);
define("BD_PASSWORD", $_ENV['BD_PASSWORD']);
define("DEBUG", filter_var($_ENV['DEBUG'], FILTER_VALIDATE_BOOLEAN));
