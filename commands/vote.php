<?php
$commands['vote'] = function(&$conn, $event, $params) {
	
	$val = rand(0,1);
	if($val == 1) {
		$response = "<a href='http://xkcd.com/yes/'>(y) Yes</a>";
	} else {
		$response = "<a href='http://xkcd.com/no/'>👎 No</a>";
	}
	
	if(isset($response)) {
		$conn->htmlmessage($event['from'], $response, $event['type']);
	} else {
		$conn->message($event['from'], "Usage: #vote", $event['type']);
	}
}
?>
