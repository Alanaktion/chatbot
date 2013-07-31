<?php
$commands['fortune'] = function(&$conn, $event, $params) {
	if (!empty($params[0])) {
		$url = "raw&q=" . $params[0];
	} else {
		$url = "raw";
	}
	$response = curl_get_contents("http://alanaktion.net/fun/fortune.php?" . $url);
	$conn->message($event['from'], trim($response), $event['type']);
}
?>
