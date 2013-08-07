<?php
$commands['ping'] = function(&$conn, $pl, $params) {
	global $mash_key;
	if (!empty($params[0])) {
		$response = Unirest::get("https://igor-zachetly-ping-uin.p.mashape.com/pinguin.php?address=" . urlencode($params[0]), array("X-Mashape-Authorization" => $mash_key));
		if($response->body->result && !empty($response->body->time)) {
			$output = "Online - " . $response->body->time . "ms";
		} elseif(!empty($response->body->message)) {
			$output = $response->body->message;
		} else {
			$output = "Unable to connect to host.";
			echo $response->raw_body;
		}
		$conn->message($pl['from'], $output, $pl['type']);
	} else {
		$conn->message($pl['from'], "Usage: #ping <host>", $pl['type']);
	}
}
?>
