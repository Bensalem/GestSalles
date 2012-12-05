<?php
	include_once("../session.php");
	check_session("acheteur");

	include_once('../../model/db_connexion.php');
	include_once('../../model/achats/add_movie.php');

	$titre = $_POST['titre'];
	$genre = $_POST['genre'];
	$duree = $_POST['duree'];
	$sortie = $_POST['sortie'];
	$acteurs = $_POST['acteurs'];
	$description = $_POST['description'];
	$nb_copies = $_POST['nb_copies'];

	$movies = add_movie($titre, $genre, $duree, $sortie,
				$acteurs, $description, $nb_copies);

	include_once('../../view/achats/confirmation_ajout_film.php');
?>