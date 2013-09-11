<?php
$commands['time'] = function(&$conn, $pl, $params) {
	global $timezone;
	date_default_timezone_set($timezone);
	$conn->message($pl['from'], date("r"), $pl['type']);
}
?>
