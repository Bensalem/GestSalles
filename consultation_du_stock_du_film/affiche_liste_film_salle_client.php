<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>GestSalles :  Film</title>
	    <link rel="stylesheet" media="screen" type="text/css" title="Design" href="style.css" />
    </head>
    <body>
		
     	<?php include("entete.php"); ?>
     	<div id="content" >
		<div id="corps" >
			<?php 
			$id_cinema = $_GET['id_cinema'];
			include("liste_salle_client.php"); 
			?>
			
        </div>
        </div>
			<?php include("bottom.php"); ?>
		

        </body>
</html>