<?php
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "1g57bh32";
	$dbname = "testdb";

	try
	{
		$db = new PDO("mysql:host=$dbhost;dbname=$dbname", "$dbuser", "$dbpass", array (PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
?>

