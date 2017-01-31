<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>A Web Page</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>

	<h1>Grid Generator</h1>

	<form action="#">
	<label><input type="checkbox" name="day[]" value="DayZero">Day 0</label><br>
	<label><input type="checkbox" name="day[]" value="Sunday">Sunday</label><br>
	<label><input type="checkbox" name="day[]" value="Monday">Monday</label><br>
	<label><input type="checkbox" name="day[]" value="Tuesday">Tuesday</label><br>
	<label><input type="checkbox" name="day[]" value="Wednesday">Wednesday</label><br>
	<label><input type="checkbox" name="day[]" value="Thursday">Thursday</label><br>
	<label><input type="checkbox" name="day[]" value="Friday">Friday</label><br>
	<label><input type="checkbox" name="day[]" value="Saturday">Saturday</label><br><br>

	<label>Enter number of fields <input type="text" name="numbers"></label>

	<br><input type="submit" name="submitBtn" value="Generate..."><br><br>

	</form>

	<?php
	if(!isset($_GET['submitBtn']))
	{
		exit;
	}
	$day = $_GET['day'];
	?>
	

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Tag</th>
					<?php
					for ($i = 1; $i <= $_GET['numbers']; $i++)
					{
						echo "<th>Event {$i}</th>";
					}
					?>
				</tr>
			</thead>
			<tbody>
				<?php
					for ($x = 0; $x < sizeof($day); $x++){
						echo "<tr>";
							echo "<td>";
								echo "$day[$x]";
							echo "</td>";
							for ($y=0; $y < $_GET['numbers']; $y++) { 
								echo "<td>Event {$x}.{$y}</td>";
							}
						echo "</tr>";
					}
				?>
			</tbody>
		</table>

</body>
</html>
