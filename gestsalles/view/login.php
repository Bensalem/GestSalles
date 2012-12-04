<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" media="screen" type="text/css"
			title="style" href="../view/login.css" />
	<title>GestSalles</title>
</head>

<body>
<center>
<table width="90%" height="499" border="0">
  <tr>
    <td width="148" height="314"><img src="../images/logos/cin.jpg" width="125" height="156" /></td>
    <td width="725"><center><img src="../images/logos/logo.jpg" width="566" height="250" /></center></td>
    <td width="148" height="314"><img src="../images/logos/cin2.jpg" width="125" height="156" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td id="title">
		<center>
			<big><b><em><h1>Bienvenue sur GestSalles</h1></em></b></big>
		</center>
	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
	<center>
		<form action="../controller/login.php" method="post">
			<p>
			<table>
				<tr>
					<td>Login :</td>
					<td><input name="login" type="text" /></td>
				</tr>
				<tr>
					<td>Mot de passe :</td>
					<td><input name="password" type="password" /></td>
				</tr>
				<tr>
					<td><input type="submit" value="Se connecter" /></td>
				</tr>
			</table>
			</p>
		</form>
		<div id="deny">
			<?php
				if ($access_denied)
					include('../view/error_login.php')
			?>
		</div>
	</center>
	</td>
    <td>&nbsp;</td>
  </tr>
</table>
</center>
</body>
</html>