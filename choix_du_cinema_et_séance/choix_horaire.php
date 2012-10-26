
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>Site GestSalle</title>
	    <link rel="stylesheet" media="screen" type="text/css" title="style" href="/style.css" />
    </head>
	
	
    <body >
		
     	<?php include("/entete.php"); ?>
		<center>
     	<div id="content" >
		<div id="corps" >
			

<form action="haraire.php" method="post">
			<p>
	    	<center>	<table>
						<tr>
						<td>horaire du film</td>
						<td>
							<select name="id_salle" />
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

										$id_cinema = $_GET['id_cinema'];
										$req = $bdd->prepare('select *  from projections where projections.id_cinema = :id_cinema');
										$req->execute(array(
												'id_cinema' => $id_cinema,
												));
										while($donnee = $req->fetch())
										{
								?>
										<option value="<?php echo $donnee['id_proj'];?>"><?php echo $donnee['heure_debut'];?></option>
								<?php
								}
								$req->closeCursor();
								?>
						</td>
						<td><input type="submit" value="Valider" /></td></tr>
						
				
				
			</table> </center>
						<input type="hidden" value="<?php echo $id_cinema;?>" name="id_cinema" /></td>
			</p>
</form>			
			
			
        </div>
        </div>
			
		</center>

        </body> </center>
</html>