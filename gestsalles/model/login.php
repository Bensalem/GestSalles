<?php

function get_registered_user($login, $password)
{
	global $db;

	$req = $db->prepare('SELECT * FROM personnel
				WHERE login = :login AND password = :password');

	$req->execute(array(
			':login' => $login,
			':password' => $password
		));

	$user = $req->fetch();
	$req->closeCursor();
	return $user;
}
?>

