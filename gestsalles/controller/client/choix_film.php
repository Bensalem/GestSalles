<?php
	include_once('../../model/db_connexion.php');
	include_once('../../model/client/get_session_movies.php');

	$id_cinema = $_POST['id_cinema'];
	$cinema_name = $_POST['cinemaName'];

	$movies = get_session_movies($id_cinema);
	include_once('../../view/client/choix_film.php');
?>