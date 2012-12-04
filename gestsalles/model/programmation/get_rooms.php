<?php
function get_rooms($cinema)
{
	global $db;

	$req = $db->prepare('SELECT nom_salle FROM salles INNER JOIN cinemas
				ON salles.id_cinema = cinemas.id WHERE nom_cinema = :cinema');
	$req->bindParam(':cinema', $cinema, PDO::PARAM_STR);
	$req->execute();

	$rooms = $req->fetchAll();
	return $rooms;
}
?>