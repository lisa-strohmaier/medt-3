<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Uebung 8 - Datenbank</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>

	<?php
	echo $_SERVER['REQUEST_URI'];


	
	// DB Settings
	$host = 'localhost';
	$dbname = 'medt3';
	$user = 'htluser';
	$pwd = 'htluser';


	try
	{
	$db = new PDO ("mysql:host=$host;dbname=$dbname", $user, $pwd ); // komfortable Schnittstelle PDO
	$db->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
	$sql = "SELECT * From project";
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	}
	catch (PDOException $e) {

	die($e->getMessage());
    exit("<p>Datenbank nicht verfügbar</p>"); // die(); geht auch ==> ist ident
    $db = null;
	}

	if (isset($_GET['deleteProject']))
	{

		$query = $db->prepare('DELETE FROM project WHERE id= :id');
		$query->bindParam(':id', $_GET['deleteProject'], PDO::PARAM_INT);
		$query->execute();

		$tmp = true;

        if ($tmp)
        echo '<p class="bg-success">Das Projekt wurde erfolgreich gelöscht!</p>';

        else
          echo '<p class="bg-danger">Das Projekt konnte nicht gelöscht werden!</p>';
	}

	if (isset($_GET['editProject']) || isset($_POST['editProject']))
	{
		if (isset($_POST['submitButton']))
		{
		$query = $db->prepare("UPDATE project SET name=:name,description=:description,createDate=:createDate WHERE id= :id");
		$query->bindParam(':name', $_POST['Name'], PDO::PARAM_STR);
		$query->bindParam(':description', $_POST['Beschreibung'], PDO::PARAM_STR);
		$query->bindParam(':createDate', $_POST['Datum']);
		$query->bindParam(':id', $_POST['editProject'], PDO::PARAM_INT);
		$query->execute();
		if ($query != false)
			$rowCount = $query->rowCount();
		}
		else {
		$query = $db->query("SELECT * from project where id=".$_GET['editProject']);
		$data = $query -> fetch(PDO::FETCH_OBJ); // eine Zeile kommt zurück

		echo '<form action="#" method="POST" style="margin-top: 50px; margin-bottom: 50px; margin-left: 25%">';
		echo "<input name=\"Name\" type=\"text\" value=\"$data->name\"><br>";
		echo "<input name=\"Beschreibung\" type=\"text\" value=\"$data->description\"><br>";
		echo "<input name=\"Datum\" type=\"date\" value=\"$data->createDate\"><br>";
		echo "<input name=\"editProject\" type=\"text\" value=\"".$_GET['editProject']."\" hidden>";
		echo '<input type="submit" name="submitButton">';
		echo "</form>";
		}
	}

	if (isset($_GET['newProject']) || isset($_POST['newProject']))
	{
		if (isset($_POST['submitButton']))
		{
		$query = $db->prepare("INSERT INTO  project (name, description, createDate) VALUES (name=:name,description=:description,createDate=:createDate)");
		$query->bindParam(':name', $_POST['Name'], PDO::PARAM_STR);
		$query->bindParam(':description', $_POST['Beschreibung'], PDO::PARAM_STR);
		$query->bindParam(':createDate', $_POST['Datum']);
		$query->bindParam(':id', $_POST['editProject'], PDO::PARAM_INT);
		$query->execute();
		if ($query != false)
			$rowCount = $query->rowCount();
		}
		else {
		$query = $db->query("SELECT * from project where id=".$_GET['newProject']);
		$data = $query -> fetch(PDO::FETCH_OBJ); // eine Zeile kommt zurück

		echo '<form action="#" method="POST" style="margin-top: 50px; margin-bottom: 50px; margin-left: 25%">';
		echo "<input name=\"Name\" type=\"text\" value=\"$data->name\"><br>";
		echo "<input name=\"Beschreibung\" type=\"text\" value=\"$data->description\"><br>";
		echo "<input name=\"Datum\" type=\"date\" value=\"$data->createDate\"><br>";
		echo "<input name=\"newProject\" type=\"text\" value=\"".$_GET['newProject']."\" hidden>";
		echo '<input type="submit" name="submitButton">';
		echo "</form>";
		}
	}

	?>

	<h1>DATENBANK!</h1>

	<table class="table table-striped">
	<thead>
		<th>Project ID</th>
		<th>Project Name</th>
		<th>Project Description</th>
		<th>User ID</th>
		<th>Create Date</th>
		<th></th>
	</thead>

	<?php

	$i = 1;
	foreach ($db->query($sql) as $item) //static-Zugriff in PHP mit ':'!
	{
		echo "<tr>";

		?> <td class="col-xs-2 col-md-2"> <?php
		echo $item->id;
		echo "</td>";

		?> <td class="col-xs-2 col-md-2"> <?php
		echo $item->name;
		echo "</td>";

		?> <td class="col-xs-2 col-md-2"> <?php
		echo $item->description;
		echo "</td>";

		?> <td class="col-xs-2 col-md-2"> <?php
		echo $item->createDate;
		echo "</td>";

		?> <td class="col-xs-3 col-md-3"> <?php
 
		echo "

		<a href=\"index.php?editProject=$item->id\" style=\"margin-right: 15px;\"> <span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span> </a>
		<a href=\"index.php?deleteProject=$item->id\"> <span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span> </a>
		<a href=\"index.php?newProject=$item->id\"> <span class=\"glyphicon glyphicon-plus\" aria-hidden=\"true\"></span> </a>";


		echo "</td>";

		echo "</tr>";
	}
	?>
	</table>
	<?php
	?>

</body>
</html>
