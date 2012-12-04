<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<title>Choix de la séance</title>
	<link rel="stylesheet" media="screen" type="text/css"
			title="style" href="../../view/client/reservation.css" />
	<script src="../../controller/client/choix_seance.js"></script>
</head>
<body>
	<?php include("../../view/header.php"); ?>

	<div>
		<p>
		<table>
			<tr>
				<td>Choix de la séance</td>
				<td><input type="button" id="reserveButton" value="Valider" onclick="openReservationPage()"/></td>
			</tr>
		</table>
		</p>
	</div>

	<div>
		<p>
		<table>
			<tr>
				<th>Heure de début</th>
				<th>Heure de fin</th>
				<th>Tarif</th>
			</tr>
			<?php
			foreach($sessions as $session)
			{
				echo "<tr onclick=\"setPostData(this, " . $session['id_projection'] .
					", '" .	$session['titre'] . "'," . $session['duree'] .
					",'" . $session['heure_debut'] . "','" . $session['date'] .
					"'," . $session['tarif'] . ")\">";
				// We don't print the minutes
				echo "<td>" . substr($session['heure_debut'], 0, 5) . "</td>";
				echo "<td>" . substr($session['heure_fin'], 0, 5) . "</td>";
				echo "<td>" . $session['tarif'] . " €</td>";
				echo "</tr>";
			}
			?>
		</table>
		</p>
	</div>

	<form name="toNextPageForm"
			action="../../view/client/reservation_etape1.php" method="post">
		<input type="hidden" name="id_cinema" value="<?php echo $id_cinema ?>">
		<input type="hidden" name="cinemaName" value="<?php echo $cinema_name ?>">
		<input type="hidden" name="sessionId" value=""/>
		<input type="hidden" name="date" value=""/>
		<input type="hidden" name="movieTitle" value=""/>
		<input type="hidden" name="beginHour" value=""/>
		<input type="hidden" name="duration" value=""/>
		<input type="hidden" name="price" value=""/>
	</form>

	<form name="toPrevPageForm" action="choix_film.php" method="post">
		<input type="hidden" name="id_cinema" value="<?php echo $id_cinema ?>">
	</form>

	<button onclick="toPrevPageForm.submit()">Retour à la liste des films</button>

	<?php include("footer.php"); ?>
</body>
</html>