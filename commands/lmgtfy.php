<?php
$commands['lmgtfy'] = function(&$conn, $event, $params) {
	if(empty($params)) {
		$conn->message($event['from'], "Usage: #lmgtfy <query>", $event['type']);
	} else {
		$conn->message($event['from'], "http://lmgtfy.com/?q=" . urlencode(implode(" ",$params)), $event['type']);
	}
}
?>
