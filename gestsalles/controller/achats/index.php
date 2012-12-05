<?php
	include_once("../session.php");
	check_session("acheteur");

	include_once('../../model/db_connexion.php');
	include_once('../../model/achats/get_movies.php');

	$movies = get_movies();
	foreach($movies as $key => $movie)
	{
		$movies[$key]['titre'] = htmlspecialchars($movie['titre']);
		$movies[$key]['genre'] = htmlspecialchars($movie['genre']);
		$movies[$key]['duree'] = htmlspecialchars($movie['duree']);
		$movies[$key]['sortie'] = htmlspecialchars($movie['sortie']);
		$movies[$key]['acteurs'] = htmlspecialchars($movie['acteurs']);
		$movies[$key]['description'] = htmlspecialchars($movie['description']);
		$movies[$key]['nb_copies_en_reserve'] = htmlspecialchars($movie['nb_copies_en_reserve']);
	}

	include_once('../../view/achats/liste_films.php');
?>