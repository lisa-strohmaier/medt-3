<?php

session_start();

if (!isset($_SESSION['check']))
{
	header('Location: http://localhost/medt/ue14/index.php');
}		

?>
