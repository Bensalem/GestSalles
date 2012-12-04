<?php

function get_till_content($id_caisse)
{
	global $db;

	$req = $db->prepare('SELECT contenu FROM caisses WHERE id = :id_caisse');
	$req->execute(array(':id_caisse' => $id_caisse));

	$till = $req->fetch();
	$req->closeCursor();
	return $till;
}
?>