<?php
$commands['ping_native'] = function(&$conn, $event, $params) {
	if (!empty($params[0])) {

		// Filter server string
		$host = preg_replace("/[^a-zA-Z0-9\.-]/","",$params[0]);
		if(!$host) {
			$conn->message($event['from'], "Invalid host.", $event['type']);
			return false;
		}

		// Check if on Windows
		$win = (strncasecmp(PHP_OS, 'WIN', 3) == 0);

		// Get [count] parameter
		if(!empty($params[1])) {
			$count = intval($params[1]);
		} else {
			$count = 5;
		}

		// Run command
		$conn->message($event['from'], "Pinging {$params[0]}...", $event['type']);
		$result = shell_exec("ping -" . ($win ? "n" : "c") . " {$count} {$host}");

		$conn->message($event['from'], $result, $event['type']);
	} else {
		$conn->message($event['from'], "Usage: #ping_native <server> [count]", $event['type']);
	}
}
?>