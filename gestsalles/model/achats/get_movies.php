<?php
function get_movies()
{
	global $db;

	$req = $db->prepare('SELECT * FROM films');
	$req->execute();
	$sessions = $req->fetchAll();
	$req->closeCursor();
	return $sessions;
}
?>