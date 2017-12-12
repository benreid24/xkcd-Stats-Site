<?php

function print_top_comics($comics) {
	$rank = 1;
	echo "<table>\n";
	echo "<tr> <th>Rank</th> <th>Comic</th> <th>Count</th> <th>Percent</th> <th>Std Deviations</th></tr>\n";
	foreach ($comics as $comic) {
		echo "<tr>";
		echo "<td>$rank</td>";
		echo "<td><a href=\"".$comic["Link"]."\">".$comic["Id"].": ".$comic["Title"]."</a></td>";
		echo "<td>".$comic["Count"]."</td>";
		echo "<td>0</td>";
		echo "<td>0</td>";
		echo "</tr>\n";
		$rank = $rank + 1;
	}
	echo "</table>";
}

?>