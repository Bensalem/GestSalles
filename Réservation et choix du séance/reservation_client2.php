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
		<center>	<table> 
						<tr>
						<td>Titre du film</td>
						<td>Duree</td>
						<td>Date et heure</td>
						<td>Montant a payer</td></tr>

				<?php
						include ("connection.php");
						$id_film = $_POST['id_film'];
						$duree = $_POST['duree'];
						$horaire= $_POST['horaire'];
						$nom = $_POST['nom'];
						$prenom = $_POST['prenom'];
						$mail = $_POST['mail'];
						
						$req1 = $bdd->
						prepare('insert into client values ( :nom, :prenom, :mail, :id_film)');
						$req1->execute(array(
								'nom' => $nom,	
								'prenom' => $prenom,	
								'mail' => $mail,	
								'id_film' => $id_film,								
								));
							
						
						$req = $bdd->
						prepare('select *  from  film, seance where film.id_film = :id_film and seance.id_film = :id_film 
						and film.duree = :duree and seance.horaire = :horaire');
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
						<td><?php echo $donnee['horaire'];?></td>
						
						<td><?php echo $donnee['Prix'];?></td></tr>
						<?php
						}
						$req->closeCursor();
						?>
				
				
				</table></center>		
			</p>
			
			<form action="reservation_client3.php" method="post">
			<center>	<table>
					
						<tr>
						<td> <label for="case1">Master Card</label></td>
						<td><label for="case2">Visa Card</label></td>
						<td><label for="case3">Blue  Card</label></td></tr>
						
						<tr>
						<td> <input type="radio" name="card" id="case1" /></td>
						<td><input type="radio" name="card" id="case2" /></td>
						<td><input type="radio" name="card" id="case3" /></td></tr>
							
							<input type="hidden" name="id_film" value=<?php echo $id_film;?>/>
							<input type="hidden" name="duree" value=<?php echo $duree;?>/>
							
						<tr><td><textarea name="horaire" rows = "1">
								<?php echo $horaire;?>
								</textarea></td></tr>
							
						<tr><td><input type="submit" value="Valider" /></td></tr>
						
						
				
				
				</table></center>		
			
			</form>
	
		</div>
		<?php include("bottom.php"); ?>

        </body>
</html>
