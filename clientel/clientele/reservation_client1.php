<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<title>GestSalles :  Film</title>
	<link rel="stylesheet" media="screen" type="text/css" title="Design" href="reservation.css"/>
</head>
<body>
     	<?php include("header.php"); ?>

     	<div>
			<p>
			<table id="recapitulatif">
				<caption style='font-weight:bold; font-size: 18px; padding-bottom: 10px'>Récapitulatif</caption> 
			<?php
				include("connection.php");
				$id_session = $_POST['sessionId'];

				$req = $bdd->prepare('SELECT nom_cinema, date, heure_debut, duree, films.id_film, titre, tarif FROM projections
								INNER JOIN films ON projections.id_film = films.id_film
								INNER JOIN cinemas ON projections.id_cinema = cinemas.id_cinema
								WHERE projections.id_proj = :id_projection');
				$req->execute(array('id_projection' => $id_session));
				$session = $req->fetch();
			?>
				<tr>
					<th>Date</th>
					<td><?php echo $session['date'] ?></td>
				<tr>
					<th>Cinéma</th>
					<td><?php echo $session['nom_cinema'] ?></td>
				<tr>
					<th>Heure de début</th>
					<td><?php echo substr($session['heure_debut'], 0, 5) ?></td>
				</tr>
				<tr>
					<th>Titre du film</th>
					<td><?php echo $session['titre'] ?></td>
				<tr>
					<th>Durée</th>
					<td><?php echo $session['duree'] ?> h</td>
				</tr>
			<?php
				$req->closeCursor();
			?>
			</table>
			</p>

			<form action="reservation_client2.php" method="post">
			<table>
				<caption style='font-weight:bold; font-size: 17px; padding-bottom: 10px'>Veuillez remplir le formulaire de réservation :</caption> 
				<tr>
					<td>Prénom :</td>
					<td><input type="text" name="prenom"/></td>
				</tr>
				<tr>
					<td>Nom :</td>
					<td><input type="text" name="nom"/></td>
				</tr>
				<tr>
					<td>Email :</td>
					<td><input type="text" name="email"/></td>
				</tr>

				<input type="hidden" name="id_session" value="<?php echo $id_session ?>"/>
				<input type="hidden" name="cinema" value="<?php echo $session['nom_cinema'] ?>"/>
				<input type="hidden" name="date" value="<?php echo $session['date'] ?>"/>
				<input type="hidden" name="id_film" value="<?php echo $session['id_film'] ?>"/>
				<input type="hidden" name="titre" value="<?php echo $session['titre'] ?>"/>
				<input type="hidden" name="heure_debut" value="<?php echo $session['heure_debut'] ?>"/>
				<input type="hidden" name="duree" value="<?php echo $session['duree'] ?>"/>
				<input type="hidden" name="tarif" value="<?php echo $session['tarif'] ?>"/>

				<!--
				<tr>
					<td>Date et Heure :</td>
					<td><textarea name="horaire" rows = "1">
						<?php //echo $session['heure_debut'] ?>
						</textarea></td>
				</tr>
				-->
				<tr>
					<td colspan="2">
						<!--<input type="submit" value="Revenir à la page précédente" />-->
						<input type="button" value="Annuler"/>
						<input type="submit" value="Procéder au paiement en ligne"/>
					</td>
				</tr>
			</table>
			</form>
	</div>
		
	<?php include("footer.php"); ?>
</body>
</html>
