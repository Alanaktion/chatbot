<?php
$commands['nooo'] = function(&$conn, $event, $params) {
	$conn->message($event['from'], "http://nooooooooooooooo.com/", $event['type']);
}
?>
