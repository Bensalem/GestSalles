<?php
function get_rooms($cinema)
{
	global $db;

	/* On veut récupérer toutes les salles du cinéma $cinema */
	$req = $db->prepare('SELECT nom_salle FROM salles INNER JOIN cinemas ON salles.id_cinema = cinemas.id_cinema WHERE nom_cinema = :cinema');
	$req->bindParam(':cinema', $cinema, PDO::PARAM_STR);
	$req->execute();

	$rooms = $req->fetchAll();
	return $rooms;
}
?>

