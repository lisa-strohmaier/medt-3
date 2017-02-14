<html>
<head>
	<title>Daaaatenbank!</title>
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
 
   }
	catch (PDOException $e) 
	{
   	print "Fehler!: ".$e->getMessage()."<br/>";
   	die();
   }


   $status = $dbh->getAttribute(PDO::ATTR_CONNECTION_STATUS);
   if($status==true)
   {
      echo "Verbindung vorhanden :D";
   }
   else
   {
      echo "Keine Verbindung möglich :(";
   }
?>
</body>
</html>
