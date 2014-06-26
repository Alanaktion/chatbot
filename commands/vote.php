<?php
$commands['vote'] = function(&$conn, $event, $params) {
	
	$val = rand(0,1);
	if($val == 1) {
		$response = "(y) Yes";
	} else {
		$response = "👎 No";
	}
	
	if(isset($response)) {
		$conn->message($event['from'], $response, $event['type']);
	} else {
		$conn->message($event['from'], "Usage: #vote", $event['type']);
	}
}
?>
