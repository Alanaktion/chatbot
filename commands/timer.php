<?php
$commands['timer'] = function(&$conn, $pl, $params) {
	global $timer;
	if (empty($params[0])) {
		if (!empty($timer)) {
			$conn->message($pl['from'], "Timer running, " . (time() - $timer) . " seconds", $pl['type']);
		} else {
			$conn->message($pl['from'], "Timer isn't running!", $pl['type']);
		}
	} elseif ($params[0] == "start") {
		$timer = time();
		$conn->message($pl['from'], "Starting timer", $pl['type']);
	} elseif ($params[0] == "stop") {
		if (!empty($timer)) {
			$conn->message($pl['from'], "Time: " . (time() - $timer) . " seconds", $pl['type']);
			$timer = 0;
			unset($timer);
		} else {
			$conn->message($pl['from'], "Timer isn't running!", $pl['type']);
		}
	} else {
		$conn->message($pl['from'], "Usage: #timer [start|stop]", $pl['type']);
	}
}
?>
