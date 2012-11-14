<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<title>Réservation</title>
	<link rel="stylesheet" media="screen" type="text/css" title="Design" href="reservation.css" />
</head>
<body>
     <?php include("header.php"); ?>

	<?php
		include ("connection.php");
		$id_session = $_POST['id_session'];
		$date = $_POST['date'];
		$cinema = $_POST['cinema'];
		$id_film = $_POST['id_film'];
		$titre = $_POST['titre'];
		$duree = $_POST['duree'];
		$heure_debut = $_POST['heure_debut'];
		$tarif = $_POST['tarif'];
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$email = $_POST['email'];

		function saveReservationInDB() {
			$req = $bdd->prepare('INSERT INTO reservations VALUES (null, :nom, :prenom, :email, :id_session)');
			$req->execute(array(
					'nom' => $nom,
					'prenom' => $prenom,
					'email' => $email,
					'id_session' => $id_session
					));
			$req->closeCursor();
		}
	?>

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
		</table>
		</p>
		
	<form action="reservation_client3.php" method="post">
	<table>
		<caption style='font-weight:bold; font-size: 17px; padding-bottom: 10px'>Choissisez le mode de paiement :</caption> 
		<tr>
		<td>
		<p><input type="radio" name="card" id="case1"/>
		<label for="case1">Master Card</label></p>

		<p><input type="radio" name="card" id="case2"/>
		<label for="case2">Visa Card</label></p>

		<p><input type="radio" name="card" id="case3"/>
		<label for="case3">Blue  Card</label></p>
		</td>
		</tr>

		<input type="hidden" name="cinema" value="<?php echo $cinema ?>"/>
		<input type="hidden" name="date" value="<?php echo $date ?>"/>
		<input type="hidden" name="titre" value="<?php echo $titre ?>"/>
		<input type="hidden" name="heure_debut" value="<?php echo $heure_debut ?>"/>
		<input type="hidden" name="duree" value="<?php echo $duree ?>"/>
		<input type="hidden" name="tarif" value="<?php echo $tarif ?>"/>

		<tr>
			<td><textarea name="horaire" rows = "1">Entrez le code de votre carte</textarea></td>
		</tr>

		<tr><td><input type="submit" value="Valider" onclick="saveReservationInDB()"/></td></tr>
	</table>
	</form>
	</div>
	<br>

	<?php include("footer.php"); ?>
</body>
</html>
