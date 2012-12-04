<?php
function saveReservationInDB($first_name, $last_name, $email, $id_session)
{
	global $db;

	$req = $db->prepare('INSERT INTO reservations
			VALUES (null, :nom, :prenom, :email, :id_session)');
	$req->execute(array(
			'nom' => $last_name,
			'prenom' => $first_name,
			'email' => $email,
			'id_session' => $id_session
		));
	$req->closeCursor();

	$req = $db->prepare("UPDATE projections
			SET nb_reservations = nb_reservations + 1
			WHERE id = :id_session");
	$req->execute(array('id_session' => $id_session));
}
?>