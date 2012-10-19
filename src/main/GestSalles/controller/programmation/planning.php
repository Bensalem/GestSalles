<!DOCTYPE html>

<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Planning cinéma 2</title>

		<link rel="stylesheet" href="view/programmation/planning.css" type="text/css" media="screen">
		<script src="planning.js"></script>
	</head>
	<body>

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
<!--
		<?php
			try
			{
				$db = new PDO('mysql:host=localhost;dbname=testdb', 'root', '1g57bh32');
			}
			catch (Exception $e)
			{
				die('Erreur : ' . $e->getMessage());
			}


			$projections = $db->query('SELECT heure_debut FROM projections');

			while ($projection = $projections->fetch())
			{
				echo "<br />". $projection['heure_debut'];
			}

			/* Ne récupérer que les projections de la semaine courante ou de celle qui vient */

			$hour_base = $db->query('SELECT MIN(heure_debut) FROM projections'); /* WHERE heure_debut > ... */
			

			$projections->closeCursor();
		?>
-->

<?php
	if (isSet($_POST['cinemaSelect']) and isSet($_POST['daySelect']))
	{
		$cinema = $_POST['cinemaSelect'];
		$day_timestamp = $_POST['daySelect'];
	}
?>

	<div class="navbar">
		<div id="navbar-selecter">
			<form name="cineAndDaySelectForm" action="planning.php" method="post">
				<select name="cinemaSelect" onchange='cinemaSelectHalfSubmit()'>
  					<option>Sélectionner un cinéma</option>
  					<option>---</option>
  					<option value="Le Rex">Le Rex</option>
					<option value="Les Variétés">Les Variétés</option>
					<option value="Ciné+">Ciné+</option>
				</select>
				<select name="daySelect" onchange='daySelectHalfSubmit()'>
  					<option>Choisir le jour</option>
					<?php
						for ($i = 0; $i < 5; $i++)
						{
							$timestamp = strtotime('next '.$days[$i]);
							$dateSlash = getDateSlash($timestamp);
  							echo "<option value=\"$timestamp\">$dateSlash</option>";
						}
						for ($i = 5; $i < 7; $i++)
						{
							$timestamp = strtotime('next '.$days[$i].' +1 week');
							$dateSlash = getDateSlash($timestamp);
  							echo "<option value=\"$timestamp\">$dateSlash</option>";
						}
					?>
				</select>
			</form>
		</div>

		<div id="navbar-text">
			Planning du cinéma <?php if (isSet($cinema)) echo "$cinema"; else echo "..." ?>
		</div>
		<div id="navbar-buttons">
			<button type="button" title="Valider les modifications" onclick="window.history.back();">
				<img src="images/buttons/ok.png" alt="Valider" />
			</button>
			<button type="button" title="Revenir à la page précédente" onclick="window.history.back();">
				<img src="images/buttons/return.png" alt="Retour" />
			</button>
			<button type="button" title="Quitter l'application" onclick="window.history.back();" />
				<img src="images/buttons/quit.png" alt="Quitter" />
			</button>
		</div>
	</div>

<?php
	if (isSet($cinema) and isSet($day_timestamp))
	{
		$dateStr = getDateStr($day_timestamp);

		include '../view/programmation/planning-grid.php';

		include('../model/db_connexion.php');

		include('../model/programmation/get_rooms.php');
		$rooms = get_rooms($cinema);
		$nb_rooms = count($rooms);

		/* Displaying of the cinema program table for the day chosen */

		echo '<div id="planning-grid">';

		$nb_rooms_per_table = 7;
		$nb_tables = (int) ($nb_rooms / $nb_rooms_per_table);
		$nb_rooms_last_table = $nb_rooms % $nb_rooms_per_table;

		$start_val_index = grid($nb_rooms_per_table, 0, $rooms, 0, $dateStr);
		for ($table = 1; $table < $nb_tables; $table++)
		{
			$start_val_index = grid($nb_rooms_per_table, 0, $rooms, $start_val_index, "");
		}
		grid($nb_rooms_last_table, ($nb_rooms_per_table - $nb_rooms_last_table), $rooms, $start_val_index, "");

		echo '</div>'
	// the if does not end here
?>

	<div id="movie-sessions">
		<div id="movie-session-model" class="movie-session"
			onmouseover="highlight(this)" onmouseout="unHighlight(this)"></div>
	</div>


	<!-- The form for entering or editing a movie session -->

	<div id="movie-session-form-div" name="movieSessionFormDiv">
		<form method="post" action="submitForm()" name="movieSessionForm" id="movie-session-form">

			<p style="font-size: 13px; font-style: italic; margin-top: 2px; padding-left: 36px;">Ajouter une séance</p>
			<p style="margin-top: 0px;"><b>Date :</b> <span id="sessionFormDate" style="font-size: 14px;"><?php echo $dateStr ?></span></p>

			<p><b>Horaire :</b>
				<input name="beginHour" id="hour" value="18" type="text" class="time-slot" readonly="readonly"> :
				<input name="beginMin" value="00" type="text" size="2" class="time-slot" /> –
				<input name="endHour" id="hour" value="19" type="text" class="time-slot" readonly="readonly"> :
				<input name="endMin" value="30" type="text" size="2" class="time-slot" />
			</p>

			<input type="hidden" id="cinema" value="<?php echo $cinema ?>">
			<input type="hidden" id="date" value="<?php echo $day_timestamp ?>">

			<label for="movieSelecter">Film :</label>
			<select id="movie-selecter" name="movieSelecter" style="width: 200px; margin-left: 5px;">
				<!-- the movies available are proposed here <option value="idmovieY">Film Y</option> -->
			</select>
			<br /><br />

			<label for="room">Salle :</label>
			<select name="roomSelecter" disabled="disabled" style="width: 200px;">
				<!-- there must be only one option -->
				<option></option>
			</select>
			<br /><br />

			<div style="text-align: center;">
				<input type="button" name="saveButton" value="Enregistrer" onclick="sessionFormSubmit()" />
				<input type="button" value="Effacer" onclick="reset()"/>
				<input type="button" value="Annuler" onclick="sessionFormAbort()"/>
			</div>
		</form>
	</div>

<?php
		} // end if [$cinema and $day are set]
?>

	</body>
</html>
