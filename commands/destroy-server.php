<?php
$commands['destory-server'] = function(&$conn, $event, $params) {
	if (!empty($params[0])) {
		$conn->message($event['from'], "Destorying...", $params[0]);	
		sleep(2);
		$conn->htmlmessage($event['from'], "$params[0] has been destory rm -Rf / command", $event['type']);	
		
	} else {
		$conn->message($event['from'], "Please enter a server to destory", $event['type']);
	}
}
?>
