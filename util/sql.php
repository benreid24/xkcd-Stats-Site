<?php

include("config.php");

function connect_to_db() {
	$db = new mysqli("localhost", get_db_username(), get_db_password(), "h2ndxygv_xkcd_stats");
	return $db;
}

function get_top_comics($db, $lim = 20) {
	$comics = [];
	
	if (!is_numeric($lim) or $lim<0)
		return $comics;
	
	$query = "SELECT * FROM  `comic_counts` INNER JOIN
			  (SELECT Comic AS id, Title FROM comics) AS titles
			  ON titles.id = comic_counts.Comic WHERE ReferenceCount > 0
			  ORDER BY ReferenceCount DESC";
	if ($lim>0)
		$query = $query." LIMIT $lim";
	
	$topComicsProxy = $db->query($query);
	while ($row = $topComicsProxy->fetch_assoc()) {
		$comic = [
			"Id" => $row["Comic"],
			"Count" => $row["ReferenceCount"],
			"Percent" => $row["Percent"],
			"StdDevs" => $row["StdDevs"],
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
	return $stats;
}

function get_top_posters($db, $lim = 10) {
	$posters = [];
	
	if (!is_numeric($lim) or $lim<0)
		return $posters;
	
	$query = "SELECT * FROM poster_counts ORDER BY ReferenceCount DESC";
	if ($lim>0)
		$query = $query." LIMIT $lim";
	
	$proxy = $db->query($query);
	while ($row = $proxy->fetch_assoc()) {
		$poster = [
			"Name" => $row["Name"],
			"Count" => $row["ReferenceCount"]
		];
		$posters[] = $poster;
	}
	return $posters;
}

function get_subreddits($db) {
	$subs = [];
	$proxy = $db->query("SELECT * FROM subreddits WHERE NormPercent IS NOT NULL ORDER BY NormPercent DESC");
	while ($row = $proxy->fetch_assoc()) {
		$sub = [
			"Name" => $row["Name"],
			"Percent" => $row["NormPercent"]
		];
		$subs[] = $sub;
	}
	return $subs;
}

?>