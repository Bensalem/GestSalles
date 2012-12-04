<?php
session_start();
$access_denied = false;

if (isset($_POST) && !empty($_POST['login']) &&
	!empty($_POST['password'])) {

	include_once('../model/db_connexion.php');
	include_once('../model/login.php');

	$user = get_registered_user($_POST['login'], $_POST['password']);

	$fonction = $user['fonction'];
	$_SESSION['first_name'] = $user['prenom'];
	$_SESSION['last_name'] = $user['nom'];
	$_SESSION['fonction'] = $fonction;
	$_SESSION['id_cinema'] = $user['id_cinema'];
	$_SESSION['id_caisse'] = $user['id_caisse'];

	if ($fonction == "programmateur"){
		header('Location:programmation/planning.php');
	}
	else if ($fonction == "acheteur"){
		header('Location:achats/index.php');
	}
	else if ($fonction == "caissier"){
		header('Location:caisses/index.php');
	}
	else if ($fonction == "gerant"){
		header('Location:gerant/index.php');
	}
	else {
		$access_denied = true;
	}
}

include_once('../view/login.php');
?>