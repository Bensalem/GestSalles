<?php
function get_rooms($cinema)
{
	global $db;

	/* On veut récupérer toutes les salles du cinéma $cinema */
	$req = $db->prepare('SELECT salle FROM salles WHERE cinema = :cinema');
	$req->bindParam(':cinema', $cinema, PDO::PARAM_STR);
	$req->execute();

	$rooms = $req->fetchAll();
	return $rooms;
}
?>

