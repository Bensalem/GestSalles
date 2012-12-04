<?php
	include('../db_connexion.php');

	$cinema = $_GET['cinema'];

	$query = "SELECT * FROM films";

	$movies = $db->query($query);

	while ($movie = $movies->fetch())
	{
		echo "<option value=\"".$movie['titre']."\">".$movie['titre']."</option><br />";
	}

	$movies->closeCursor();
?>

