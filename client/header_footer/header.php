<!doctype html>
<html lang="fr">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
    <title>Atelier des clarinettes</title>
	<!-- Favicon-->
	<link rel="icon" type="image/x-icon" href="../../assets/favicon.ico" />
	<!-- Font Awesome icons (free version)-->
	<script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
	<!-- Google fonts-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
	<!-- Core theme CSS (includes Bootstrap)-->
	<link href="<?php echo RACINE_SITE; ?>/css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">
	<!-- Navigation-->
	<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top"><img src="<?php echo RACINE_SITE; ?>/assets/img/logo.jpg" alt="Logo Atelier Des Clarinettes" /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link text-ligth" href="<?php echo RACINE_SITE; ?>/index.php#services">Services</a></li>
                        <li class="nav-item"><a class="nav-link text-light" href="<?php echo RACINE_SITE; ?>/index.php#entretien">Entretien</a></li>
                        <li class="nav-item"><a class="nav-link text-light" href="<?php echo RACINE_SITE; ?>/index.php#location">Location</a></li>
                        <li class="nav-item"><a class="nav-link text-light" href="<?php echo RACINE_SITE; ?>/index.php#portfolio">Vente</a></li>
                        <li class="nav-item"><a class="nav-link text-light" href="<?php echo RACINE_SITE; ?>/index.php#equipe">L'équipe</a></li>
                        <li class="nav-item"><a class="nav-link text-light" href="<?php echo RACINE_SITE; ?>/index.php#contact">Contact</a></li>
                        <?php
                        if($_SESSION["Client"]){
                            if ($clientConnecte->getProfilAdmin()) {
                                echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"".RACINE_SITE."/admin/index.php\">Administation</a></li>";
                            }
                        }
                        ?>
                    </ul>
                    <a class="btn btn-primary btn-social mx-2" href="https://www.facebook.com/latelierdesclarinettes"><i class="fab fa-facebook-f"></i></a>
                </div>
            </div>
        </nav>