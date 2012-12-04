<?php
	include_once('../../model/db_connexion.php');
	include_once('../../model/client/get_cinemas_with_sessions.php');

	$cinemas = get_cinemas_with_sessions();
	foreach($cinemas as $key => $cine)
	{
		$cinemas[$key]['nom_cinema'] = htmlspecialchars($cine['nom_cinema']);
		$cinemas[$key]['nom_cinema'] = htmlspecialchars($cine['nom_cinema']);
		$cinemas[$key]['num_et_rue'] = htmlspecialchars($cine['num_et_rue']);
		$cinemas[$key]['ville'] = htmlspecialchars($cine['ville']);
	}

	include_once('../../view/client/choix_cinema.php');
?>