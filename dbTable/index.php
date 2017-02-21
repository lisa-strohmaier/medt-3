<html>
<head>
	<title>Daaaatenbank!</title>

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
	<h1>Daaaaaatenbank ;)</h1>
<?php
	$host = 'localhost';
	$dbname = 'medt3';
	$user = 'htluser';
	$pwd = 'htluser';

   try{
      $dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pwd);
      $sql = "SELECT * FROM project";
      $res = $dbh->query($sql);
      $tmp = $res->fetchAll();
    //  print_r($tmp);
      echo "<table class=\"table table-hover\">";
      foreach ($tmp as $row) 
      {
         echo "<tr>";
         echo "<td>".$row['name']."</td>";
         echo "<td>".$row['description']."</td>";
         echo "<td>".$row['createDate']."</td>";
         echo "</tr>";
      }
      echo "</table>";

   }
   catch (PDOException $e) 
   {
   	print "<p>DB nicht verfügbar: ".$e->getMessage()."</p>";
   	die();
   }


   $status = $dbh->getAttribute(PDO::ATTR_CONNECTION_STATUS);
   if($status==true)
   {
    //Verbindung
   }
   else
   {
      //Keine Verbindung
   }
?>
</body>
</html>
