<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<title>GestSalles : Caisses</title>
	<link rel="stylesheet" media="screen" type="text/css"
			title="style" href="reservation.css" />
	<script src="caisses.js"></script>
</head>
<body>
	<br><br><br>
	<?php include("../../view/header.php"); ?>

	<br><br>
	<center>
	<form name="tillContentForm" action="ecran_principal.php" method="post">
		<p>
			<label>Monnaie en caisse :</label>
			<input id="tillContentField" name="tillContent" type="text" value="<?php echo $till['contenu']; ?>" /> €
		</p>
		<p>
			<label>Ajuster le montant :</label>
			<input id="contentSetter" type="text"/>
			<input type="button" value="Mettre à jour"
					onclick="updateTillContent(<?php echo $_SESSION['id_caisse'] ?>)" />
		</p>
		<p>
			<input type="submit" value="Valider" />
		</p>
	</form>
	</center>
</body>
</html>