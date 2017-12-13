<?php

include("config.php");

function connect_to_db() {
	$db = new mysqli("localhost", get_db_username(), get_db_password(), "h2ndxygv_xkcd_stats");
	return $db;
}

function get_top_comics($db, $lim = 20) {
	$comics = [];
	$topComicsProxy = $db->query("SELECT * FROM  `comic_counts` INNER JOIN
								  (SELECT Comic AS id, Title FROM comics) AS titles
								  ON titles.id = comic_counts.Comic WHERE ReferenceCount > 0
								  ORDER BY ReferenceCount DESC LIMIT ".$lim);
	while ($row = $topComicsProxy->fetch_assoc()) {
		$comic = [
			"Id" => $row["Comic"],
			"Count" => $row["ReferenceCount"],
			"Title" => $row["Title"],
			"Link" => "https://xkcd.com/".$row["Comic"]
		];
		$comics[] = $comic;
	}
	
	return $comics;
}

function get_stats($db) {
	$stats = [];
	$statsProxy = $db->query("SELECT * FROM stats");
	while ($row = $statsProxy->fetch_assoc()) {
		$stats[$row["Name"]] = $row["Value"];
	}
	//TODO - Move this into data cruncher
	$count = $db->query("SELECT count(*) as count FROM comic_counts WHERE ReferenceCount>0");
	$result = $count->fetch_assoc();
	$stats["UniqueComics"] = $result["count"];
	return $stats;
}

?>