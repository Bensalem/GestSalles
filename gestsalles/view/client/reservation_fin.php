<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<title>Récapitulatif</title>
	<link rel="stylesheet" media="screen" type="text/css"
			title="style" href="../../view/client/reservation.css" />
</head>
<body>
	<?php include("../../view/header.php"); ?>

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
			<td><?php echo substr($beginHour, 0, 5) ?></td>
		</tr>
		<tr>
			<th>Titre du film</th>
			<td><?php echo $movieTitle ?></td>
		<tr>
			<th>Durée</th>
			<td><?php echo $duration ?> mins</td>
		</tr>
		<tr>
			<th>Montant payé</th>
			<td><?php echo $price ?> €</td>
		</tr>
	</table>
	</p>

	<center>
		<input type ="button" name="imprimer" value = "Imprimer" onClick = "window.print();">
	</center>

	<?php include("footer.php"); ?>
</body>
</html>