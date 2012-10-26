<?php
session_start();
if (isset($_POST)&& !empty($_POST['login']) && !empty($_POST['pass'])){
extract($_POST);

mysql_connect("127.0.0.1","root","");
mysql_select_db("gestsalles");
$sql = "SELECT id_personnel,Fonction FROM personnel WHERE Login ='$login' AND Password ='$pass'";
$req = mysql_query($sql) or die(mysql_error());
$tab = mysql_fetch_array($req);
	$fonction = $tab[ 1];
	echo $fonction;
	$prog='programmateur';
	$achet='acheteur';
	$cais='caissier';
	$gera='gerant';
	if ($fonction == $prog){
	header('Location:programmateur.php');
	}
	else if ($fonction == $achet){
	header('Location:acheteur.php');
	}
	else if ($fonction == $cais){
	header('Location:caissier.php');
	}
	else if ($fonction == $gera){
	header('Location:gerant.php');
	}
/*	
if( mysql_num_rows($req)>0){
$_SESSION['Auth'] = array(
       'login' => $login,
	    'pass' => $pass
);
    
   header('Location:page_prive.php');
}
else {
          echo 'mauvais identifiant';
		  }*/

}
?>
<html>
  <form action="login.php" method="post">
	                        <p>
	                        <table>
	                                <tr><td>login:</td>
	                                        <td><input type="text" name="login" /></td></tr>
	                                <tr><td>Mot de passe:</td>
	                                        <td><input type="password" name="pass" /></td></tr>
	                                <tr><td><input type="submit" value="connecter" /></td></tr>
	                                                
	                                </table>                
	                        </p>
                        </form>
						</html>