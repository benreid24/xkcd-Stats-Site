<?php

function print_top_comics($comics) {
	$rank = 1;
	echo "<div class=\"table-title\"><h3>Top 20 xkcd's on Reddit</h3></div>";
	echo "<table class=\"table-fill\">\n";
	echo "<thead>\n<tr> <th class=\"text-left\">Rank</th> <th class=\"text-left\">Comic</th>";
	echo "<th class=\"text-left\">Count</th> <th class=\"text-left\">Percent</th>";
	echo "<th class=\"text-left\">Std Deviations</th></tr></thead>\n<tbody>\n";
	foreach ($comics as $comic) {
		echo "<tr>";
		echo "<td>$rank</td>";
		echo "<td class=\"text-left\"><a href=\"".$comic["Link"]."\">".$comic["Id"].": ".$comic["Title"]."</a></td>";
		echo "<td class=\"text-left\">".$comic["Count"]."</td>";
		echo "<td class=\"text-left\">0</td>";
		echo "<td class=\"text-left\">0</td>";
		echo "</tr>\n";
		$rank = $rank + 1;
	}
	echo "</tbody></table>";
}

function print_stats_blurb($stats) {
	$totalRefs = $stats["TotalReferences"];
	$stdDev = $stats["ComicReferenceCountStdDev"];
	$avg = $stats["AverageReferencesPerComic"];
	$totalPosters = $stats["UniquePosters"];
	$totalSubs = $stats["UniqueSubs"];
	$totalComics = $stats["UniqueComics"];
	echo "<p>So far $totalRefs references to xkcd have been found. $totalComics unique comics have";
    echo " been referenced by $totalPosters unique users on $totalSubs unique subreddits. There are";
	echo " an average of $avg references per xkcd comic, with a standard deviation of $stdDev </p>";
}

?>