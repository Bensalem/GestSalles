<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<title>Récapitulatif</title>
	<link rel="stylesheet" media="screen" type="text/css" title="style" href="reservation.css" />
</head>
<body>

	<?php
		include("header.php");

		$date = $_POST['date'];
		$cinema = $_POST['cinema'];
		$titre = $_POST['titre'];
		$duree = $_POST['duree'];
		$heure_debut = $_POST['heure_debut'];
		$tarif = $_POST['tarif'];
	?>
	<div>
	<p>
	<table id="recapitulatif">
		<caption style='font-weight:bold; font-size: 18px; padding-bottom: 10px'>Récapitulatif</caption> 
		<tr>
			<th>Date</th>
			<td><?php echo $date ?></td>
		<tr>
			<th>Cinéma</th>
			<td><?php echo $cinema ?></td>
		<tr>
			<th>Heure de début</th>
			<td><?php echo substr($heure_debut, 0, 5) ?></td>
		</tr>
		<tr>
			<th>Titre du film</th>
			<td><?php echo $titre ?></td>
		<tr>
			<th>Durée</th>
			<td><?php echo $duree ?> h</td>
		</tr>
		<tr>
			<th>Montant payé</th>
			<td><?php echo $tarif ?> €</td>
		</tr>
	</table>
	</p>

	<center><input type ="button" name="imprimer" value = "imprimer" onClick = "window.print();"></center>

	</div>
	<?php include("footer.php"); ?>
	<!-- </br><a href="index.php">Retour</a> -->
</body>
</html>


