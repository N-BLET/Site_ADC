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