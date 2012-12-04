<?php

function get_next_two_hours_sessions($id_cinema)
{
	global $db;

	$req = $db->prepare('SELECT projections.id AS id_seance, titre,
				nom_salle, heure_debut, heure_fin, tarif, nb_places,
				nb_reservations, duree, sortie FROM projections
				JOIN films ON films.id = projections.id_film
				JOIN salles ON salles.id = projections.id_salle
				WHERE projections.id_cinema = :id_cinema
				AND TIMEDIFF(heure_debut, CURTIME())
				BETWEEN \'00:00:00\' AND \'04:00:00\'
				ORDER BY heure_debut');

	// Si on veut tester sans qu'il y ait de séance
	// dans les 4 heures qui viennent, remplacer CURTIME() et heure_debut
	// par des trucs comme : \'23:00:00\'

	$req->execute(array(':id_cinema' => $id_cinema));

	$sessions = $req->fetchAll();
	$req->closeCursor();
	return $sessions;
}
?>
