<?php
	include('../db_connexion.php');

	define("ERROR_OVERLAPPING", 1);
	define("SUCCESS", 0);

	$cinema = $_GET['cinema'];
	$date = $_GET['date'];
	$movie = $_GET['movie'];
	$room = $_GET['room'];
	$beginTime = $_GET['begin'];
	$endTime = $_GET['end'];

	$req = $db->prepare('SELECT COUNT(*) AS OverlappingSessionsNb FROM projections
		INNER JOIN cinemas ON (projections.id_cinema = cinemas.id)
		INNER JOIN salles ON (projections.id_salle = salles.id)
		WHERE cinemas.nom_cinema = :cinema AND date = :date AND salles.nom_salle = :salle AND
		((heure_debut BETWEEN :debut AND :fin) OR (heure_fin BETWEEN :debut AND :fin) OR
		(:debut BETWEEN heure_debut AND heure_fin) OR (:fin BETWEEN heure_debut AND heure_fin))
		AND NOT (heure_debut < :debut AND heure_fin = :debut)
		AND NOT (heure_debut = :fin AND heure_fin > :fin)');

	$req->bindValue(':cinema', $cinema, PDO::PARAM_STR);
	$req->bindValue(':salle', $room, PDO::PARAM_STR);
	$req->bindValue(':date', $date, PDO::PARAM_STR);
	$req->bindValue(':debut', $beginTime, PDO::PARAM_STR);
	$req->bindValue(':fin', $endTime, PDO::PARAM_STR);
	$req->execute();

	$overlapping_sessions_nb = $req->fetch();
	$overlapping_sessions_nb = $overlapping_sessions_nb['OverlappingSessionsNb'];

	if ($overlapping_sessions_nb != 0)
	{
		echo ERROR_OVERLAPPING;
		exit;
	}

	$req->closeCursor();

	/*	If there is no already existing movie session in the DB whose time slot
		overlaps that of the one we want to insert then we proceed to the insertion
		of the later and we update the number of copies of the movie in the overall stock */

	$req = $db->prepare('INSERT INTO projections (id_film, date, heure_debut,
		heure_fin, id_cinema, id_salle, tarif, nb_reservations)
		VALUES ((SELECT id FROM films WHERE titre = :film, :date), :debut, :fin,
		(SELECT id FROM cinemas WHERE nom_cinema = :cinema),
		(SELECT id FROM salles INNER JOIN cinemas
		ON salles.id_cinema = cinemas.id
		WHERE nom_salle = :salle AND nom_cinema = :cinema), 8, 0)');

	$req->bindValue(':cinema', $cinema, PDO::PARAM_STR);
	$req->bindValue(':salle', $room, PDO::PARAM_STR);
	$req->bindValue(':date', $date, PDO::PARAM_INT);
	$req->bindValue(':debut', $beginTime, PDO::PARAM_STR);
	$req->bindValue(':fin', $endTime, PDO::PARAM_STR);
	$req->bindValue(':film', $movie, PDO::PARAM_STR);
	$req->execute();
	echo SUCCESS;
?>
