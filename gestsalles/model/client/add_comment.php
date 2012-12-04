<?php
function save_comment_in_db($pseudo, $email, $comment, $id_film)
{
	global $db;

	$req = $db->prepare('INSERT INTO commentaires
			VALUES (null, :pseudo, :email, :comment, :id_film)');
	$req->execute(array(
			'pseudo' => $pseudo,
			'email' => $email,
			'comment' => $comment,
			'id_film' => $id_film
		));
	$req->closeCursor();
}
?>