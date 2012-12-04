<?php
	include_once('../../model/db_connexion.php');
	include_once('../../model/client/add_comment.php');

	$movieTitle = $_GET['titre'];
	$edition = $_GET['edition'];
	$duration = $_GET['duree'];
	$id_film = $_GET['id_film'];

	include_once('../../view/client/ajout_commentaire.php');
?>