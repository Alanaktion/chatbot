<?php
$commands['xkcd'] = function(&$conn, $pl, $params) {
	if (!empty($params[0])) {
		$response = json_decode(curl_get_contents("http://xkcd.com/" . intval($params[0]) . "/info.0.json"));
		$conn->message($pl['from'], $response->img, $pl['type']);
	} else {
		$response = json_decode(curl_get_contents("http://xkcd.com/info.0.json"));
		//$conn->message($pl['from'], "Latest: http://xkcd.com/" . $response->num . "/", $pl['type']);
		$conn->message($pl['from'], $response->img, $pl['type']);
	}
}
?>
