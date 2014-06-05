<?php
$commands['loic'] = function(&$conn, $event, $params) {
	if (!empty($params[0])) {
		$conn->message($event['from'], "Targeting...", $event['type']);	
		sleep(2);
		$conn->message($event['from'], "<a href='http://0.0.0.0'>{$params[0]}</a> has been destroyed.", $event['type']);	
		
	} else {
		$conn->message($event['from'], "Please enter a website to target", $event['type']);\
	}
}
?>
