<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
<script>
function centre() {
	largeur = screen.availWidth - 400;
	hauteur = screen.availHeight - 200;
	pointx = largeur / 2;
	pointy = hauteur / 2;
	window.moveTo(pointx, pointy);
}
</script>
	<title>Choix du film</title>
	<link rel="stylesheet" media="screen" type="text/css" title="Design" href="reservation.css" />
</head>
<body>
	<?php include("header.php"); ?>
	<form action="formulaireCible.php" method="post">
	<p><center>
	<table>
		<tr>
		<td>Titre du film</td>
		<td>Durée</td></tr>
		<?php
			include ("connection.php");
			$id_cinema = $_GET['id_cinema'];

			// Gets all the movies that have sessions planned for them in the cinema
			$req = $bdd->prepare('SELECT * FROM films
							INNER JOIN projections ON films.id_film = projections.id_film
							WHERE projections.id_cinema = :id_cinema GROUP BY films.id_film');
			$req->execute(array(
					'id_cinema' => $id_cinema,

					));
			while($movie = $req->fetch())
			{
		?>

<script> 
function openpop() { 
	win = window.open("", "newwin", "height=350, width=350, top=200 ,left=500"); 
	win.document.write("<html><head><title>Meet Our Staff</title></head>"); 
	win.document.write("<body><table><tr> Titre : <?php echo $movie['titre'] ?> <br>Durée : <?php echo $movie['duree'] ?> <br> Date de sortie : <?php echo $movie['edition'] ?><p>Synopsis : <?php echo $movie['description'] ?></p></tr></table></body>"); 
	win.document.close();
	self.name = "main"; 
}

function appendMovieToHref(movie) {
	link = document.getElementById('sessionChoiceLink');
	url = link.getAttribute('href');
	link.setAttribute('href', url + "&movie=" + movie);
}
</script>
		<tr>
			<td>
				<input type="radio" name="movie" value="" onclick="appendMovieToHref('<?php echo $movie['titre'] ?>')">
				<a href="#" onclick="openpop();"><?php echo $movie['titre'] ?></a>
			</td>
			<td><?php echo $movie['duree'] ?> h</td>
		</tr>
		<?php
			}
			$req->closeCursor();
		?>
	</table>
	</center></p>
	</form>

	<br>
	<span class="gauche">
		<a href="choix_cinema.php">Retour à la liste des cinémas</a>
	</span>
	<br>
	<br>
	<span class="droite">
		<a id="sessionChoiceLink" href="choix_seance.php?id_cinema=<?php echo $id_cinema ?>">Choisir une séance</a>
	</span>
	</div>	
	</div>
	<?php include("footer.php"); ?>
</body>
</html>
