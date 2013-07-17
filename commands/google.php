<?php
$commands['google'] = function(&$conn, $pl, $params) {
	if (!empty($params[0])) {
		$param_str = implode(" ",$params);
		$url = "https://ajax.googleapis.com/ajax/services/search/web?v=1.0&q=" . urlencode($param_str);
		$response = json_decode(curl_get_contents($url), true);
		if (isset($response['responseData']['results'][0])) {
			$top = $response['responseData']['results'][0];
			$conn->message($pl['from'], $top['titleNoFormatting'] . " " . $top['url'], $pl['type']);
		} else {
			$conn->message($pl['from'], "Nothing found!", $pl['type']);
		}
	} else {
		$conn->message($pl['from'], "Usage: #google <search terms>", $pl['type']);
	}
}
?>
