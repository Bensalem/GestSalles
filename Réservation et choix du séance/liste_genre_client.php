<form action="affiche_liste_film_genre_client1.php" method="post">
			<p>
	<center>		<table>
						<tr>
						<td>CHOIX DU SEANCE</td>
						<td>
							<select name="id_genre" />
								<?php
										include ("connection.php");
										$req = $bdd->prepare('select * from genre where id_genre in (select id_genre from film where film.id_cinema = :id_cinema)');
										$req->execute(array(
												'id_cinema' => $id_cinema,
												));
										while($donnee = $req->fetch())
										{
								?>
										<option value="<?php echo $donnee['id_genre'];?>"><?php echo $donnee['libelle_genre'];?></option>
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