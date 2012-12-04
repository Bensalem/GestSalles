<!DOCTYPE html>
<html>
<head>
	<title>GestSalles : Film</title>
	<link rel="stylesheet" media="screen" type="text/css"
			title="style" href="../../view/client/reservation.css" />
</head>
<body>
	<?php include("../../view/header.php"); ?>

	<br>
	<div id="content" >
	<center>
	<p>
	<table>
		<tr>
			<th>Titre du film</th>
			<th>Durée</th>
			<th>Année</th>
		</tr>
		<tr>
			<td><?php echo $movieTitle; ?></td>
			<td><?php echo $duration; ?> mins</td>
			<td><?php echo $edition; ?></td>
		</tr>
	</table>
	</p>

	<br>
	<form action="confirmation_commentaire.php" method="post">
		<table>
			<tr>
				<td>Pseudo :</td>
				<td><input type="text" name="pseudo" /></td>
			</tr>
			<tr>
				<td>Mail :</td>
				<td><input type="text" name="email" /></td>
			</tr>
			<tr>
				<td>Commentaire :</td>
				<td><textarea name="comment"></textarea></td>
			</tr>

			<input type="hidden" name="id_film" value=<?php echo $id_film; ?> />
			<tr>
				<td colspan="2"><input type="submit" value="Valider" /></td>
			</tr>
		</table>
	</form>
	</center>
	</div>
</body>
</html>