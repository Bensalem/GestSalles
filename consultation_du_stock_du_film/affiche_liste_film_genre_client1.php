<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>GestSalles :  Film</title>
	    <link rel="stylesheet" media="screen" type="text/css" title="Design" href="style.css" />
    </head>
    <body>
		
     	<?php include("entete.php"); ?>
     	<div id="content" >
		
			<?php 
			$id_cinema = $_POST['id_cinema'];
			$id_genre = $_POST['id_genre'];
			include("liste_genre_client.php"); ?>
			<form action="" method="post">
			<p>
			<center><table>
						<tr>
						<td>Prix du film</td>
						<td>duree</td>
						<td>horaire</td></tr>
				<?php
						$req = $bdd->
						prepare
						('select *  from seance , film  where seance.id_film = film.id_film and seance.id_cinema = :id_cinema and film.id_genre = :id_genre');
						$req->execute(array(
								'id_cinema' => $id_cinema,
								'id_genre' => $id_genre,
								));
						while($donnee = $req->fetch())
						{
				?>
						<tr>
						<td><?php echo $donnee['Prix'];?></td>
						<td><?php echo $donnee['duree'];?></td>
						<td><?php echo $donnee['horaire'];?></td>
						<td><a href="reservation_client1.php?id_film=<?php echo $donnee['id_film'];?>&amp;horaire=<?php echo $donnee['horaire'];?>&amp;duree=<?php echo $donnee['duree'];?>">
						Reserver</a></td>
						<!--<td><a href="commentaire_client1.php?id_film=<?php echo $donnee['id_film'];?>&amp;horaire=<?php echo $donnee['horaire'];?>&amp;duree=<?php echo $donnee['duree'];?>">
						ajouter commentaire</a></td></tr> -->
						<?php
						}
						$req->closeCursor();
						?>
				
				
				</table></center>
			</p>
			</form>
			
       
		</div>
		<?php include("bottom.php"); ?>

        </body>
</html>