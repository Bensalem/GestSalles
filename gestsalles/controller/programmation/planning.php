<?php
	include_once("../session.php");
	check_session("programmateur");

	include('date.php');
	include_once('../../model/db_connexion.php');
	include_once('../../model/programmation/get_cinemas.php');

	$cinemas = get_cinemas();
	foreach($cinemas as $key => $cine)
	{
		$cinemas[$key]['nom_cinema'] = htmlspecialchars($cine['nom_cinema']);
	}

	include_once('../../view/programmation/planning.php');
?>