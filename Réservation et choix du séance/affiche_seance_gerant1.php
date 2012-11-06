<?php include("../session.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>GestSalles :  Film</title>
	    <link rel="stylesheet" media="screen" type="text/css" title="Design" href="../design.css" />
    </head>
    <body>
		
     	<?php include("entete.php"); ?>
     	<div id="content" >
		<div id="corps" >
			<form action="affiche_seance_gerant2.php" method="post">
			<p>
			<table>
				<tr><td>date:</td>
					<td><select name="date" />
					
					<?php
					
				        include ("connection.php");	
						$reponse = $bdd->query(' select distinct CAST(horaire AS DATE) DT FROM projections ;');
						while($donnee = $reponse->fetch())
						{
				?>
					    <option value="<?php echo $donnee['DT'];?>" ><?php echo $donnee['DT'];?></option>
					<?php 
					}
					$reponse->closeCursor();
					
					?>
					
					    </select>
					</td>
					<td><input type="submit" value="Valider" /></td></tr>
				</table>		
			</p>
			</form> 
			
        </div>
          </br><a href="../deconnexion.php">Deconnexion</a>
        </div>

			<?php include("bottom.php"); ?>


        </body>
</html>