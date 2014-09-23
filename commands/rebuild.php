<?php
$commands['remove'] = function(&$conn, $event, $params) {
	if (!empty($params[0])) {
		$conn->message($event['from'], "Rebuilding...", $event['type']);	
		sleep(2);
		$conn->htmlmessage($event['from'], "<a href='http://0.0.0.0'>{$params[0]}</a> has been rebuilt.", $event['type']);	
		
	} else {
		$conn->message($event['from'], "Please enter a website to rebuild", $event['type']);
	}
}
?>
