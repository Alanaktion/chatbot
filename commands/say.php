<?php
$commands['say'] = function(&$conn, $event, $params) {
	if(empty($params)) {
		$conn->message($event['from'], "Usage: #say <message>", $event['type']);
	} elseif ($params[0]{0} == "#") {
		$conn->message($event['from'], "Nope :P", $event['type']);
	} else {
		$conn->message($event['from'], implode(" ",$params), $event['type']);
	}
}
?>
