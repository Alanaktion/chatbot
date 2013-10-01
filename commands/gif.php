<?php
$commands['gif'] = function(&$conn, $event, $params) {
	if(!empty($params[0])) {
		$param_str = implode(" ",$params);
		$url = "http://api.giphy.com/v1/gifs/search?q=" . urlencode($param_str) . "&limit=20&api_key=dc6zaTOxFJmzC";
		$result = Unirest::get($url);
		if(!empty($result->body->data) && !empty($result->body->data[0])) {
			$i = array_rand($result->body->data);
			$img = $result->body->data[$i]->images->original;
			$conn->message($event['from'], $img->url, $event['type']);
		} else {
			$conn->message($event['from'], "Nada.", $event['type']);
		}
	} else {
		$conn->message($event['from'], "Usage: #gif <search terms>", $event['type']);
	}
}
?>