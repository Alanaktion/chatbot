<?php
$commands['destroy-server'] = function(&$conn, $event, $params) {
	if (!empty($params[0])) {
		$conn->message($event['from'], "Destroying $params[0]", $event['type']);	
		sleep(2);
		$conn->htmlmessage($event['from'], "The server named <a href='http://0.0.0.0'>{$params[0]}</a> has been destroy using the rm -Rf / command", $event['type']);			
	} else {
		$conn->message($event['from'], "Please enter a server to destroy", $event['type']);
	}
}
?>
