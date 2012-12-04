<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<title>GestSalles :  Film</title>
	<link rel="stylesheet" media="screen" type="text/css"
			title="style" href="../../view/client/reservation.css" />
</head>
<body>
	<?php
		include("../../view/header.php");

		$cinema = $_POST['id_cinema'];
		$id_session = $_POST['sessionId'];
		$date = $_POST['date'];
		$movie = $_POST['movieTitle'];
		$beginHour = $_POST['beginHour'];
		$duration = $_POST['duration'];
		$price = $_POST['price'];
	?>

	<div>
		<p>
		<table id="recapitulatif">
			<caption style='font-weight:bold; font-size: 18px; padding-bottom: 10px'>R�capitulatif</caption> 
			<tr>
				<th>Date</th>
				<td><?php echo $date ?></td>
			<tr>
				<th>Cin�ma</th>
				<td><?php echo $cinema ?></td>
			<tr>
				<th>Heure de d�but</th>
				<td><?php echo substr($beginHour, 0, 5) ?></td>
			</tr>
			<tr>
				<th>Titre du film</th>
				<td><?php echo $movie ?></td>
			</tr>
			<tr>
				<th>Dur�e</th>
				<td><?php echo $duration ?> mins</td>
			</tr>
		</table>
		</p>

		<form action="../../view/client/reservation_etape2.php" method="post">
			<table>
				<caption style='font-weight:bold; font-size: 17px; padding-bottom: 10px'>Veuillez remplir le formulaire de r�servation :</caption> 
				<tr>
					<td>Pr�nom :</td>
					<td><input name="firstName" type="text"/></td>
				</tr>
				<tr>
					<td>Nom :</td>
					<td><input name="lastName" type="text"/></td>
				</tr>
				<tr>
					<td>Email :</td>
					<td><input name="email" type="text"/></td>
				</tr>

				<input type="hidden" name="id_session" value="<?php echo $id_session ?>"/>
				<input type="hidden" name="cinemaName" value="<?php echo $cinema ?>"/>
				<input type="hidden" name="date" value="<?php echo $date ?>"/>
				<input type="hidden" name="movieTitle" value="<?php echo $movie ?>"/>
				<input type="hidden" name="beginHour" value="<?php echo $beginHour ?>"/>
				<input type="hidden" name="duration" value="<?php echo $duration ?>"/>
				<input type="hidden" name="price" value="<?php echo $price ?>"/>

				<tr>
					<td colspan="2">
						<!--<input type="submit" value="Revenir � la page pr�c�dente" />-->
						<input type="button" value="Annuler"/>
						<input type="submit" value="Proc�der au paiement en ligne"/>
					</td>
				</tr>
			</table>
		</form>
	</div>
		
	<?php include("footer.php"); ?>
</body>
</html>
