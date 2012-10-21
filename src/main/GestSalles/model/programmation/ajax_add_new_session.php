<?php
	include('../db_connexion.php');

	define("OVERLAPPPING_ERROR", 1);

	$cinema = $_GET['cinema'];
	$date_timestamp = $_GET['date'];
	$movie = $_GET['movie'];
	$room = $_GET['room'];
	$beginTime = $_GET['begin'];
	$endTime = $_GET['end'];

	$date = date("Y-m-d", $date_timestamp);

	$req = $db->prepare('SELECT COUNT(*) AS OverlappingSessionsNb FROM projections
		INNER JOIN cinemas ON (projections.id_cinema = cinemas.id_cinema)
		INNER JOIN salles ON (projections.id_salle = salles.id_salle)
		WHERE cinemas.nom_cinema = :cinema AND date = :date AND salles.nom_salle = :salle AND
		(heure_debut BETWEEN :debut AND :fin) OR (heure_fin BETWEEN :debut AND :fin) OR
		(:debut BETWEEN heure_debut AND heure_fin) OR (:fin BETWEEN heure_debut AND heure_fin)');

	$req->bindParam(':cinema', $cinema, PDO::PARAM_STR);
	$req->bindParam(':salle', $room, PDO::PARAM_STR);
	$req->bindParam(':date', $date, PDO::PARAM_INT);
	$req->bindParam(':debut', $beginTime, PDO::PARAM_STR);
	$req->bindParam(':fin', $endTime, PDO::PARAM_STR);
	$req->execute();

	$req = $req->fetch();
	$overlapping_sessions_nb = $req['OverlappingSessionsNb'];

	if ($overlapping_sessions_nb != 0)
	{
		echo OVERLAPPPING_ERROR;
		exit;
	}

	

/*
	$query = "SELECT * FROM films";

	$movies = $db->query($query);

	while ($movie = $movies->fetch())
	{
		echo "<option value=\"".$movie['titre']."\">".$movie['titre']."</option><br />";
	}

	$movies->closeCursor();
*/
?>

