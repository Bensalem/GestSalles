<!DOCTYPE html>
<html>
    <head>
        <title>Stock des films</title>
	<link rel="stylesheet" media="screen" type="text/css"
			title="style" href="../../view/client/reservation.css" />
	<script src="../../controller/achats/achats.js"></script>
</head>
<body>
	<?php include("../../view/header.php"); ?>

		<br>
		<div id="content" >
		<p>
		<table>
			<caption>Stock des films</caption>
			<tr>
				<th>Titre</th>
				<th>Genre</th>
				<th>Durée</th>
				<th>Date de sortie</th>
				<th>Copies en réserve</th>
			</tr>
				<?php
					foreach($movies as $movie)
					{
				?>
				<tr>
					<td>
					<?php
						echo "<a class='movieDescPopupLink' onclick='openpop(\"" .
							$movie['titre'] . "\"," . $movie['duree'] . ",\"" .
							$movie['sortie'] . "\", \"" . $movie['description'] .
							"\");'>" . $movie['titre'] . "</a>";
					?>
					</td>
					<td><?php echo $movie['genre'] ?></td>
					<td><?php echo $movie['duree'] ?></td>
					<td><?php echo $movie['sortie'] ?></td>
					<td><?php echo $movie['nb_copies_en_reserve'] ?></td>
				</tr>
				<?php
					}
				?>
			</table>
			</p>
		<center>
			<input type="button" value="Ajoutez un nouveau film"
					onclick="document.location.href='../../view/achats/ajout_film.php'" />
		</center>
		</div>
	</body>
</html>