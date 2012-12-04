<!DOCTYPE html>
<html>
<head>
	<title>GestSalles : Séances</title>
	<link rel="stylesheet" media="screen" type="text/css"
			title="style" href="../../view/caisses/caisses.css" />
	<script src="caisses.js"></script>
</head>
<body>
	<?php include("../../view/header.php"); ?>

	<div id="monnaie">
	<center>
		<p><?php echo $_SESSION['monnaie']; ?> euros en caisse</p>
	</center>
	</div>

	<div id="Onglets">
	<center>
		<a href="viewprog.php">Programme de la semaine</a>
	</center>
	</div>

	<div id="affichage_films">	
		<center><p>Séances des 4 prochaines heures :</p></center>
		<table>
		<tr>
			<th>Horaire</th>
			<th>Film</th>
			<th>Salle</th>
			<th>Places restantes</th>
			<th>Tarif</th>
		</tr>
		<?php
			foreach($sessions as $session)
			{
				$places_restantes = $session['nb_places'] - $session['nb_reservations'];
				echo '<tr>';
				echo '<td>' . $session['heure_debut'] . " - " .	$session['heure_fin'] . '</td>';
				echo '<td><a class="fakeLink" onclick=\'submitToChoixPaiementForm(' .
						$session['id_seance'] . ',"' . $session['titre'] . '","' .
						$session['sortie'] . '","' . $session['heure_debut'] . '",'
						. $session['duree'] . ',"' . $session['nom_salle'] . '",' .
						$session['tarif'] . ')\'>' . $session['titre'] . '</a></td>';
				echo '<td>' . $session['nom_salle'] . '</td>';
				echo '<td>' . $places_restantes . '</td>';
				echo '<td>' . $session['tarif'] . ' €</td>';
				echo '</tr>';
			}
		?>
		</table>
	</div>

	<form name="toChoixPaiementForm"
			action="../../controller/caisses/choix_paiement.php" method="post">
		<input type="hidden" name="sessionId" value=""/>
		<input type="hidden" name="movieTitle" value=""/>
		<input type="hidden" name="edition" value=""/>
		<input type="hidden" name="beginHour" value=""/>
		<input type="hidden" name="duration" value=""/>
		<input type="hidden" name="room" value=""/>
		<input type="hidden" name="price" value=""/>
	</form>
</body>
</html>