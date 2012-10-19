<?php
	date_default_timezone_set('Europe/Paris');
	setlocale(LC_TIME, 'fr_FR.UTF8', 'fr_FR', 'fra');
	$days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');

	function getDateSlash($timestamp)
	{
		return strftime('%d/%m/%Y', $timestamp);
	}

	function getDateStr($timestamp)
	{
		return strftime('%A %d %B %Y', $timestamp);
	}
?>
