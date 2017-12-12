<?php
	include("util/sql.php");
	include("util/display.php");
	$db = connect_to_db();
	
	//Fetch top 20 comics
	$comics = get_top_comics($db, 20);
?>


<!DOCTYPE html>
<html>

<head>
	<title>xkcd Reddit Stats</title>
</head>

<body>
	<h1>xkcd Reddit Stats</h1>
	<?php
		print_top_comics($comics);
	?>
</body>

</html>