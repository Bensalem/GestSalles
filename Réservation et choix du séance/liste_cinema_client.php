<center><form action="affiche_liste_films_client.php" method="post">
			<p>
		<center>	<table>
					<tr><td width="33%">
							<select name="id_cinema" />
								<?php 
								include ("connection.php");
								$reponse_cinema = $bdd->query('select * from cinema where cinema.id_cinema in (select id_cinema from film)');
								while($donnee_cinema = $reponse_cinema->fetch())
									{	
								?>							
										<option value="<?php echo $donnee_cinema['id_cinema'];?>"><?php echo $donnee_cinema['nom'];?></option>
														
								<?php
									}
									$reponse_cinema->closeCursor();
								?>
							</select>	
						</td>
						
						<center><td><input type="submit" value="Valider" /></td></center></tr>
				</table> </center>					
			</p>
</form> </center>

