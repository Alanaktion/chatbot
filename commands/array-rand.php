<?php
$commands['array-rand'] = function(&$conn, $event, $params) {
	if(!empty($params) && count($params) > 1) {
		$val = $params[array_rand($params)];
		$conn->message($event['from'], $val, $event['type']);
	} else {
		$conn->message($event['from'], "Usage: #array-rand [item1] [item2] ... [itemN]", $event['type']);
	}
}
?>
