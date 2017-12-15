<?php

function print_top_comics($comics) {
	$rank = 1;
	$count = sizeof($comics);
	echo "<div class=\"table-title\"><h3>Top $count xkcd's on Reddit</h3></div>";
	echo "<table class=\"table-fill\">\n";
	echo "<thead>\n<tr> <th class=\"text-left\">Rank</th> <th class=\"text-left\">Comic</th>";
	echo "<th class=\"text-left\">Count</th> <th class=\"text-left\">Percent of References</th>";
	echo "<th class=\"text-left\">Std Deviations From Mean</th></tr></thead>\n<tbody>\n";
	foreach ($comics as $comic) {
		echo "<tr>";
		echo "<td>$rank</td>";
		echo "<td class=\"text-left\"><a href=\"".$comic["Link"]."\">".$comic["Id"].": ".$comic["Title"]."</a></td>";
		echo "<td class=\"text-left\">".$comic["Count"]."</td>";
		echo "<td class=\"text-left\">".$comic["Percent"]."</td>";
		echo "<td class=\"text-left\">".$comic["StdDevs"]."</td>";
		echo "</tr>\n";
		$rank = $rank + 1;
	}
	echo "</tbody></table>\n";
}

function print_top_posters($posters) {
	$rank = 1;
	$count = sizeof($posters);
	echo "<div class=\"table-title\"><h3>Top $count referencers of xkcd</h3></div>";
	echo "<table class=\"table-fill\">\n";
	echo "<thead>\n<tr> <th class=\"text-left\">Rank</th> <th class=\"text-left\">Name</th>";
	echo "<th class=\"text-left\">Count</th></tr></thead>\n<tbody>\n";
	foreach ($posters as $poster) {
		echo "<tr>";
		echo "<td>$rank</td>";
		echo "<td class=\"text-left\">".$poster["Name"]."</td>";
		echo "<td class=\"text-left\">".$poster["Count"]."</td>";
		echo "</tr>";
		$rank = $rank + 1;
	}
	echo "</tbody></table>";
}
	

function print_stats_blurb($stats) {
	$totalRefs = $stats["TotalReferences"];
	$stdDev = number_format((float)$stats["ComicReferenceCountStdDev"], 4, ".", "");
	$avg = number_format((float)$stats["AverageReferencesPerComic"], 4, ".", "");
	$totalPosters = $stats["UniquePosters"];
	$totalSubs = $stats["UniqueSubs"];
	$totalComics = $stats["UniqueComics"];
	$refsPerHour = number_format((float)$stats["RefsPerHour"], 4, ".", "");
	echo "<p>So far <span class=\"stat\">$totalRefs</span> references to xkcd have been found as of 12/13/2017. xkcd comics are referenced an average of ";
	echo "<span class=\"stat\">$refsPerHour</span> times per hour. <span class=\"stat\">$totalComics</span> unique comics have";
    echo " been referenced by <span class=\"stat\">$totalPosters</span> unique users on <span class=\"stat\">$totalSubs</span> unique subreddits. There are";
	echo " an average of <span class=\"stat\">$avg</span> references per xkcd comic, with a standard deviation of <span class=\"stat\">$stdDev</span> </p>";
}

?>