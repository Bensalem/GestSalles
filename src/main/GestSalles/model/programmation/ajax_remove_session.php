<?php
	include('../db_connexion.php');

	$cinema = $_GET['cinema'];
	$date = $_GET['date'];
	$room = $_GET['room'];
	$beginTime = $_GET['begin'];

	$req = $db->prepare('DELETE FROM projections WHERE date = :date AND heure_debut = :debut
		AND EXISTS (SELECT cinemas.nom_cinema FROM cinemas WHERE cinemas.id_cinema = projections.id_cinema
		AND cinemas.nom_cinema = :cinema) AND EXISTS (SELECT salles.nom_salle FROM salles
		WHERE salles.id_salle = projections.id_salle AND nom_salle = :salle)');

	$req->bindValue(':cinema', $cinema, PDO::PARAM_STR);
	$req->bindValue(':salle', $room, PDO::PARAM_STR);
	$req->bindValue(':date', $date, PDO::PARAM_INT);
	$req->bindValue(':debut', $beginTime, PDO::PARAM_STR);
	$req->execute();
	echo 0;
?>

