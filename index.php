<?php
	include("util/sql.php");
	include("util/display.php");
	$db = connect_to_db();
	
	//Fetch top 20 comics
	$comics = get_top_comics($db, 20);
	
	//Fetch top 10 posters
	$posters = get_top_posters($db, 10);
	
	//Fetch general stats
	$stats = get_stats($db);
?>


<!DOCTYPE html>
<html>

<head>
	<title>xkcd Reddit Stats</title>
	
	<link rel="stylesheet" href="assets/table.css">
	<link rel="stylesheet" href="assets/main.css">
</head>

<body>
	<div class="content">
		<h1>xkcd Reddit Stats</h1>
		<?php
			print_stats_blurb($stats);
			print_top_comics($comics);
		?>
		<p><a href="#">See more</a></p>
		<?php
			print_top_posters($posters);
		?>
		<p><a href="#">See more</a></p>
	</div>
</body>

</html>