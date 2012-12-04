<!DOCTYPE html>
<html>
<head>
	<title>GestSalles : Caisses</title>
	<link rel="stylesheet" media="screen" type="text/css"
			title="style" href="../../view/caisses/caisses.css" />
	<script src="caisses.js"></script></head>
<body>
	<?php include("../../view/header.php"); ?>

	<center>
	<div id="content">
		<br>
		<p>
		<table>
		<?php
			echo '<tr><th>Film :</th><td>'. $movieTitle .'</td></tr>';
			echo '<tr><th>Prix :</th><td>'. $price .'</td></tr>';
			echo '<tr><th>Salle :</th><td>'. $room .'</td></tr>';
			echo '<tr><th>Date de sortie :</th><td>'. $edition .'</td></tr>';
			echo '<tr><th>Heure du début :</th><td>'. $beginHour .'</td></tr>';
		?>
		</table>
		</p>

		<p>Paiement par carte. Valider une fois la transaction effectuée.</p>

		<form name="returnToEcranPrincipalForm" method="post"
				action="../../controller/caisses/ecran_principal.php">
			<input type="hidden" name="tillContent"
					value="<?php echo $_SESSION['monnaie']; ?>" />
			<p>
			<input type="button" value="Valider"
					onclick='incrReservationNb("<?php echo $sessionId; ?>")' />
			</p>
		</form>
		</div>
	</div>
	<center>
</body>
</html>