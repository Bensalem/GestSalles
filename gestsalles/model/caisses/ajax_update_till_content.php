<?php
	include('../db_connexion.php');

	$id_caisse = $_GET['id_caisse'];
	$new_content = $_GET['new_content'];
		
	$req = $db->prepare('UPDATE caisses SET contenu = :new_content
				WHERE id = :id_caisse');
	$req->bindValue(':id_caisse', $id_caisse, PDO::PARAM_INT);
	$req->bindValue(':new_content', $new_content, PDO::PARAM_INT);
	$req->execute();
	echo $new_content;
?>