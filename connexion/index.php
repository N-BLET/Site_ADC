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

?>

<!doctype html>
<html lang="fr">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
    <title>Atelier des clarinettes</title>
	<!-- Favicon-->
	<link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
	<!-- Font Awesome icons (free version)-->
	<script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
	<!-- Google fonts-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
	<!-- Core theme CSS (includes Bootstrap)-->
	<link href="../css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">
	<!-- Navigation-->
	<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark" id="mainNav">
		<div class="container">
			<a class="navbar-brand" href="#page-top"><img src="../assets/img/logo.jpg" alt="Logo Atelier Des Clarinettes" /></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				Menu
				<i class="fas fa-bars ms-1"></i>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
					<li class="nav-item"><a class="nav-link text-ligth" href="/index.php#services">Services</a></li>
					<li class="nav-item"><a class="nav-link text-light" href="/index.php#entretien">Entretien</a></li>
					<li class="nav-item"><a class="nav-link text-light" href="/index.php#location">Location</a></li>
					<li class="nav-item"><a class="nav-link text-light" href="/index.php#portfolio">Vente</a></li>
					<li class="nav-item"><a class="nav-link text-light" href="/index.php#equipe">L'équipe</a></li>
					<li class="nav-item"><a class="nav-link text-light" href="/index.php#contact">Contact</a></li>
				</ul>
				<a class="btn btn-primary btn-social mx-2" href="https://www.facebook.com/latelierdesclarinettes"><i class="fab fa-facebook-f"></i></a>
			</div>
		</div>
	</nav>

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
					<input type="mail" class="form-control" id="email" name="email" value="" required/>
				</div>

				<div class="form-group mb-4">
					<label for="password">Password : </label>
					<input type="password" class="form-control" id="password" name="password" value="" required/>
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

	<footer class="footer py-4">
		<div class="container-fluid card-footer">
			<h4>Atelier des clarinettes</h4>
			<p>Le Bourg<br>42460 JARNOSSE</br></p>
			<p>Tél : 06.12.41.63.47</p>
			<p><a href="./../index.php">Retour sur le site</a></p>
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-12 my-3 my-lg-0">
						Copyright &copy; Atelier des Clarinettes
						<!-- This script automatically adds the current year to your website footer-->
						<!-- (credit: https://updateyourfooter.com/)-->
						<script>
							document.write(new Date().getFullYear());
						</script>
					</div>
					<div class="col-lg-12 my-3 my-lg-0 mt-2">
						<a class="btn btn-dark btn-social mx-2" href="https://www.facebook.com/latelierdesclarinettes"><i class="fab fa-facebook-f"></i></a>
					</div>
				</div>
			</div>     
    	</div>
	</footer>
</body>


<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="../js/scripts.js"></script>