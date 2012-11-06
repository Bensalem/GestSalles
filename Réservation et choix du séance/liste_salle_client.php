<form action="affiche_liste_film_salle_client1.php" method="post">
			<p>
			<table>
						<tr>
						<td>nom de la salle</td>
						<td>
							<select name="id_salle" />
								<?php
										include ("connection.php");
										$req = $bdd->prepare('select *  from salle where salle.id_cinema = :id_cinema');
										$req->execute(array(
												'id_cinema' => $id_cinema,
												));
										while($donnee = $req->fetch())
										{
								?>
										<option value="<?php echo $donnee['id_salle'];?>"><?php echo $donnee['nom'];?></option>
								<?php
								}
								$req->closeCursor();
								?>
						</td>
						<td><input type="submit" value="Valider" /></td></tr>
						
				
				
			</table>
						<input type="hidden" value="<?php echo $id_cinema;?>" name="id_cinema" /></td>
			</p>
</form>