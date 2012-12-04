<?php
	include_once('../../model/db_connexion.php');
	include_once('../../model/client/get_sessions_for_movie.php');

	$id_cinema = $_POST['id_cinema'];
	$cinema_name = $_POST['cinemaName'];
	$id_movie = $_POST['id_movie'];

	$sessions = get_sessions_for_movie($id_cinema, $id_movie);
	include_once('../../view/client/choix_seance.php');
?>