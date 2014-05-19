<?php
$commands['anagram'] = function(&$conn, $event, $params) {
	if(!empty($params[0])) {
		$params[0] = strtolower($params[0]);
		if($params[0] == "alan") {
			$conn->message($event['from'], "hashbot", $event['type']);
			return;
		}
		$result = json_decode(curl_get_contents("http://www.anagramica.com/all/" . urlencode($params[0])));
		if(!empty($result->all)) {
			$conn->message($event['from'], implode(", ", $result->all), $event['type']);
		} else {
			$conn->message($event['from'], "No anagrams found.", $event['type']);
		}
	} else {
		$conn->message($event['from'], "Usage: #anagram <word>", $event['type']);
	}
}
?>
