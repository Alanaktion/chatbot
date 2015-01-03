<?php
$commands['math'] = function(&$conn, $event, $params) {
	global $mash_key;
	if (!empty($params[0])) {
		$param_str = implode(" ",$params);
		$response = Unirest::get("https://alanaktion-qalc-v1.p.mashape.com/?q=" . urlencode($param_str), array("X-Mashape-Authorization" => $mash_key));
		$conn->message($event['from'], $response->raw_body, $event['type']);
	} else {
		$conn->message($event['from'], "Usage: #math <expression>", $event['type']);
	}
}
?>
