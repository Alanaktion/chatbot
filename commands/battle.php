<?php
$commands['battle'] = function(&$conn, $pl, $params) {
	if (!empty($params[0])) {
		$param_str = implode(" ", $params);
		$queries = explode("vs", $param_str);

		if(count($queries) != 2) {
			$conn->message($pl['from'], "Usage: #battle <search term> vs <search term>", $pl['type']);
			return;
		}

		$queries[0] = trim($queries[0]);
		$url0 = "https://ajax.googleapis.com/ajax/services/search/web?v=1.0&rsz=1&q=" . urlencode($queries[0]);
		$response0 = json_decode(curl_get_contents($url0), true);

		$queries[1] = trim($queries[1]);
		$url1 = "https://ajax.googleapis.com/ajax/services/search/web?v=1.0&rsz=1&q=" . urlencode($queries[1]);
		$response1 = json_decode(curl_get_contents($url1), true);

		if (isset($response0['responseData']['cursor']['estimatedResultCount'])) {

			$result0 = $response0['responseData']['cursor']['estimatedResultCount'];
			$result1 = $response1['responseData']['cursor']['estimatedResultCount'];

			if($result0 > $result1) {
				$conn->message($pl['from'], $queries[0] . " wins " . number_format($result0) . " - " . number_format($result1) . "!", $pl['type']);
			} elseif($result1 > $result0) {
				$conn->message($pl['from'], $queries[1] . " wins " . number_format($result1) . " - " . number_format($result0) . "!", $pl['type']);
			} else {
				$conn->message($pl['from'], "It's a tie at " . number_format($result0) . "!", $pl['type']);
			}

		} else {
			$conn->message($pl['from'], "The opponent didn't show.", $pl['type']);
		}
	} else {
		$conn->message($pl['from'], "Usage: #battle <search term> vs <search term>", $pl['type']);
	}
}
?>
