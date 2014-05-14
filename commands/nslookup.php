<?php
$commands['nslookup'] = function(&$conn, $event, $params) {
	if(!empty($params[0])) {
		$result = json_decode(curl_get_contents("http://www.anagramica.com/all/" . urlencode($params[0])));
		if(!empty($result)) {
			$conn->message($event['from'], implode(", ", $result), $event['type']);
		} else {
			$conn->message($event['from'], "No matching hosts found.", $event['type']);
		}
	} else {
		$conn->message($event['from'], "Usage: #nslookup <host>", $event['type']);
	}
}
?>
