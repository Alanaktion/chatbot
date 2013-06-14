<?php
$commands['qr'] = function(&$conn, $pl, $params) {
	global $mash_key;
	if (!empty($params[0])) {
		$param_str = implode(" ",$params);
		$response = Unirest::get("https://mutationevent-qr-code-generator.p.mashape.com/generate.php?content=" . urlencode($param_str), array("X-Mashape-Authorization" => $mash_key));
		$conn->message($pl['from'], $response->body->image_url, $pl['type']);
	} else {
		$conn->message($pl['from'], "Usage: #qr <text>", $pl['type']);
	}
}
?>
