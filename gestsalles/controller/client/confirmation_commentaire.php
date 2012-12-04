<?php
	include_once('../../model/db_connexion.php');
	include_once('../../model/client/add_comment.php');

	$pseudo = $_POST['pseudo'];
	$email = $_POST['email'];
	$comment = $_POST['comment'];
	$id_film = $_POST['id_film'];

	save_comment_in_db($pseudo, $email, $comment, $id_film);
	include_once('../../view/client/confirmation_commentaire.php');
?>