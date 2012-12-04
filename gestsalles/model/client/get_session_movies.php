<?php

// Get all the movies that have sessions planned for them in the cinema
function get_session_movies($id_cinema)
{
	global $db;

	$req = $db->prepare('SELECT * FROM films
			INNER JOIN projections ON projections.id_film = films.id
			WHERE projections.id_cinema = :id_cinema GROUP BY films.id');
	$req->execute(array(
			'id_cinema' => $id_cinema,
		));

	$movies = $req->fetchAll();
	$req->closeCursor();
	return $movies;
}
?>

