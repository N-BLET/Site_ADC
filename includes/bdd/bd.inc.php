<?php

function connexionBD()
{
	try {
		$BD = new PDO("mysql:host=127.0.0.1; dbname=nfa021Projet; charset=UTF8", "root", "CnamData");
		return $BD;
	} catch (Exception $e) {
		echo "<pre>";
		echo $e;
		echo "</pre>";
		//echo "<p> Problème de connexion à la base de données. </p>";
		exit();
	}
}