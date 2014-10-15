<?php
$commands['sha1'] = function(&$conn, $event, $params) {
	if(empty($params)) {
		$conn->message($event['from'], "Usage: #sha1 <string>", $event['type']);
	} else {
		$conn->message($event['from'], sha1(implode(" ",$params)), $event['type']);
	}
}
?>
