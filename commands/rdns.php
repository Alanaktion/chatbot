<?php
$commands['rdns'] = function(&$conn, $pl, $params) {
	global $mash_key;
	if (!empty($params[0])) {
		$response = Unirest::get("https://mark-sutuer-ip-utils.p.mashape.com/api.php?_method=resolveIp&address=" . urlencode($params[0]), array("X-Mashape-Authorization" => $mash_key));
		$conn->message($pl['from'], $response->body->host, $pl['type']);
	} else {
		$conn->message($pl['from'], "Usage: #rdns <ip address>", $pl['type']);
	}
}
?>
