<?php
// Messy, but it should work :P
include dirname(__FILE__) . '/../config.php';
$commands['reload'] = function(&$conn, $pl, $params) {
	$conn->message($pl['from'], "Configuration reloaded.", $pl['type']);
}
?>
