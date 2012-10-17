<!DOCTYPE html>

<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Planning cinéma 2</title>

		<link rel="stylesheet" href="planning.css" type="text/css" media="screen">
	</head>
	<body>
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
	<div class="navbar">
		<div id="navbar-selecter">
			<select>
  				<option>Sélectionner un cinéma</option>
  				<option>---</option>
  				<option value="cinema 1">Cinéma 1</option>
				<option value="cinema 2">Cinéma 2</option>
				<option value="cinema 3">Cinéma 3</option>
			</select>
		</div>
		<div id="navbar-text">
			Planning du cinéma de Bordeaux
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

	<div id="planning-grid">
		<table>
			<caption>Semaine du 19/01/2012</caption>
			<thead>
				<tr>
					<th id="first-cell"></th>
					<th id="day1">Lundi</th>
					<th id="day2">Mardi</th>
					<th id="day3">Mercredi</th>
					<th id="day4">Jeudi</th>
					<th id="day5">Vendredi</th>
					<th id="day6">Samedi</th>
					<th id="day7">Dimanche</th>
				</tr>
			</thead>

			<tbody id="tbodyId">
	<?php
		$nb_rows_in_hour = 4;
		$nb_tds = 7;
		$first_hour = 8;
		$last_hour = 11;

		for ($hour = $first_hour; $hour < $last_hour; $hour++)
		{

			for ($row = 1; $row <= $nb_rows_in_hour; $row++)
			{
				echo "<tr>\n";
				if ($row == 1)
					echo "\t<th rowspan=".$nb_rows_in_hour.">".$hour.":00 - ".($hour+1).":00</th>\n";

				for ($td = 1; $td <= $nb_tds; $td++)
				{
					echo "\t<td class=\"";
					switch ($row)
					{
						case 4:
							echo "time-atom-solid";
							break;
						case 2:
							echo "time-atom-dashed";
							break;
						case 1:
						case 3:
							echo "time-atom-dotted";
							break;
						default:
							echo "time-atom";
					}
					echo "\" onclick='proposeSession(this,".$td.",".$first_hour.",".($last_hour-1).",".$hour.",".$row.",4)'></td>\n";
				}
				echo "</tr>\n";
			}
		}
	?>
			</tbody>
		</table>
	</div>

	<div id="movie-sessions">
		<div id="movie-session-model" class="movie-session"
			onmouseover="highlight(this)" onmouseout="unHighlight(this)"></div>
	</div>

	<script src="planning.js"></script>

	<div id="movie-session-form-div" name="movieSessionFormDiv">
		<form method="post" action="submitForm()" name="movieSessionForm" id="movie-session-form">

			<p style="font-size: 13px; font-style: italic; margin-top: 2px; padding-left: 34px;">Ajouter une séance</p>
			<p style="margin-top: 0px;"><b>Date :</b> <span style="font-size: 13px;">Mercredi 12 novembre 2012</span></p>

			<p><b>Horaire :</b>
				<input name="beginHour" id="hour" value="18" type="text" class="time-slot" readonly="readonly"> :
				<input name="beginMin" value="00" type="text" size="2" class="time-slot" /> –
				<input name="endHour" id="hour" value="19" type="text" class="time-slot" readonly="readonly"> :
				<input name="endMin" value="30" type="text" size="2" class="time-slot" />
			</p>

			<label for="movie">Film :</label>
			<select name="movie" style="width: 200px; margin-left: 5px;">
				<option value="idmovie1">Titre film</option>
				<option value="idmovie2">Film 2</option>
				<option value="idmovie3">Film 3</option>
			</select>
			<br /><br />

			<label for="room">Salle :</label>
			<select name="room" style="width: 200px;">
				<option value="Salle 1">Salle 1</option>
				<option value="Salle 2">Salle 2</option>
				<option value="Salle 3">Salle 3</option>
			</select>
			<br /><br />

			<div style="text-align: center;">
				<input type="button" name="saveButton" value="Enregistrer" onclick="sessionFormSubmit()" />
				<input type="button" value="Effacer" onclick="reset()"/>
				<input type="button" value="Annuler" onclick="sessionFormAbort()"/>
			</div>
		</form>
	</div>

	</body>
</html>
