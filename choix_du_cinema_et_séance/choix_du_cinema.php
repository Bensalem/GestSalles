<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title> Site GestSalle</title>
	     <link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" /> 
    </head>
    <body>
		
     	<?php include("/entete.php"); ?>
     	
		<form action="choix_du_film_dans_cinema.php" method="post">
			<p>
		<center>	<table>
					<tr><td width="33%">
							<select name="id_cinema" />
								<?php 
								
                                           try
					{
						$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
						$bdd = new PDO('mysql:host=localhost;dbname=gestsalles', 'root', '', $pdo_options);
					}
                                  catch(Exception $e)
					{
						die('Erreur : '.$e->getMessage());
					}				
								$reponse_cinema = $bdd->query('select * from cinema where cinema.id_cinema in (select id_cinema from salle) ');
								while($donnee_cinema = $reponse_cinema->fetch())
									{	
								?>							
										<option value="<?php echo $donnee_cinema['id_cinema'];?>"><?php echo $donnee_cinema['nom'];?></option>
									   	<option value="<?php echo $donnee_cinema['id_cinema'];?>"><?php echo $donnee_cinema['id_cinema'];?></option>";
								<?php
									}
									$reponse_cinema->closeCursor();
								?>
							</select>	
						</td>
						
						<center><td><input type="submit" value="Valider" /></td></center></tr>
				</table> </center>					
			</p>
</form> 




<center><form action="formulaireCible.php" method="post">
			<p>
		<table>
						<tr>
						<td>cinema</td>
						<td>rue</td>
						<td>ville</td></tr>
				<?php
						try
					               {
						$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
						$bdd = new PDO('mysql:host=localhost;dbname=gestsalles', 'root', '', $pdo_options);
					               }
                           catch(Exception $e)
					               {
						die('Erreur : '.$e->getMessage());
					                }	
						
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
		
        </body>
</html>