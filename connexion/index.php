<?php
require_once("../includes/page.inc.php");

$message = "";
if (isset($_GET["pasAutorise"]))
	$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Vous n'êtes pas autorisé à accéder à cette page <button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";

if (isset($_GET["pasAdmin"]))
	$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Vous n'êtes pas autorisé à accéder à cette page d'administration <button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";

if (isset($_GET["erreurAuthentification1"]))
	$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur d'authentification (1) <button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";

if (isset($_GET["erreurAuthentification2"]))
	$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Veuillez compléter les 2 champs obligatoires pour vous connecter. <button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";

if (isset($_GET["erreurAuthentification3"]))
	$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Votre adresse email ou bien votre mot de passe est incorrect. <button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";

if (isset($_GET["inscriptionOK"]))
	$message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Votre demande d'inscription est enregistrée ! <button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";

if (isset($_GET["validationOK"]))
	$message = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Votre validation est effectuée ! Vous pouvez maintenant vous connecter. <button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";

if (isset($_GET["validationDejaOK"]))
	$message = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">Votre validation est déjà effectuée. <button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";

if (isset($_GET["validationNOK"]))
	$message = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">Votre validation n'est pas effectuée. <button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button></div>";

require_once("../client/header_footer/header.php"); ?>


<div class="container" style="height:25px;">
	<p></p>
</div>
<div class="container bg-light text-dark">
	<div class="card-header bg-warning rounded-top">
		<h2>Connexion</h2>
	</div>
	<div class="card-body bg-dark text-light rounded-bottom mb-5">

		<?php
		if (strlen($message) > 0) {
			echo $message;
		}
		?>

		<form action="./login.php" method="post">
			<div class="form-group">
				<label for="email">Email : </label>
				<input type="mail" class="form-control" id="email" name="email" value="" required />
			</div>

			<div class="form-group mb-4">
				<label for="password">Password : </label>
				<input type="password" class="form-control" id="password" name="password" value="" required />
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-primary" name="btnEnvoyer" value="Envoyer" />
			</div>
		</form>
		<div class="text-center">
			<a href="./inscription.php">Inscription</a>
		</div>
	</div>
</div>

<?php require_once("../client/header_footer/footer.php"); ?>|
</body>