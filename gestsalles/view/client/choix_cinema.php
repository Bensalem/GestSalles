<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<title>Choix du cinéma</title>
	<link rel="stylesheet" media="screen" type="text/css"
			title="style" href="../../view/client/reservation.css" />
	<script src="../../controller/client/choix_cinema.js"></script>
</head>
<body>
	<?php include("../../view/header.php"); ?>

	<div>
		<p>
		<form name="toNextPageForm"
				action="../../controller/client/choix_film.php" method="post">
			<table>
				<tr>
					<td width="33%">
						<select id="cinemaSelecter" name="id_cinema" onChange="updateCinemaNameSelected(this)" />
						<?php
							foreach($cinemas as $cine)
							{
								echo "<option value=\"".$cine['id']."\">";
								echo $cine['nom_cinema'];
								echo "</option>";
							}
						?>
						</select>
					</td>
					<center>
					<td><input type="submit" value="Valider" /></td>
					</center>
				</tr>
			</table>
			<input type="hidden" name="cinemaName" value="">
		</form>
		</p>
	</div>

	<div id="content" >
		<p>
		<table>
			<tr>
				<td>Cinéma</td>
				<td>Rue</td>
				<td>Ville</td>
			</tr>
			<?php
				foreach($cinemas as $cine)
				{
					echo "<tr>";
					echo "<td>".$cine['nom_cinema']."</td>";
					echo "<td>".$cine['num_et_rue']."</td>";
					echo "<td>".$cine['ville']."</td>";
					echo "</tr>";
				}
			?>
		</table>
		</p>
	</div>
	<?php include("footer.php"); ?>
</body>
</html>