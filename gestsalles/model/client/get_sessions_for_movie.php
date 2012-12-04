<?php

// Get all the sessions for the chosen movie in the cinema
function get_sessions_for_movie($id_cinema, $id_movie)
{
	global $db;

	$req = $db->prepare('SELECT projections.id AS id_projection,
				date, titre, duree, heure_debut, heure_fin, tarif
				FROM projections JOIN films ON films.id = projections.id_film
				WHERE id_cinema = :id_cinema AND id_film = :id_film');

	$req->execute(array(
			':id_cinema' => $id_cinema,
			':id_film' => $id_movie
		));

	$sessions = $req->fetchAll();
	$req->closeCursor();
	return $sessions;
}
?>