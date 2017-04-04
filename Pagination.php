<!DOCTYPE html>
<html>
<head>
	<title>Pagination</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
	integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        a:hover {
            text-decoration: none;
        }
    </style>
</head>
<body>

	<?php

	$host = 'localhost';
	$dbname = 'classicmodels';
	$user = 'root';
	$pwd = '';
	
	$nrOnPage = 20;
	
	try {
		if (isset($_GET['CountPages']))
			$count = $_GET['CountPages'];
		
		else
			$count = 0;
		
	$db = new PDO ("mysql:host=$host;dbname=$dbname", $user, $pwd );
	$sql = "SELECT productCode, productName, productLine From products limit $count,$nrOnPage";
	$maxsql = "SELECT (ceiling(count(*)/".$nrOnPage.")-1)*".$nrOnPage." maxPage FROM products";
	$max = $db->query($maxsql)->fetchAll(PDO::FETCH_ASSOC)[0]['maxPage'];
	
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	}
	catch (PDOException $e) {

    die("<p>Datenbank nicht verfügbar</p>");
    $db = null;
	}
	
	echo "<h1>KUNDENÜBERSICHT</h1>";
	?>
	<a href="index.php?CountPages=0" style="margin-left: 8%;"> <span class="glyphicon glyphicon-fast-backward"></span> </a>

	<a href="index.php?CountPages=<?php echo $count-$nrOnPage < 0 ? 0 : $count-$nrOnPage; ?>"> <span class="glyphicon glyphicon-step-backward"></span> </a>

	<a href="index.php?CountPages=<?php echo $count+$nrOnPage > $max ? $max : $count+$nrOnPage; ?>"> <span class="glyphicon glyphicon-step-forward"></span> </a>

	<a href="index.php?CountPages=<?php echo $max; ?>">  <span class="glyphicon glyphicon-fast-forward"></span>  </a>

	<?php
	echo "<table class=\"table tables-bordered\">";

	echo "<thead>";
		echo "<th>Code</th>";
		echo "<th>Name</th>";
		echo "<th>Line</th>";
	echo "</thead>";

	foreach ($db->query($sql) as $item)
	{
		echo "<tr>";

		?> <td class="col-xs-4 col-md-4"> <?php
		echo $item->productCode;
		echo "</td>";

		?> <td class="col-xs-4 col-md-4"> <?php
		echo $item->productName;
		echo "</td>";

		?> <td class="col-xs-4 col-md-4"> <?php
		echo $item->productLine;
		echo "</td>";
	}

	echo "</table>";
	?>
	
