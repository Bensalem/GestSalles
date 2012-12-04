<?php
	include('../db_connexion.php');

	$cinema = $_GET['cinema'];
	$date = $_GET['date'];

	$req = $db->prepare('SELECT num_salle, nom_salle, titre, heure_debut, heure_fin
		FROM projections INNER JOIN salles ON projections.id_salle = salles.id
		INNER JOIN cinemas ON projections.id_cinema = cinemas.id
		INNER JOIN films ON projections.id_film = films.id
		WHERE nom_cinema = :cinema AND date = :date');

	$req->bindValue(':cinema', $cinema, PDO::PARAM_STR);
	$req->bindValue(':date', $date, PDO::PARAM_STR);

	$req->bindValue(':date', $date, PDO::PARAM_STR);
	$req->execute();

	$sessions_json = '[';

	while ($session = $req->fetch())
	{
		$beginHour = substr($session['heure_debut'], 0, 2);
		$beginMin = substr($session['heure_debut'], 3, 2);
		$endHour = substr($session['heure_fin'], 0, 2);
		$endMin = substr($session['heure_fin'], 3, 2);
		$sessions_json .= '{"roomNum":"'.$session['num_salle'].'", "roomName":"'.
				$session['nom_salle'].'", "movie":"'.$session['titre'].'", "beginHour":"'.
				$beginHour.'", "endHour":"'.$endHour.'", "beginMin":"'.$beginMin.'", "endMin":"'.$endMin.'"},';
	}
	$sessions_json = rtrim($sessions_json, ',');
	$sessions_json .= ']';

	echo $sessions_json;
	$req->closeCursor();
?>