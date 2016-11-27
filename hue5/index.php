<html>
  <head>
  	<meta charset="UTF-8">
	<title>HUE5</title>
	<style>

	.btn{
		margin: 10px;
	}
	</style>
  </head>
  <body>
	<h1>Hausübung 5</h1>
		<form method="post" action="//localhost/medt/hue5/index.php">
			Ihre Eingabe: <input type="text" name="txt"/>
			<div class="btn">
				<input type="submit" name="explodeBtn" value="Explode">
				<input type="submit" name="resetBtn" value="Reset">
				
			</div>
		</form>
		<p>Ihre Eingabe als Liste: </p>
		<?php

	   	if (!empty($_POST))
			$text = $_POST['txt'];

				if(isset($_POST['explodeBtn'])){ ?>
					<?php
						$arr = explode(" ",$text);
						echo "<ul>";
						foreach($arr as $item)
						{
							echo "<li>$item</li>";
						}
						echo "</ul>";
				 } ?>
  </body>
</html>
