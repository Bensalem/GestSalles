<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>GestSalles :  Film</title>
	    <link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" /> 
    </head>
    <body>
		
     	<?php include("entete.php"); ?>
     	<div id="content" >
		
		<?php include("liste_cinema_client.php"); ?>
		
		<center><form action="formulaireCible.php" method="post">
			<p>
		<table>
						<tr>
						<td>cinema</td>
						<td>rue</td>
						<td>ville</td></tr>
				<?php
				include ("connection.php");
						
						$req = $bdd->prepare('select *  from adresse');
						$req->execute(array(
								//'id_adr' => $id_adr,
								));
						while($donnee = $req->fetch())
						{
				?>
						<tr>
						<td><?php echo $donnee['id_cinema'];?></td>
						<td><?php echo $donnee['rue'];?></td>
						<td><?php echo $donnee['ville'];?></td>
						
						</tr>
						<?php
						}
						$req->closeCursor();
		?>
				
				
				</table>		
			</p>
			</form></center>
		
		
		</div>
		<?php include("bottom.php"); ?>
        </body>
</html>