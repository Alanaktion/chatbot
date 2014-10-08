<?php
$commands['destroy-server'] = function(&$conn, $event, $params) {
	if (!empty($params[0])) {
		$conn->message($event['from'], "Destroying...", $event['type']);	
		sleep(2);
		$conn->htmlmessage($event['from'], "<a href='http://0.0.0.0'>{$params[0]}</a> has been destroy rm -Rf / command", $event['type']);			
	} else {
		$conn->message($event['from'], "Please enter a server to destroy", $event['type']);
	}
}
?>
