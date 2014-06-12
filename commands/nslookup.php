<?php
$commands['nslookup'] = function(&$conn, $event, $params) {
	if(!empty($params[0])) {
		$result = gethostbyname($params[0]);
		if(!empty($result)) {
			$conn->message($event['from'], $result, $event['type']);
		} else {
			$conn->message($event['from'], "No matching hosts found.", $event['type']);
		}
	} else {
		$conn->message($event['from'], "Usage: #nslookup <host>", $event['type']);
	}
}
?>
