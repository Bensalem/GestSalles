<!DOCTYPE html>

<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Planning cinéma 2</title>

		<link rel="stylesheet" href="../../view/programmation/planning.css" type="text/css" media="screen">
		<script src="planning.js"></script>
	</head>
	<body>

<?php
	include('date.php');
	include_once('../../model/db_connexion.php');
	include_once('../../model/programmation/get_cinemas.php');

	$cinemas = get_cinemas();
	foreach($cinemas as $key => $cine)
	{
		$cinemas[$key]['nom_cinema'] = htmlspecialchars($cine['nom_cinema']);
	}
?>

	<div class="navbar">
		<div id="navbar-selecter">
			<form name="cineAndDaySelectForm" action="planning.php" method="post">

				<select name="cinemaSelect" onchange='cinemaSelectHalfSubmit()'>
  					<option>Sélectionner un cinéma</option>
  					<option>---</option>
					<?php
						foreach($cinemas as $cine)
						{
							echo "<option value='".$cine['nom_cinema']."'>".$cine['nom_cinema']."</option><br />";
						}
					?>
				</select>

				<select name="daySelect" id="day-select" onchange='daySelectHalfSubmit()'>
  					<option>Choisir le jour</option>
					<?php
						// If we are Sunday, specifying "next week" would lead us
						// two weeks after for all the $days; but we still have to
						// put a "next", only before "Sunday"
						if (date('l') == $days[6]) {
							$nextWeek = '';
						} else {
							$nextWeek = ' next week';
						}
						for ($i = 0; $i < 6; $i++) {
							$timestamp = strtotime($days[$i] . $nextWeek);
							$dateSlash = getDateSlash($timestamp);
  							echo "<option value=\"$timestamp\">$dateSlash</option>";
						}
						if (date('l') == $days[6]) { // If we are Sunday
							$timestamp = strtotime('next Sunday');
						} else {
							$timestamp = strtotime('Sunday next week');
						}
						$dateSlash = getDateSlash($timestamp);
						echo "<option value=\"$timestamp\">$dateSlash</option>";
					?>
				</select>
			</form>
		</div>

<?php
	if (isSet($_POST['cinemaSelect']) and isSet($_POST['daySelect']))
	{
		$cinema = $_POST['cinemaSelect'];
		$day_timestamp = $_POST['daySelect'];
	}
?>

		<div id="navbar-text">
			Planning du cinéma <?php if (isSet($cinema)) echo $cinema; else echo "..." ?>
		</div>
		<div id="navbar-buttons">
			<button type="button" title="Valider les modifications" onclick="window.history.back();">
				<img src="../../images/buttons/ok.png" alt="Valider" />
			</button>
			<button type="button" title="Revenir à la page précédente" onclick="window.history.back();">
				<img src="../../images/buttons/return.png" alt="Retour" />
			</button>
			<button type="button" title="Quitter l'application" onclick="window.history.back();" />
				<img src="../../images/buttons/quit.png" alt="Quitter" />
			</button>
		</div>
	</div>

<?php
	if (isSet($cinema) and isSet($day_timestamp))
	{
		$dateStr = getDateStr($day_timestamp);

		include '../../view/programmation/planning_grid.php';
		include '../../model/programmation/get_rooms.php';

		$rooms = get_rooms($cinema);
		if (! $rooms)
		{
			exit("<br />Aucune salle a été trouvé pour le cinéma $cinema dans la base de données !");
		}

		$nb_rooms = count($rooms);

		/* Displaying of the cinema program table for the chosen day */

		echo '<div id="planning-grid">';

		$nb_rooms_per_table = 7;
		$nb_tables = (int) ($nb_rooms / $nb_rooms_per_table);
		$nb_rooms_last_table = $nb_rooms % $nb_rooms_per_table;

		if ($nb_tables > 0)
		{
			$start_val_index = grid($nb_rooms_per_table, 0, $rooms, 0, $dateStr);
			for ($table = 1; $table < $nb_tables; $table++)
			{
				$start_val_index = grid($nb_rooms_per_table, 0, $rooms, $start_val_index, "");
			}
			grid($nb_rooms_last_table, ($nb_rooms_per_table - $nb_rooms_last_table), $rooms, $start_val_index, "");
		}
		else
		{
			grid($nb_rooms_last_table, ($nb_rooms_per_table - $nb_rooms_last_table), $rooms, 0, $dateStr);
		}

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

			<p style="font-size: 13px; font-style: italic; margin-top: 2px; padding-left: 41px;">
				<span id="session-form-title">Ajouter une séance</span>
				<input style="margin-left: 17px;" type="button" id="remove-button" name="removeButton" value="Supprimer" onclick="" />
			</p>
			<p style="margin-top: 0px;"><b>Date :</b> <span id="sessionFormDate" style="font-size: 14px;"><?php echo $dateStr ?></span></p>

			<p><b>Horaire :</b>
				<input name="beginHour" id="begin-hour" value="18" type="text" class="time-slot"> :
				<input name="beginMin" id="begin-min" value="00" type="text" size="2" class="time-slot" /> –
				<input name="endHour" id="end-hour" value="19" type="text" class="time-slot"> :
				<input name="endMin" id="end-min" value="30" type="text" size="2" class="time-slot" />
			</p>

			<input type="hidden" id="cinema" value="<?php echo $cinema ?>">
			<input type="hidden" id="date" value="<?php echo date("Y-m-d", $day_timestamp) ?>">

			<label for="movieSelecter">Film :</label>
			<select id="movie-selecter" name="movieSelecter" style="width: 200px; margin-left: 5px;">
				<!-- the movies available are proposed here <option value="idmovieY">Film Y</option> -->
			</select>
			<br /><br />

			<label for="room">Salle :</label>
			<select id="room-selecter" name="roomSelecter" disabled="disabled" style="width: 200px;">
				<!-- there must be only one option -->
				<option></option>
			</select>
			<br /><br />

			<div style="text-align: center;">
				<input type="button" name="saveButton" value="Enregistrer" onclick="sessionFormSubmit()" />
				<input type="button" name="resetButton" value="Effacer" onclick="sessionFormReset()"/>
				<input type="button" name="abortButton" value="Annuler" onclick="sessionFormAbort()"/><br/>
			</div>
		</form>
	</div>

<?php
		} // end if [$cinema and $day are set]
?>

	</body>
</html>