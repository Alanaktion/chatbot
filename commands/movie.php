<?php
include_once dirname(__FILE__) . '/../lib/tmdb4php/TMDB.php';
$commands['movie'] = function(&$conn, $pl, $params) {
	global $tmdb_key;
	$db = TMDB::getInstance($tmdb_key);
	$db->paged = true;
	if (!empty($params[0])) {
		$param_str = implode(" ",$params);
		$movies = $db->search("movie", array("query" => $param_str));
		if(!empty($movies)) {
			$html = "";
			$text = "";
			foreach($movies as $movie) {
				$html .= "<br /><a href='http://www.themoviedb.org/movie/{$movie->id}'>" . htmlentities($movie->title) . "</a><br />\n" . $movie->release_date . " - " . str_repeat("★", round($movie->vote_average / 2)) . str_repeat("☆", 5 - round($movie->vote_average / 2));
				$text .= "\n" . htmlentities($movie->title) . "\n" . $movie->release_date . " - " . str_repeat("★", round($movie->vote_average / 2)) . str_repeat("☆", 5 - round($movie->vote_average / 2));
			}
			$conn->htmlmessage($pl['from'], $html, $pl['type'], $text);
		} else {
			$conn->message($pl['from'], "Nada.", $pl['type']);
		}
	} else {
		$conn->message($pl['from'], "Usage: #movie <title or keyword>", $pl['type']);
	}
}
?>
