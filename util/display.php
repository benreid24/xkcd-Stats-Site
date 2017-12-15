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

function print_subreddit_chart($subs, $other_percent) {
	$other_percent = number_format((float)$other_percent, 4, ".", "");
	$main_percent = 100-$other_percent;
	echo "<p>Below is a breakdown of Subreddits whose total references to xkcd make up more than <span class=\"stat\">1%</span>";
	echo " of all references to xkcd. Subreddits with contributions of less than 1% make up <span class=\"stat\">$other_percent%</span>";
	echo " of the references to xkcd. The chart below represents the breakdown of the remaining <span class=\"stat\">$main_percent%</span> of references</p>";
	echo "<div id=\"subreddits\" style=\"min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto; background: #2e84dc; color: white;\"></div>";
	echo "<script type=\"text/javascript\">

			Highcharts.chart('subreddits', {
				chart: {
					plotBackgroundColor: 'white',
					plotBorderWidth: null,
					plotShadow: false,
					type: 'pie'
				},
				title: {
					text: 'Subreddit Breakdown'
				},
				tooltip: {
					pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: true,
							format: '<b>{point.name}</b>: {point.percentage:.1f} %',
							style: {
								color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
							}
						}
					}
				},
				series: [{
					name: 'Brands',
					colorByPoint: true,
					data: [";
					
		foreach ($subs as $sub) {
			$name = $sub["Name"];
			$percent = $sub["Percent"];
			echo "{ name: '$name', y: $percent }, ";
		}			
		
		echo "]
				}]
			});
		</script>";
}
?>