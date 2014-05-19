<?php
$commands['timer'] = function(&$conn, $pl, $params) {
	global $timer;

	if(!empty($timer)) {
		$init = time() - $timer;
		$hours = floor($init / 3600);
		$minutes = floor(($init / 60) % 60);
		$seconds = $init % 60;
		$str = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
	}

	if (empty($params[0])) {
		if (!empty($timer)) {
			$conn->message($pl['from'], "Timer running: $str", $pl['type']);
		} else {
			$conn->message($pl['from'], "Timer isn't running!", $pl['type']);
		}
	} elseif ($params[0] == "start") {
		$timer = time();
		$conn->message($pl['from'], "Starting timer", $pl['type']);
	} elseif ($params[0] == "stop") {
		if (!empty($timer)) {
			$conn->message($pl['from'], "Timer stopped. Time: $str", $pl['type']);
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
