<?php
function get_cinemas()
{
	global $db;

	$req = $db->query('SELECT nom FROM cinemas');

	$cinemas = $req->fetchAll();
	$req->closeCursor();
	return $cinemas;
}
?>

