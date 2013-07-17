<?php
$commands['geoip'] = function(&$conn, $pl, $params) {
	global $mash_key;
	if (!empty($params[0])) {
		$response = Unirest::get("http://freegeoip.net/json/" . rawurlencode($params[0]));
		if($response->body->country_code) {
			$output = $response->body->city . ", " . $response->body->region_code . ", " . $response->body->country_code . " ";
			$output .= "(" . $response->body->latitude . " " . $response->body->longitude . ")";
		} else {
			$output = "IP " . $params[0] . "not in database.";
		}
		$conn->message($pl['from'], $output, $pl['type']);
	} else {
		$conn->message($pl['from'], "Usage: #geoip <ip address>", $pl['type']);
	}
}
?>
