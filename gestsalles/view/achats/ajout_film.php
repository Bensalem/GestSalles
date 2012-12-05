<?php
	include_once("../../controller/session.php");
	check_session("acheteur");
?>
<!DOCTYPE html>
<html>
<head>
	<title>GestSalles :  Film</title>
	<link rel="stylesheet" media="screen" type="text/css"
			title="style" href="../../view/client/reservation.css" />
</head>
<body>
	<div id="corps">
		<form action="../../controller/achats/confirmation_ajout_film.php"
				method="post">
		<p>
		<table>
			<tr>
				<td>TITRE :</td>
				<td><input type="text" name="titre" /></td>
			</tr>
			<tr>
				<td>DUREE :</td>
				<td><input type="text" name="duree" /></td>
			</tr>
			<tr>
				<td>GENRE :</td>
				<td><input type="text" name="genre" /></td>
			</tr>
			<tr>
				<td>ACTEURS :</td>
				<td><input type="textarea" name="acteurs" /></td>
			</tr>
			<tr>
				<td>DESCRIPTION :</td>
				<td><input type="textarea" name="description" /></td>
			</tr>
				<tr><td>EDITION :</td>
				<td><input type="text" name="sortie" /></td>
			</tr>
				<tr><td>NB COPIES :</td>
				<td><input type="text" name="nb_copies" /></td>
			</tr>
			<tr>
				<td><input type="submit" value="Valider" /></td>
			</tr>
			</table>		
		</p>
		</form> 
	</div>
</body>
</html>