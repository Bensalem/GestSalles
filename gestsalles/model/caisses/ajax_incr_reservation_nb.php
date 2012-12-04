<?php
	include('../db_connexion.php');

	$id_seance = $_GET['id_seance'];

	$req = $db->prepare('UPDATE projections
					SET nb_reservations = nb_reservations + 1
					WHERE projections.id = :id_seance');
	$req->execute(array(':id_seance' => $id_seance));
	$req->closeCursor();
?>