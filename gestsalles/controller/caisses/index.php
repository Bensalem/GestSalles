<?php
	include_once("../session.php");
	check_session("caissier");

	include_once('../../model/db_connexion.php');
	include_once('../../model/caisses/get_till_content.php');

	$till = get_till_content($_SESSION['id_caisse']);
	include('../../view/caisses/init_caisse.php');
?>