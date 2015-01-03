<?php
$commands['1337'] = function(&$conn, $event, $params) {
	global $mash_key;
	if (!empty($params[0])) {
		$param_str = implode(" ",$params);
		$response = Unirest::get("https://montanaflynn-l33t-sp34k.p.mashape.com/encode?text=" . urlencode($param_str), array("X-Mashape-Authorization" => $mash_key));
		$conn->message($event['from'], $response->raw_body, $event['type']);
	} else {
		$conn->message($event['from'], "Usage: #1337 <sentence>", $event['type']);
	}
}
?>
