<?php
require_once("../connexion/gestionSession.php");
require_once("./header_footer/headerAdmin.php");

?>
<div class="container" style="height:100px;">
	<p></p>
</div>
<div class="container bg-light text-center text-dark mt-5">
	<div class="card-header bg-warning rounded-top ">
		<h4>Bienvenue dans votre espace d'administration !</h4>
	</div>
	<div class="card-body bg-dark text-light rounded-bottom mb-5">		
		<p>Cet espace vous permettra de gérer votre site, chaque onglet ci-dessus vous donnera la possibilité d'ajouter, modifier ou bien supprimer chaque point de votre gestion.
	</div>
</div>
<div class="container" style="height:50px;">
	<p></p>
</div>   
<?php
	require_once("./header_footer/footerAdmin.php");
?>