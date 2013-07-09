<?php
$commands['wa'] = function(&$conn, $pl, $params) {
	global $mash_key;
	if (!empty($params[0])) {
		$param_str = implode(" ",$params);
		$response = curl_get_contents("http://api.wolframalpha.com/v2/query?input=" . urlencode($param_str) . "&appid=" . urlencode($wa_app) . "&format=plaintext");
		$conn->message($pl['from'], "\n" . $response, $pl['type']);
	} else {
		$conn->message($pl['from'], "Usage: #wa <expression>", $pl['type']);
	}
}
?>
