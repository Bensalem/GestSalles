<?php
	include_once("../session.php");
	check_session("caissier");

	$sessionId = $_POST['sessionId'];
	$movieTitle = $_POST['movieTitle'];
	$edition = $_POST['edition'];
	$beginHour = $_POST['beginHour'];
	$duration = $_POST['duration'];
	$room = $_POST['room'];
	$price = $_POST['price'];

	include_once("../../view/caisses/paiement_carte.php");
?>