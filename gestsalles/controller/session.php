<?php
session_start();

function check_session($fonction)
{
	if (!isset($_SESSION) || $_SESSION['fonction'] != $fonction) {
			header('Location:../../view/access_denied.php');
	}
}
?>