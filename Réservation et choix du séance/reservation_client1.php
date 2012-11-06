<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>GestSalles :  Film</title>
	    <link rel="stylesheet" media="screen" type="text/css" title="Design" href="style.css" />
    </head>
    <body>
		
     	<?php include("entete.php"); ?>
     	<div id="content" >
		
		
			
			<p>
			<center><table>
						<tr>
						<td>Titre du film</td>
						<td>duree</td>
						<td>heure et date </td></tr>
				<?php
						include ("connection.php");
						$id_film = $_GET['id_film'];//il faut intercepter l horaire 
						$duree = $_GET['duree'];
						$horaire = $_GET['horaire'];
						$req = $bdd->
						prepare('select *  from  film, seance where film.id_film = :id_film and seance.id_film = :id_film 
						and film.duree = :duree and seance.horaire = :horaire and seance.horaire = :horaire');
						$req->execute(array(
								'id_film' => $id_film,
								'duree' => $duree,
								'horaire' => $horaire,
								
								));
						while($donnee = $req->fetch())
						{	
				?>
						<tr>
						<td><?php echo $donnee['titre'];?></td>
						<td><?php echo $donnee['duree'];?></td>
						<td><?php echo $donnee['horaire'];?></td></tr>
						<?php
						}
						$req->closeCursor();
						?>
				
				
				</table></center>
			</p>
			<form action="reservation_client2.php" method="post">
			<center>	<table>
					
						<tr>
							<td>Prenom:</td>
							<td><input type="text" name="prenom" /></td></tr>
							
						<tr>
							<td>Nom:</td>
							<td><input type="text" name="nom" /></td></tr>
						
						<tr>
							<td>Mail:</td>
							<td><input type="text" name="mail" /></td></tr>
							
							<input type="hidden" name="id_film" value=<?php echo $id_film;?> />
							<input type="hidden" name="duree" value=<?php echo $duree;?> />
							<tr>
							<td>Date et Heure:</td>
							<td><textarea name="horaire" rows = "1">
								<?php echo $horaire;?>
								</textarea></td></tr>
							
						<tr><td><input type="submit" value="Valider" /></td></tr>
						
						
				
				
				</table>		</center>
			
			</form>
	</div>
		
		<?php include("bottom.php"); ?>

        </body>
</html>
