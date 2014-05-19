<?php
$commands['baddebug'] = function(&$conn, $event, $params) {
	global $wordfilter, $wordreplace;
	print_r($wordfilter);
	// print_r($wordreplace);
	$conn->message($event['from'], count($wordfilter) . " words in database.", $event['type']);
}
?>
