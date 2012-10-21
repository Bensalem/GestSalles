<?php
function get_cinemas()
{
	global $db;

	$req = $db->query('SELECT nom_cinema FROM cinemas');

	$cinemas = $req->fetchAll();
	$req->closeCursor();
	return $cinemas;
}
?>

