<?php
$commands['shuffle'] = function(&$conn, $event, $params) {
	if (isset($params[1])) {
		shuffle($params);
		$conn->message($event['from'], implode(" ", $params), $event['type']);
	} elseif (isset($params[0])) {
		$conn->message($event['from'], str_shuffle($params[0]), $event['type']);
	} else {
		$conn->message($event['from'], "Usage: #shuffle <word> [word]", $event['type']);
	}
};
