<?php
$commands['q'] = function(&$conn, $pl, $params) {
	if (!empty($params[0])) {
		$param_str = implode(" ",$params);
		$url = "http://www.faroo.com/api?q=" . urlencode($param_str) . "&length=1&l=en&src=web&i=false&f=json";
		$result = json_decode(file_get_contents($url), true);
		if (isset($result['results'][0])) {
			$top = $result['results'][0];
			$conn->message($pl['from'], $top['title'] . " " . $top['url'], $pl['type']);
		} else {
			$conn->message($pl['from'], "Nothing found!", $pl['type']);
		}
	} else {
		$conn->message($pl['from'], "Usage: #q <search terms>", $pl['type']);
	}
}
?>
