<?php
$commands['shout'] = function(&$conn, $pl, $params) {
	global $mash_key;
	if (!empty($params[0])) {
		$param_str = implode(" ",$params);
		$response = curl_get_contents("https://artii.herokuapp.com/make?text=" . urlencode($param_str));
		$conn->message($pl['from'], "\n" . $response, $pl['type']);
	} else {
		$conn->message($pl['from'], "Usage: #shout <words, yo>", $pl['type']);
	}
}
?>
