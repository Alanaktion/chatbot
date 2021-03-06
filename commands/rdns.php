<?php
$commands['rdns'] = function(&$conn, $pl, $params) {
	global $mash_key;
	if (!empty($params[0])) {
		// Use gethostbyaddr() for local addresses
		if(preg_match("/^192|127|169\\./", $params[0])) {
			$conn->message($pl['from'], gethostbyaddr($params[0]), $pl['type']);
		} else {
			$response = Unirest::get("https://mark-sutuer-ip-utils.p.mashape.com/api.php?_method=resolveIp&address=" . urlencode($params[0]), array("X-Mashape-Authorization" => $mash_key));
			$conn->message($pl['from'], $response->body->host, $pl['type']);
		}
	} else {
		$conn->message($pl['from'], "Usage: #rdns <ip address>", $pl['type']);
	}
}
?>
