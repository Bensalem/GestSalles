<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>Choix du cinéma</title>
	    <link rel="stylesheet" media="screen" type="text/css" title="style" href="reservation.css" /> 
    </head>
    <body>
     	<?php
			include("header.php");
		?>

		<div>
			<p>
			<form action="choix_film.php" method="get">
			<table>
				<tr>
					<td width="33%">
						<select name="id_cinema" />
						<?php
							include ("connection.php");
							$cinemas = $bdd->query('SELECT * from cinemas WHERE cinemas.id_cinema IN (SELECT id_cinema FROM projections)');
							while($cinema = $cinemas->fetch())
							{
						?>
								<option value="<?php echo $cinema['id_cinema'] ?>">
									<?php echo $cinema['nom_cinema'] ?>
								</option>
						<?php
							}
							$cinemas->closeCursor();
						?>
						</select>	
					</td>
					<center>
					<td>
						<input type="submit" value="Valider" />
					</td>
					</center>
				</tr>
			</table>
			</form>
			</p>
		</div>

		<div id="content" >
		<p>
		<table>
			<tr>
				<td>Cinéma</td>
				<td>Rue</td>
				<td>Ville</td>
			</tr>
				<?php
					include ("connection.php");
					$req = $bdd->prepare('SELECT * FROM adresses INNER JOIN cinemas ON adresses.id_cinema = cinemas.id_cinema');
					$req->execute(array(
							//'id_adr' => $id_adr,
							));
					while($adress = $req->fetch())
					{
				?>
					<tr>
						<td><?php echo $adress['nom_cinema'] ?></td>
						<td><?php echo $adress['rue'] ?></td>
						<td><?php echo $adress['ville'] ?></td>
					</tr>
				<?php
					}
					$req->closeCursor();
				?>
			</table>
			</p>
		</div>
		<?php include("footer.php"); ?>
	</body>
</html>
