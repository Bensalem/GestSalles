<?php

$table_cpt = 0;

function grid($nb_columns, $greyed_out_cols, $column_values, $start_val_idx, $caption)
{
	global $table_cpt;
	$table_cpt++;
?>
<table>
	<caption><?php echo $caption ?></caption>
	<thead id="<?php echo 'thead'.$table_cpt ?>">
		<tr>
			<th id="first-cell"></th>
			<?php
				$val_idx = $start_val_idx;
				for ($col = 0; $col < $nb_columns; $col++)
				{
					echo "<th id=\"s". $val_idx ."\">Salle ". $column_values[$val_idx]['salle'] ."</th>";
					$val_idx++;
				}
				for ($col = 0; $col < $greyed_out_cols; $col++)
				{
					echo "<th class=\"greyed-out-td\"></th>";
				}
			?>
		</tr>
	</thead>

	<tbody id="<?php echo 'tbody'.$table_cpt ?>">
	<?php
		$nb_rows_in_hour = 4;
		$first_hour = 8;
		$last_hour = 11;

		for ($hour = $first_hour; $hour < $last_hour; $hour++)
		{

			for ($row = 1; $row <= $nb_rows_in_hour; $row++)
			{
				echo "<tr>\n";
				if ($row == 1)
					echo "\t<th rowspan=$nb_rows_in_hour>$hour:00 - ".($hour+1).":00</th>\n";

				for ($td = 1; $td <= $nb_columns; $td++)
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
					echo "\" onclick='proposeSession(this, $td, $table_cpt, $first_hour,".($last_hour-1).", $hour, $row, 4)'></td>\n";
				}
				for ($td = 0; $td < $greyed_out_cols; $td++)
				{
					echo "\t<td class=\"greyed-out-td\"></td>\n";
				}
				echo "</tr>\n";
			}
		}
	?>
	</tbody>
</table>
<?php
	return $val_idx;
} ?>

