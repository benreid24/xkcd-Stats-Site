<?php
	include("util/sql.php");
	include("util/display.php");
	$db = connect_to_db();
	
	//Fetch top 20 comics
	$comics = get_top_comics($db, 20);
	
	//Fetch general stats
	$stats = get_stats($db);
?>


<!DOCTYPE html>
<html>

<head>
	<title>xkcd Reddit Stats</title>
	<link rel="stylesheet" href="assets/table.css">
</head>

<body>
	<h1>xkcd Reddit Stats</h1>
	<?php
		print_stats_blurb($stats);
		print_top_comics($comics);
	?>
</body>

</html>