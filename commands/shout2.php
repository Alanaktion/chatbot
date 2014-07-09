<?php
$commands['shout2'] = function(&$conn, $event, $params) {
	if(empty($params)) {
		$conn->message($event['from'], "Usage: #shout2 <message>", $event['type']);
	} elseif ($params[0]{0} == "#") {
		$conn->message($event['from'], "Wat.", $event['type']);
	} else {
		$conn->htmlmessage($event['from'], "<p><span style='font-size:xx-large;font-weight:bold;color:yellow;background:#444;'>" . htmlentities(implode(" ", $params)) . "</span></p>", $event['type']);
	}
}
?>
