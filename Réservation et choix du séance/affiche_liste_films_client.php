<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
	<script type="text/javascript"> 
	function centre(){
largeur = screen.availWidth - 400; 
hauteur = screen.availHeight - 200; 
pointx = (largeur) / 2; 
pointy = (hauteur) / 2;  
window.moveTo(pointx,pointy); 
}
</Script>
        <title>GestSalles :  Film</title>
	    <link rel="stylesheet" media="screen" type="text/css" title="Design" href="style.css" />
    </head>
    <body>
		
     	<?php include("entete.php"); ?>
					
              
     	
			
				<?php 
					include("liste_cinema_client.php");
				?>
			<form action="formulaireCible.php" method="post">
			<p>
			<center><table>
						<tr>
						<td>Titre du film</td>
						<td>duree</td></tr>
				<?php
						include ("connection.php");
						$id_cinema = $_POST['id_cinema'];
						
					
						$req = $bdd->prepare('select *  from film where film.id_cinema = :id_cinema');
						$req->execute(array(
								'id_cinema' => $id_cinema,
							
								
								));
						while($donnee = $req->fetch())
						{
				?>
				<script type="text/javascript"> 
function openpop() { 
OpenWindow=window.open("", "newwin", "height=350, width=350, top=200 ,left=500"); 
OpenWindow.document.write("<html><head><title>Meet Our Staff</title></head>"); 
OpenWindow.document.write("<BODY ><table><tr> titre: <?php echo $donnee['titre'];?> <br> synopsis: <?php echo $donnee['Description'];?> <br> durée :<?php echo $donnee['duree'];?> <br> Date de sortie: <?php echo $donnee['Edition'];?><br></tr></table></BODY>"); 
OpenWindow.document.close(); 
self.name="main"; 
}


</Script>
						<tr>
						<td><INPUT type= "radio" name="tarif" value="titre1"><a href="#" onclick="openpop();"><?php echo $donnee['titre'];?></a></td>
						<td><?php echo $donnee['duree'];?></td></tr>
						<?php
						}
						$req->closeCursor();
		?>
				
				
				</table>	</center>	
			</p>
			</form>
			
		</br><span class="gauche"><a href="affiche_liste_cinemas_client.php?id_cinema=<?php echo $id_cinema;?>">vérifier l'adresse du votre cinéma</span></a>
		</br>
		</br><span class="droite"><a href="affiche_liste_film_genre_client.php?id_cinema=<?php echo $id_cinema;?>">choisissez votre séance</span></a>
			
        </div>	
		</div>
		 <?php include("bottom.php"); ?>

        </body>
</html>