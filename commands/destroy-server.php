<?php
$commands['destroy-server'] = function(&$conn, $event, $params) {
	if (!empty($params[0])) {
		$conn->message($event['from'], "Destroying...", $params[0]);	
		sleep(2);
		$conn->htmlmessage($event['from'], "$params[0] has been destroy rm -Rf / command", $event['type']);	
		
	} else {
		$conn->message($event['from'], "Please enter a server to destroy", $event['type']);
	}
}
?>
