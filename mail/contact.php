<?php
require_once("../includes/page.inc.php");
require_once("/../constante.php");

if (isset($_POST["btnEnvoyer"])){
   if(empty($_POST['nom']) && empty($_POST['email']) && empty($_POST['telephone']) && empty($_POST['sujet']) && empty($_POST['message']) && ($_POST['email'])) {
      echo "Votre message n'a pas été envoyer, merci de rééssayer à nouveau ou bien de nous contacter par téléphone.";
   } else {

      $nom = protectionDonneesFormulaire($_POST['nom']);
      $email = protectionDonneesFormulaire($_POST['email']);
      $telephone = protectionDonneesFormulaire($_POST['telephone']);
      $sujet = protectionDonneesFormulaire($_POST['sujet']);
      $message = protectionDonneesFormulaire($_POST['message']);
      if (!verifEmail($email)) {
         header("location: ".SITE_PATH."/index.php?emailNonConforme");
      } else {
      recevoirMail($email, $sujet, $message);
      header ("location: ".SITE_PATH."/index.php?messageOk");
      }
   }
}