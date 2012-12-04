<!DOCTYPE html>
<html>
<head>
	<title>GestSalles : Caisses</title>
	<link rel="stylesheet" media="screen" type="text/css"
			title="style" href="../../view/caisses/caisses.css" />
	<script src="caisses.js"></script>
</head>
<body>
	<?php include("../../view/header.php"); ?>

	<div id="content">
	<center>
	<?php
		echo '<h2>'. $movieTitle .'</h2>';
		echo '<p>Durée : '. $duration .' mins <p>';
		echo '<p>Sorti le : '. $edition .'<p>';
		echo '<p>Heure du début : '. $beginHour .'<p>';
	?>

	<form name="toPaiementForm" method="post" action="">
		<p>
			<label>Tarif :</label>

			<input type="radio" name="tarif" value="enfant"/>
			<label for="Enfant">Enfant 3 €</label>

			<input type="radio" name="tarif" value="etudiant"/>
			<label for="Etudiant">Etudiant 5 €</label>

			<input type="radio" name="tarif" value="adulte"
					checked="checked"/>
			<label for="Adulte">Adulte 7 €</label>
		</p>
		<p>
			<label>Type de paiement :</label>

			<input type="radio" name="paiement" value="carte"/>
			<label for="Carte">Carte</label>

			<input type="radio" name="paiement" value="especes"	checked="checked"/>
			<label for="Especes">Espèces</label>
		</p>

			<input type="hidden" name="sessionId" value="<?php echo $id_session; ?>"/>
			<input type="hidden" name="movieTitle" value="<?php echo $movieTitle; ?>"/>
			<input type="hidden" name="edition" value="<?php echo $edition; ?>"/>
			<input type="hidden" name="beginHour" value="<?php echo $beginHour; ?>"/>
			<input type="hidden" name="duration" value="<?php echo $duration; ?>"/>
			<input type="hidden" name="room" value="<?php echo $room; ?>"/>
			<input type="hidden" name="price" value="<?php echo $price; ?>"/>
		<p>
			<input type="button" value="Valider" onclick="submitToPaiementForm()" />
		</p>
	</form>
	</center>
	</div>
</body>
</html>