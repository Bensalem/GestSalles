<?php
function add_movie($titre, $genre, $duree, $sortie, $acteurs,
			$description, $nb_copies)
{
	global $db;

	$req = $db->prepare('INSERT INTO films VALUES (null, :titre,
			:genre, :duree, :sortie, :acteurs, :description, :nb_copies)');
	$req->execute(array(
			'titre' => $titre,
			'duree' => $duree,
			'genre' => $genre,
			'sortie' => $sortie,
			'acteurs' => $acteurs,
			'description' => $description,
			'nb_copies' => $nb_copies
		));
}
?>