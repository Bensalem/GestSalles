<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>GestSalles :  Film</title>
	    <link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" />
    </head>
    <body>
		
     	<?php include("entete.php"); ?>
     	<div id="content" >
		
		
		<p><center>	Récapitulatif de réservation: </center>
		
		</br>
		<center>	<table> 
						<tr>
						<td>Titre du film</td>
						<td>Duree</td>
						<td>Date et heure</td>
						<td>Montant paye</td></tr>
				<?php
				
						include ("connection.php");
						$id_film = $_POST['id_film'];
						$duree = $_POST['duree'];
						$horaire= $_POST['horaire'];
						
						
						$req = $bdd->
						prepare('select *  from  film, seance where film.id_film = :id_film and seance.id_film = :id_film 
						and film.duree = :duree and seance.horaire = :horaire');
						$req->execute(array(
								'id_film' => $id_film,
								'duree' => $duree,
								'horaire' => $horaire,
								
								));
								
						/*<!-- $req1 = $bdd->
						//prepare('update seance set nb_reserv = :nb_reserv - 1');
						$req1->execute(array(
								'nb_reserv' => $donnee['nb_reserv'],	
								));-->*/
								
								
						while($donnee = $req->fetch())
						{	
				?>
						<tr>
						<td><?php echo $donnee['titre'];?></td>
						<td><?php echo $donnee['duree'];?></td>
						<td><?php echo $donnee['horaire'];?></td>
						<td>le montant paye 7 Euro</td></tr>
						<?php
						}
						$req->closeCursor();
						?>
				
				
				</table>	</center>	
			</p>
		
						
			<center><input type ="button" name="imprimer" value = "imprimer" onClick = "window.print();"></center>
						
		
		</div>
		<?php include("bottom.php"); ?>
		<!-- </br><a href="index.php">Retour</a> -->

        </body>
</html>


