<?php
$commands['ping_native'] = function(&$conn, $event, $params) {
	if (!empty($params[0])) {

		// Filter server string
		$host = preg_replace("/[^a-z0-9\\.-]/i", "", $params[0]);
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
		$ph = popen("ping -" . ($win ? "n" : "c") . " {$count} {$host}", "r");
		while (! feof($ph)) {
			$conn->message($event['from'], trim(fgets($ph, 1024)), $event['type']);
		}
		pclose($ph);
	} else {
		$conn->message($event['from'], "Usage: #ping_native <server> [count]", $event['type']);
	}
}
?>
