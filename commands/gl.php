<?php
$commands['gl'] = function(&$conn, $pl, $params) {
	if (!empty($params[0])) {
		$response = json_decode(curl_post_get_contents("https://www.googleapis.com/urlshortener/v1/url",array($params[0])));
		if(!empty($response->id)) {
			$conn->message($pl['from'], $response->id, $pl['type']);
		}
	} else {
		$conn->message($pl['from'], "Usage: #gl <long url>", $pl['type']);
	}
}
?>
