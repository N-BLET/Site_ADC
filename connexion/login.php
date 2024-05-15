<?php

require_once("../includes/page.inc.php");

session_start();

@$email = protectionDonneesFormulaire($_POST["email"]);
@$password = protectionDonneesFormulaire($_POST["password"]);
@$envoyer = $_POST["btnEnvoyer"];

if (isset($envoyer)) {
    if (!isset($email) || !isset($password)) {
        header("location: ./index.php?erreurAuthentification2");
       
    }

    $client = ClientRepo::authentification($email, $password);
    if ($client != null) {
        $_SESSION["Client"] = $client;
        header("location: ./../client/accueil.php");
    } else
        header("location: ./index.php?erreurAuthentification3");
} else
    header("location: ./index.php?erreurAuthentification1");
