<?php

// Donne les infos des cin�mas o� sont projet�s des films
function get_cinemas_with_sessions()
{
	global $db;

	$req = $db->query('SELECT * from cinemas
			INNER JOIN adresses ON adresses.id = cinemas.id
			WHERE cinemas.id IN (SELECT id_cinema FROM projections)');

	$cinemas = $req->fetchAll();
	$req->closeCursor();
	return $cinemas;
}
?>

