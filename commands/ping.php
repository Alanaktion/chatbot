<?php
$commands['ping'] = function(&$conn, $pl, $params) {
	global $mash_key;
	if (!empty($params[0])) {
		$response = Unirest::get("http://phpizza.com/~alan/ping.php?host=" . urlencode($params[0]));
		if($response->body->online) {
			$output = "Online - " . $response->body->ping;
		} else {
			$output = "Unable to connect to host.";
		}
		$conn->message($pl['from'], $output, $pl['type']);
	} else {
		$conn->message($pl['from'], "Usage: #ping <host>", $pl['type']);
	}
}
?>
