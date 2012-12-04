<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<title>Choix du film</title>
	<link rel="stylesheet" media="screen" type="text/css"
			title="style" href="../../view/client/reservation.css" />
	<script src="../../controller/choix_film.js"></script>
</head>
<body>
	<?php include("../../view/header.php"); ?>

	<form name="movieForm"
			action="../../controller/client/choix_seance.php" method="post">
		<p><br>
		<center>
		<table>
			<tr>
				<th>Titre du film</th>
				<th>Durée</th>
				<th></th>
			</tr>

			<?php
				foreach($movies as $movie)
				{
			?>

			<tr>
				<td>
					<input type="radio" name="id_movie" value="<?php echo $movie['id'] ?>">
					<?php
						echo "<a class='movieDescPopupLink' onclick='openpop('" .
							$movie['titre'] . "'," . $movie['duree'] . "," .
							$movie['sortie'] . ", '" . $movie['description'] .
							"');\'>" . $movie['titre'] . "</a>"
					?>
				</td>
				<td><?php echo $movie['duree'] ?> mins</td>

				<!-- Ajout des commentaires -->
				<td><?php echo "<a href='ajout_commentaire.php?id_film=" .
							$movie['id'] . "&amp;titre=" . $movie['titre'] .
							"&amp;edition=" . $movie['sortie'] .
							"&amp;duree=" . $movie['duree'] .
							"'>Ajouter un commentaire</a></td>"; ?>
			</tr>
			<?php
				} // End of foreach
			?>
		</table>
		</center>
		</p>
		<input type="hidden" name="id_cinema" value="<?php echo $id_cinema ?>">
		<input type="hidden" name="cinemaName" value="<?php echo $cinema_name ?>">
	</form>

	<br>
	<span class="gauche">
		<a href="choix_cinema.php">Retour à la liste des cinémas</a>
	</span>
	<br>
	<br>
	<span class="droite">
		<button onclick="movieForm.submit()">Choisir une séance</button>
	</span>

	<?php include("footer.php"); ?>
</body>
</html>