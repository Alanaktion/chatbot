<?php
$commands['man'] = function(&$conn, $pl, $params) {
	if (!empty($params[0])) {
		$conn->message($pl['from'], "http://linux.die.net/man/1/" . strtolower($params[0]), $pl['type']);
	} else {
		$conn->message($pl['from'], "Usage: #man <search terms>", $pl['type']);
	}
}
?>
