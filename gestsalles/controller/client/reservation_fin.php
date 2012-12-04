<?php
	include_once('../../model/db_connexion.php');
	include_once('../../model/client/save_reservation.php');

	$id_session = $_POST['id_session'];
	$date = $_POST['date'];
	$cinema = $_POST['cinemaName'];
	$movieTitle = $_POST['movieTitle'];
	$duration = $_POST['duration'];
	$beginHour = $_POST['beginHour'];
	$price = $_POST['price'];
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$email = $_POST['email'];

	saveReservationInDB($firstName, $lastName, $email, $id_session);
	include_once('../../view/client/reservation_fin.php');
?>