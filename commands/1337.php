<?php
$commands['1337'] = function(&$conn, $pl, $params) {
	global $mash_key;
	if (!empty($params[0])) {
		$param_str = implode(" ",$params);
		$response = Unirest::get("https://montanaflynn-l33t-sp34k.p.mashape.com/encode?text=" . urlencode($param_str), array("X-Mashape-Authorization" => $mash_key));
		$conn->message($pl['from'], $response->raw_body, $pl['type']);
	} else {
		$conn->message($pl['from'], "Usage: #1337 <sentence>", $pl['type']);
	}
}
?>
