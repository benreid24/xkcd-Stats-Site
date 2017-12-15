<?php
	include("util/sql.php");
	include("util/display.php");
	$db = connect_to_db();
	
	//Fetch top 20 posters
	$posters = get_top_posters($db, 0);
?>

<!DOCTYPE html>
<html>

<head>
	<title>xkcd Reddit Stats - Top Referencers</title>
	
	<link rel="stylesheet" href="assets/table.css">
	<link rel="stylesheet" href="assets/main.css">
</head>

<body>
	<div class="content">
		<p><a href="index.php" class="link">Home</a></p>
		<?php
			print_top_posters($posters);
		?>
		<p><a href="index.php" class="link">Back</a></p>
	</div>
</body>

</html>