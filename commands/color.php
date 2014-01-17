<?php
$commands['color'] = function(&$conn, $pl, $params) {
	if (!empty($params[0])) {
		$conn->htmlmessage($pl['from'], "<p><span style=\"color: " . $params[0] . ";\">███</span></p>", $pl['type']);
	} else {
		$conn->message($pl['from'], "Usage: #color <valid color name>", $pl['type']);
	}
}
?>