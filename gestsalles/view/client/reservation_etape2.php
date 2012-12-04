<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<title>Réservation</title>
	<link rel="stylesheet" media="screen" type="text/css"
			title="style" href="../../view/client/reservation.css" />
</head>
<body>
	<?php
		include("../../view/header.php");

		$id_session = $_POST['id_session'];
		$date = $_POST['date'];
		$cinema = $_POST['cinemaName'];
		$movieTitle = $_POST['movieTitle'];
		$duration = $_POST['duration'];
		$beginHour = $_POST['beginHour'];
		$price = $_POST['price'];
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$email = $_POST['email'];
	?>

	<p>
	<table id="recapitulatif">
		<caption id="recap_caption">Récapitulatif</caption> 
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
	</table>
	</p>

	<form action="../../controller/client/reservation_fin.php" method="post">
		<table>
			<caption id="caption">Choissisez votre mode de paiement :</caption> 
			<tr>
			<td>
			<p><input type="radio" name="card" id="master_card"/>
			<label for="case1">MasterCard</label></p>

			<p><input type="radio" name="card" id="visa"/>
			<label for="case2">Visa Card</label></p>

			<p><input type="radio" name="card" id="blue_card"/>
			<label for="case3">Blue Card</label></p>
			</td>
			</tr>

			<input type="hidden" name="id_session" value="<?php echo $id_session ?>"/>
			<input type="hidden" name="cinemaName" value="<?php echo $cinema ?>"/>
			<input type="hidden" name="date" value="<?php echo $date ?>"/>
			<input type="hidden" name="movieTitle" value="<?php echo $movieTitle ?>"/>
			<input type="hidden" name="beginHour" value="<?php echo $beginHour ?>"/>
			<input type="hidden" name="duration" value="<?php echo $duration ?>"/>
			<input type="hidden" name="price" value="<?php echo $price ?>"/>
			<input type="hidden" name="firstName" value="<?php echo $firstName ?>"/>
			<input type="hidden" name="lastName" value="<?php echo $lastName ?>"/>
			<input type="hidden" name="email" value="<?php echo $email ?>"/>

			<tr>
				<td><textarea name="cardCode" rows = "1">Entrez le code de votre carte</textarea></td>
			</tr>

			<tr><td><input type="submit" value="Valider"/></td></tr>
		</table>
	</form>
	</div>
	<br>
	<?php include("footer.php"); ?>
</body>
</html>
