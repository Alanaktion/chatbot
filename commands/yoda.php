<?php
$commands['yoda'] = function(&$conn, $pl, $params) {
	global $mash_key;
	if (!empty($params[0])) {
		$param_str = implode(" ",$params);
		$response = Unirest::get("https://yoda.p.mashape.com/yoda?sentence=" . urlencode($param_str), array("X-Mashape-Authorization" => $mash_key));
		$conn->message($pl['from'], $response->raw_body, $pl['type']);
	} else {
		$conn->message($pl['from'], "Usage: #yoda <sentence>", $pl['type']);
	}
}
?>
