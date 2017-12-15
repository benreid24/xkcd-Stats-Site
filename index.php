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
	
	//Fetch subreddit breakdown
	$subs = get_subreddits($db);
?>


<!DOCTYPE html>
<html>

<head>
	<title>xkcd Reddit Stats</title>
	
	<link rel="stylesheet" href="assets/table.css">
	<link rel="stylesheet" href="assets/main.css">
	
	<script src="assets/highcharts/highcharts.js"></script>
	<script src="assets/highcharts/modules/exporting.js"></script>
</head>

<body>
	<div class="content">
		<h1>xkcd Reddit Stats</h1>
		<?php
			print_stats_blurb($stats);
		?>
		<span class="data-links"><h4><a href="data/ranking.csv" class="data-links">Comic Ranking CSV</a> | <a href="rawdata.zip" class="data-links">Raw Data ZIP</a></h4></span>
		<?php
			print_top_comics($comics);
		?>
		<p><a href="comics.php" class="link">See more</a></p>
		<?php
			print_top_posters($posters);
		?>
		<p><a href="posters.php" class="link">See more</a></p>
		<?php
			print_subreddit_chart($subs, $stats["LessOneRefSubs"]);
		?>
		
	</div>
</body>

</html>