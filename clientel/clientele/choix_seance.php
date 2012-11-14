<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<title>Choix de la séance</title>
	<link rel="stylesheet" media="screen" type="text/css" title="Design" href="reservation.css" />
</head>
<body>
    <?php
		include("header.php");
		$id_cinema = $_GET['id_cinema'];
		$movie = $_GET['movie'];
	?>

	<form name="chosenSession" action="reservation_client1.php" method="post">
		<input type="hidden" name="sessionId" value=""/>
	</form>

	<script>
	function openReservationPage() {
		if (document.chosenSession.sessionId.value != "") {
			document.chosenSession.submit();
		}
	}
	</script>
	
	<div>
		<p>
		<table>
			<tr>
				<td>CHOIX DE LA SÉANCE</td>
				<td><input type="button" id="reserveButton" value="Valider" onclick="openReservationPage()"/></td>
			</tr>
		</table>
		</p>
	</div>

	<script>
	var selectedSessionRow = null;

	function setPostData(tr, sessionId) {
		document.chosenSession.sessionId.value = sessionId;

		for (i = 0; i < 3; i++) {
			tr.children[i].style.backgroundColor = "cyan";
		}
		if (selectedSessionRow != null && selectedSessionRow != tr) {
			for (i = 0; i < 3; i++) {
				selectedSessionRow.children[i].style.backgroundColor = "white";
			}
		}
		selectedSessionRow = tr;
		alert(button.getAttribute('href'));
	}
	</script>

	<div>
		<p>
		<table>
			<tr>
				<th>Heure de début</th>
				<th>Durée</th>
				<th>Tarif</th>
			</tr>
			<?php
				include("connection.php");

				// Gets all the sessions for the chosen movie in the cinema
				$req = $bdd->prepare('SELECT * FROM projections
								INNER JOIN films ON films.id_film = projections.id_film
								WHERE id_cinema = :id_cinema AND titre = :titre');

				$req->execute(array(':id_cinema' => $id_cinema, ':titre' => $movie));

				while($session = $req->fetch())
				{
					echo "<tr onclick=\"setPostData(this, '". $session['id_proj'] ."')\">";
			?>
					<td><?php echo substr($session['heure_debut'], 0, 5) ?></td>
					<td><?php echo $session['duree'] ?> h</td>
					<td><?php echo $session['tarif'] ?> €</td>
					</tr>
			<?php
				}
				$req->closeCursor();
			?>
		</table>
		</p>
	</div>

	<a href="choix_film.php?cinema=<?php echo $id_cinema ?>">Retour à la liste des films</a>

	<?php include("footer.php"); ?>
</body>
</html>
