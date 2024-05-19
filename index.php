<?php

    if (isset($_GET["messageOk"]))
        echo " <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Votre message a bien été envoyé.<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button></div>"; 
    if (isset($_GET["emailNonConforme"]))
        echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Votre message n'a pas été envoyé. Merci de réessayer votre envoi ou bien de nous contacter par téléphone au : 06.12.41.63.47.<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Atelier des clarinettes</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top"><img src="assets/img/logo.jpg" alt="Logo ADC" /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="#entretien">Entretien</a></li>
                        <li class="nav-item"><a class="nav-link" href="#location">Location</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio">Vente</a></li>
                        <li class="nav-item"><a class="nav-link" href="#equipe">L'équipe</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    </ul>
                    <a class="btn btn-primary btn-social mx-2" href="https://www.facebook.com/latelierdesclarinettes"><i class="fab fa-facebook-f"></i></a>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading">Bienvenue dans notre atelier !</div>
                <div class="masthead-heading text-uppercase">Notre talent, la musique</div>
                <div style="height: 70px;"></div>
                <a class="btn btn-primary btn-xl text-uppercase" href="./connexion/index.php">Connectez-vous</a>
            </div>
        </header>
        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Nos services</h2>
                    <h3 class="section-subheading text-muted">L'Atelier des Clarinettes vous propose la réparation, la location, la vente de clarinettes neuves ou d'occasion, ainsi que la vente d'accessoires autour de la clarinette. Professeurs et concertistes, forts d'une solide expérience en lutherie, Anne et Jocelyn Guichon axent leur expertise sur la clarinette pour offrir des prestations de réparation et de conseil haut de gamme.
                    <br>Soutenus par les grandes maisons Buffet Crampon et BG, l'Atelier des clarinettes est à votre disposition pour vous faire découvrir une large gamme d'accessoires sur place. Il peut aussi se déplacer lors de manifestations musicales.</br></h3>
                </div>
                <div class="row text-center">
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-cogs fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Entretien</h4>
                        <p class="text-muted">Nous vous proposons, après expertise, d'établir un devis précis des travaux à effectuer. En plus des réparations courantes, trois formules principales vous sont proposées avec démontage complet de l'instrument.</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-handshake fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Location</h4>
                        <p class="text-muted">Révisé annuellement et maintenu en parfait état de fonctionnement, notre parc de location est à votre disposition.
                            De plus, la révision de l’ instrument, prévue dans votre contrat, est naturellement gratuite (sous réserve d’usure et d’utilisation normale).</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Vente</h4>
                        <p class="text-muted">Nous vous proposons différents accessoires (bec, barillet, ligature, écouvillon...) afin d'améliorer vos sensations et la maîtrise de votre instrument, ainsi que de son entretien.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Entretien-->
        <section class="page-section" id="entretien">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Entretien</h2>
                    <h3 class="section-subheading text-muted">Concernant les réparations, nous vous proposons, après expertise, d'établir un devis précis des travaux à effectuer. En plus des réparations courantes, trois formules principales vous sont proposées avec démontage complet de l'instrument. Le devis gratuit effectué, nous programmons la date d'intervention pour ne pas immobiliser votre instrument trop longtemps. Selon les cas, un prêt d'instrument peut être possible en fonction des stocks disponibles. La formule retenue dépendra de l'état de votre instrument au jour de notre expertise. La révision conseillée vous garantit de retrouver un instrument avec une meilleure qualité de jeu et une facilité d'émission optimisée.</h3>
                </div>
                <div class="row text-center">
                    <div class="col-md-4">
                        <img src="assets/img/forfait/1.png" alt="">
                        <h4 class="my-3">Révision partielle</h4>
                        <p class="text-muted">Destinée aux clarinettes suivies régulièrement. Elle permet aux musiciens de bénéficier d'un instrument toujours en parfait état.</p>
                        <p class="text-start">
                            <ul class="text-start">
                                <li>détection de fuites *</li>
                                <li>nettoyage et entretien du bois</li>
                                <li>changement des ressorts, lièges, lièges tenons et tampons défectueux</li>
                                <li>rectification des jeux mécaniques</li>
                                <li>essai et réglage des levées</li>
                            </ul>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <img src="assets/img/forfait/2.png" alt="">
                        <h4 class="my-3">Révision totale</h4>
                        <p class="text-muted">Destinée aux clarinettes n'ayant suivie aucun entretien durant plus de 3 ans ou pour améliorer les performances de la configuration d'origine.</p>
                        <p>
                            <ul class="text-start">
                                <li>détection et réparation des fuites</li>
                                <li>nettoyage, entretien du bois et avivage des clés</li>
                                <li>retamponnage complet en cuir</li>
                                <li>changement de tous les lièges</li>
                                <li>remise à neuf des lièges tenons</li>
                                <li>changement des ressorts défectueux</li>
                                <li>rectification des jeux mécaniques</li>
                                <li>essai et réglage des levées</li>
                            </ul>
                        </p>
                        <p class="text-warning text-start mb-0">options possibles :
                            <ul class="text-start">
                                <li>en goretex + 70€</li>
                                <li>lièges tenons synthétiques + 30€</li>
                            </ul>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <img src="assets/img/forfait/3.png" alt="">
                        <h4 class="my-3">Révision totale pro</h4>
                        <p class="text-muted">Destinée aux musiciens exigeants et soucieux de conserver leurs propres réglages tout en bénéficiant du savoir-faire de l'Atelier des Clarinettes.
                        </p>
                        <p>
                            <ul class="text-start">
                                <li>inventaire des préférences de jeux, levées et tensions des ressorts</li>
                                <li>détection et réparation des fuites </li>
                                <li>nettoyage, entretien du bois et avivage des clés</li>
                                <li>retamponnage complet en suivant l'inventaire en gore tex</li>
                                <li>changement de tous les lièges</li>
                                <li>remise à neuf des lièges tenons par du liège ou synthétique</li>
                                <li>changement des ressorts défectueux </li>
                                <li>essai et réglage des levées</li>
                            </ul>
                        </p>
                        <p class="text-warning text-start ml-5 mb-0">essai approfondi pour :
                            <ul class="text-start">
                                <li>rectification des jeux mécaniques</li>
                                <li>réglage des levées</li>
                                <li>réglage de tensions des ressorts</li>
                                <li>vérification de la justesse</li>
                            </ul>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Location-->
        <section class="page-section" id="location">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Location</h2>
                    <h3 class="section-subheading text-muted">Révisé annuellement et maintenu en parfait état de fonctionnement, notre parc de location est à votre disposition. De même, la révision de l’ instrument, prévue dans votre contrat, est naturellement gratuite (sous réserve d’usure et d’utilisation normale).</h3>
                    <p>Un RIB, une pièce d’identité et un chèque de caution de la valeur de l’instrument vous seront demandés.</p>
                </div>
                <div class="row text-center">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Instruments</th>
                                <th>Tarifs annuels</th>
                                <th>Tarif trimestriel</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Clarinette</td>
                                <td>180,00 €</td>
                                <td>90,00 €</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
        </section>
        <!-- Location Grid-->
        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Vente</h2>
                    <h3 class="section-subheading text-muted">Présentation de notre séléction d'accessoires qui vous apporteront une aisance avec votre clarinette. <br>N'hésitez pas à venir les essayer dans notre atelier !!!</br></h3>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <!-- Portfolio item 1-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal1">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/1.jpg" alt="Ligature LD1" />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">LIGATURE</div>
                                <div class="portfolio-caption-subheading text-muted">LD1 BG</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <!-- Portfolio item 2-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal2">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/2.jpg" alt="Ligature L4SR" />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">LIGATURE</div>
                                <div class="portfolio-caption-subheading text-muted">L4SR BG</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <!-- Portfolio item 3-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal3">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/3.jpg" alt="Anches Vandoren" />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">ANCHES</div>
                                <div class="portfolio-caption-subheading text-muted">3.5 V12 VANDOREN</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
                        <!-- Portfolio item 4-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal4">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/4.jpg" alt="Harnais CC80" />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">HARNAIS</div>
                                <div class="portfolio-caption-subheading text-muted">CC80 BG</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4 mb-sm-0">
                        <!-- Portfolio item 5-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal5">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/5.jpg" alt="Écouvillon A32" />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">ÉCOUVILLON</div>
                                <div class="portfolio-caption-subheading text-muted">A32 BG</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <!-- Portfolio item 6-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal6">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/6.jpg" alt="Support pouce A23" />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">SUPPORT POUCE</div>
                                <div class="portfolio-caption-subheading text-muted">A23 BG</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Team-->
        <section class="page-section bg-light" id="equipe">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Notre fabuleuse équipe</h2>
                    <h3 class="section-subheading text-muted">Unis au service de votre clarinette mais aussi dans la vie.</h3>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="assets/img/team/1.jpg" alt="..." />
                            <h4>Jocelyn GUICHON</h4>
                            <p class="text-muted">Clarinettiste, professeur et réparateur</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="assets/img/team/2.jpg" alt="..." />
                            <h4>Anne GUICHON</h4>
                            <p class="text-muted">Clarinettiste, professeur et réparatrice</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Contactez-nous</h2>
                    <h3 class="section-subheading text-warning">Pour prendre rendez-vous ou bien pour tous renseignements.</h3>
                </div>
                <form id="contactForm" action="./mail/contact.php" method="post">
                    <div class="row align-items-stretch mb-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control" id="nom" name="nom" type="text" placeholder="Votre nom et prénom *" required="required" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="email" name="email" type="email" placeholder="Votre Email *" required="required" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="telephone" name="telephone" type="tel" placeholder="Votre numéro de téléphone ex: 0123456789 *" maxlength="10" required="required" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="sujet" name="sujet"type="text" placeholder="Sujet de votre message *" required="required" />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-textarea">
                                <textarea class="form-control" id="message" name="message"placeholder="Votre message *" required="required"></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <div id="success"></div>
                        <button class="btn btn-primary btn-xl text-uppercase" id="btnEnvoyer" name="btnEnvoyer" type="submit">Envoyer</button>
                    </div>
                </form>
            </div>
        </section>
        
        <!-- Footer-->
        <footer class="footer py-4">
            <div class="container-fluid card-footer">
                <h4>Atelier des clarinettes</h4>
                <div class="mb-0">
                    <p>Rue Sainte Cécile<br>69000 LYON</br></p>
                </div>
                <div class="mt-0">
                    <p>Tél : 06.12.34.56.78</p>
                </div>
                <div class="container">
                    <div class="row align-items-center">
                        <div class=class="col-lg-12 my-3 my-lg-0">
                            Copyright &copy; Atelier des Clarinettes
                            <!-- This script automatically adds the current year to your website footer-->
                            <!-- (credit: https://updateyourfooter.com/)-->
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                        </div>
                        <div class="col-lg-12 my-4 my-lg-0">
                            <a class="btn btn-warning btn-social mx-2" href="https://www.facebook.com/latelierdesclarinettes"><i class="fab fa-facebook-f"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Portfolio Modals-->
        <!-- Portfolio item 1 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">LIGATURE</h2>
                                    <p class="item-intro text-muted">LD1 BG</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/1.jpg" alt="Ligature LD1" />
                                    <p>Duo plaquée Or, cette ligature procure un son centré et riche dans tous les registres, avec une grande projection.</p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong>Catégorie du produit :</strong>
                                            LIGATURE
                                        </li>
                                        <li>
                                            <strong>référence du produit :</strong>
                                            LD1 BG
                                        </li>
                                        <li>
                                            <strong>Prix TTC du produit :</strong>
                                            103,50€
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-times me-1"></i>
                                       Retour
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 2 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">LIGATURE</h2>
                                    <p class="item-intro text-muted">L4SR BG</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/2.jpg" alt="Ligature L4SR" />
                                    <p>Équipée d'un support plaqué Or, cette ligature procure un son brillant et compact avec une radiance exceptionnelle.</p>
                                    <ul class="list-inline">
									    <li>
                                            <strong>Catégorie du produit :</strong>
                                            LIGATURE
                                        </li>
                                        <li>
                                            <strong>Référence du produit :</strong>
                                            L4SR BG
                                        </li>
                                        <li>
                                            <strong>Prix du produit :</strong>
                                            47,52 €
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-times me-1"></i>
                                        Retour
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 3 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">ANCHES</h2>
                                    <p class="item-intro text-muted">Anches pour clarinette Sib 3.5 V12 VANDOREN.</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/3.jpg" alt="Anches vandoren" />
                                    <p>Les anches V•12 sont taillées dans des tubes de roseau de diamètre équivalent à celui utilisé pour les anches de saxophone alto. De ce fait, les V•12 sont plus épaisses aux deux extrémités que les anches traditionnelles. Elles vibrent sur une plus longue palette et procurent un son riche et profond. Le bout plus épais donne du corps à l’attaque et augmente également la longévité de l’anche.</p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong>Catégorie du produit :</strong>
                                            ANCHES
                                        </li>
                                        <li>
                                            <strong>Référence du produit :</strong>
                                            3.5 V12 VANDOREN
                                        </li>
                                        <li>
                                            <strong>Prix du produit :</strong>
                                            33,03 €
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-times me-1"></i>
                                        Retour
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 4 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">HARNAIS</h2>
                                    <p class="item-intro text-muted">Harnais pour clarinette basse CC80 BG</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/4.jpg" alt="Harnais CC80" />
                                    <p>Harnais nylon, épaulettes en cuir doublées d’éponge, 6 points de réglage, crochet métal équipé de  1 rallonge en cuir. BG vous propose pour chaque moment et chaque situation ainsi que pour tout type de morphologie, un cordon bien adapté</p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong>Catégorie du produit :</strong>
                                            HARNAIS
                                        </li>
                                        <li>
                                            <strong>Référence du produit :</strong>
                                            CC80 BG
                                        </li>
                                        <li>
                                            <strong>Prix du produit :</strong>
                                            61,20 €
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-times me-1"></i>
                                        Retour
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 5 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">Écouvillon</h2>
                                    <p class="item-intro text-muted">Écouvillon pour clarinette Sib A32.</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/5.jpg" alt="Écouvillon A32" />
                                    <p>Ecouvillon doux en microfibre à forte capacité d'absorption pour nettoyer l'intérieur de l'instrument.</p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong>Catégorie du produit :</strong>
                                            ÉCOUVILLON
                                        </li>
                                        <li>
                                            <strong>Référence du produit :</strong>
                                            A32 BG
                                        </li>
                                        <li>
                                            <strong>Prix du produit :</strong>
                                            13,72 €
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-times me-1"></i>
                                        Retour
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 6 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">SUPPORT POUCE</h2>
                                    <p class="item-intro text-muted">Support de maintien pour clarinette Sib.</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/6.jpg" alt="Support pouce A23" />
                                    <p>Cette protection de support pouce en caoutchouc apporte un confort supplémentaire et empêche la formation de callosité.</p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong>Catégorie du produit :</strong>
                                            SUPPORT POUCE
                                        </li>
                                        <li>
                                            <strong>Référence du produit :</strong>
                                            A23 BG
                                        </li>
                                        <li>
                                            <strong>Prix du produit :</strong>
                                            3,10 €
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-times me-1"></i>
                                        Retour
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
