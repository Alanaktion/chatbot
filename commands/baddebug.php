<?php
$commands['baddebug'] = function(&$conn, $event, $params) {
	global $wordfilter, $wordreplace;
	$conn->message($event['from'], count($wordfilter) . " words in database.", $event['type']);
}
?>
