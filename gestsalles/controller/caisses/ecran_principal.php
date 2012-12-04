<?php
	include_once("../session.php");
	check_session("caissier");

	include_once('../../model/db_connexion.php');
	include_once('../../model/caisses/get_next_two_hours_sessions.php');

	$_SESSION['monnaie'] = $_POST['tillContent'];
	
	$sessions = get_next_two_hours_sessions($_SESSION['id_cinema']);

	include_once('../../view/caisses/ecran_principal.php');
?>